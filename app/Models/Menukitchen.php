<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Menukitchen extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'menukitchen';
    protected $primaryKey = 'menukitchen_id';
    protected $fillable = [
        'menukitchen_name', 
        'menukitchen_pricecost' 
    ];

  
}
