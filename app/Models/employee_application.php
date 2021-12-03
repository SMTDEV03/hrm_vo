<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee_application extends Model
{
    use HasFactory;

    protected $table = "employee_application";
    public $timestamps = false;
}
