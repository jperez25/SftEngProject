<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
    'user1_id','user2_id','rating','description'
];
}
