<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    protected $fillable=[
        'image',
        'name',
        'content',
        'text1_icon',
        'text1_header',
        'text1_content',
        'text2_icon',
        'text2_header',
        'text2_content',
        'text3_icon',
        'text3_header',
        'text3_content',

    ];
}
