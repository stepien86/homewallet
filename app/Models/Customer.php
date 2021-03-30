<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['title','name','account','is_active', 'reminder', 'default_amount'];

    public function obligations(){
        return $this->hasMany(Obligation::class);
    }
}
