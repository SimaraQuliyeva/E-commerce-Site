<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Category extends Model
{
    use HasFactory;
    use Sluggable;
    protected $fillable = [
        'image',
        'thumbnail',
        'name',
        'slug',
        'content',
        'cat_child',
        'status'
    ];

    public function products(){
        return $this->hasMany(Product::class, 'category_id', 'id');
    }


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
