<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

     protected $table = 'transactions';

    protected $fillable = [
        'customer_id','balance','amount',
        'transaction_type','transaction_details','transfer_from','transfer_to'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

     public static function getTableName()
    {
        return with(new static)->getTable();
    }
}
