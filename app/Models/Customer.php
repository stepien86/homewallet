<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['title','name','account','is_active'];

    public function obligations(){
        return $this->hasMany(Obligation::class);
    }
}