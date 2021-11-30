<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;                                                                                                                                       
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements AuthenticatableContract
{
      use HasFactory;
      use Authenticatable;
    protected $table = 'users';

    protected $fillable = [];

    // public function profile()
    // {
    // 

    //         return $users;
    // }
}