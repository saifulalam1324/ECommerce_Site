<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory,Notifiable;
    protected $primaryKey = 'customer_id';
    protected $fillable = ['full_name', 'email', 'password'];
    protected $table = 'customers';
}
