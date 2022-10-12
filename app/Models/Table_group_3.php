<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Table_group_3 extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'table_group_3';
    protected $primaryKey = 'table_group_3_id';
    protected $fillable = [
        'table_group_3_name', 
        'table_group_3_zone' 
    ];

  
}
