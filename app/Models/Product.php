<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Product extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'category_id',
        'details',
        'price',
        'size',
        'color',
        'quantity',
        'status',
        'content'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
