<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['date','amount', 'obligation_id', 'type','category_id'];


    public function obligation(){
        return $this->belongsTo(Obligation::class);
    }

    public function category(){
        return $this->belongsTo(PaymentCategory::class);
    }

    public function type(){
        return $this->belongsTo(PaymentType::class);
    }
}
