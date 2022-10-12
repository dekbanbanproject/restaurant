<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Table_group_2 extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'table_group_2';
    protected $primaryKey = 'table_group_2_id';
    protected $fillable = [
        'table_group_2_name', 
        'table_group_2_zone' 
    ];

  
}
