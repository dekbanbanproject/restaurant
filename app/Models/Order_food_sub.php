<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Order_food_sub extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'order_food_sub';
    protected $primaryKey = 'order_food_sub_id';
    protected $fillable = [
        'order_food_id', 
        'menukitchen_id' 
    ];

  
}
