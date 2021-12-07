<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leavestype extends Model
{
    use HasFactory;

    protected $table = "leavestypes";
    public $timestamps = false;

    public function getleavetype()
    {
        
        return $this->hasOne(Name::class);
    }

}
