<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $primaryKey = 'admin_id';
    protected $fillable = ['admin_name', 'email', 'password'];
    protected $table = 'admins';
}
