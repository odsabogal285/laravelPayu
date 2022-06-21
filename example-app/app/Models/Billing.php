<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Billing extends Model
{
    use HasFactory;
    public function user(): hasOne
    {
        return $this->hasOne(User::class);
        // hasOne - belongsTo
    }
   /* public function autorizadoPor()
    {
        return $this->hasOne(User::class,   'autorizado_por');
        // hasOne - belongsTo
        // modelo nunca deben ser verbos
    }
   */
}
