<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    protected $table = 'recommendations';
    protected $fillable = ['user_id', 'product_id', 'score'];
    protected $primaryKey = 'id';
}
