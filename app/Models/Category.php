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

    public function subCategory(){
        return $this->hasMany(Category::class, 'cat_child', 'id');
    }

    public function category(){
        return $this->hasOne(Category::class,  'id','cat_child');
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
