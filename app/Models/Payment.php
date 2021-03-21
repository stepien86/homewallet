<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['date','amount', 'type','category_id'];


    public function obligations(){
        return $this->belongsToMany(Obligation::class, table:'obligation_payments')->withTimestamps();
    }

    public function category(){
        return $this->belongsTo(PaymentCategory::class);
    }

    public function type(){
        return $this->belongsTo(PaymentType::class);
    }
}
