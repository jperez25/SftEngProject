<?php

namespace App;

use App\Group;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;


    const ADMIN_TYPE = 2;
    const DEFAULT_TYPE = 1;
    protected $primaryKey = 'id';

    public function getId()
    {
        return $this->id;
    }
    public function isAdmin()    {        
        return $this->level === self::ADMIN_TYPE;    
    }

    public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'verified', 'password', 'bio', 'child_age', 'city', 'state', 'child_bio', 
        'parent_age', 'user_picture', 'user_picture_type', 'gender', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function friendsOfMine() {
        return $this->belongsToMany('App\User', 'friends', 'user1_id', 'user2_id');
    }

    public function friendOf() {
        return $this->belongsToMany('App\User', 'friends', 'user2_id', 'user1_id');
    }

    public function friends() {
        return $this->friendsOfMine->merge($this->friendOf);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class)->withTimestamps();
    }
}
