<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gallary_images extends Model
{
    use HasFactory;
    protected $fillable= ['user_id', 'caption', 'category','image'];

}
