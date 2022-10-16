<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Menukitchen_category extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'menukitchen_category';
    protected $primaryKey = 'menukitchen_category_id';
    protected $fillable = [
        'menukitchen_category_name' 
    ];

  
}
