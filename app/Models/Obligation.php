<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obligation extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id','payment_peroid','total_amount'];

    public function payments(){
        return $this->belongsToMany(Payment::class, table:'obligation_payments')->withTimestamps();
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
    }

}
