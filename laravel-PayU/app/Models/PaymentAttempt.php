<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentAttempt extends Model
{
    use HasFactory;
    // protected $table = 'payment_attempts';

    protected $fillable = [
        'bill_id',
        'value',
        'details',
        'reference_pol', 
        'reference_sale'
    ];
}
