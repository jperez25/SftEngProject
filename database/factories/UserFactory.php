<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {

    $city = $faker->city;
    $state = $faker->stateAbbr;
    $coordinates = geocode($city." ".$state);

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'verified' => "1",        
        'password' => bcrypt('password'),
        'remember_token' => str_random(10),
        'bio' => $faker->text,
        'child_bio' => $faker->text,
        'child_age' => rand(3,8),
        'parent_age' => rand(25,40),
        'city'=> $city,
        'state'=> $state,
        'lat' => $coordinates[0],
        'lng' => $coordinates[1],
    ];
});

function geocode($address){
 
    // url encode the address
    $address = urlencode($address);
     
    // google map geocode api url
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=".env('GOOGLE_API_KEY');
 
    // get the json response
    $resp_json = file_get_contents($url);
     
    // decode the json
    $resp = json_decode($resp_json, true);
 
    // response status will be 'OK', if able to geocode given address 
    if($resp['status']=='OK'){
 
        // get the important data
        $lati = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
        $longi = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
        $formatted_address = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : "";
         
        // verify if data is complete
        if($lati && $longi && $formatted_address){
         
            // put the data in the array
            $data_arr = array();            
             
            array_push(
                $data_arr, 
                    $lati, 
                    $longi, 
                    $formatted_address
                );
             
            return $data_arr;
             
        }else{
            return false;
        }
         
    }
 
    else{
        echo "ERROR: {$resp['status']}\n";
        return false;
    }
}