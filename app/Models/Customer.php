<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
     
    protected $table = 'customers';

    protected $fillable = [
        'name',
        'email','password','balance'
    ];

     public static function getTableName()
    {
        return with(new static)->getTable();
    }
}
