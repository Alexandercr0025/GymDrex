<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $fillable = ['customer_id', 'estado', 'membership_id', 'coach_id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }

    public function coach()
    {
        return $this->belongsTo(Coach::class);
    }
}
