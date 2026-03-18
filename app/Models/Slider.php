<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['title', 'line_1', 'line_2', 'image', 'inset_image', 'icon'];
}
