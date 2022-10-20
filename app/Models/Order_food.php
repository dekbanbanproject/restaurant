<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Order_food extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'order_food';
    protected $primaryKey = 'order_food_id';
    protected $fillable = [
        'order_food_date', 
        'order_food_sumprice' 
    ];

  
}
