<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Vendor extends Authenticatable
{
    use HasFactory,Notifiable;
    protected $primaryKey = 'vendor_id';
    protected $fillable = ['company_name', 'email', 'password', 'approve_status'];
    protected $table = 'vendors';
}
