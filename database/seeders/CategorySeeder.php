<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $man= Category::create([
            'image'=>null,
            'thumbnail'=>null,
            'name'=>'man',
            'content'=>'man clothes',
            'cat_child'=>null,
            'status'=>'1'
        ]);

        Category::create([
            'image'=>null,
            'thumbnail'=>null,
            'name'=>'man shirt',
            'content'=>'man shirts',
            'cat_child'=>$man->id,
            'status'=>'1'
        ]);

        Category::create([
            'image'=>null,
            'thumbnail'=>null,
            'name'=>'man trousers',
            'content'=>'man trousers',
            'cat_child'=>$man->id,
            'status'=>'1'
        ]);


        $woman= Category::create([
            'image'=>null,
            'thumbnail'=>null,
            'name'=>'woman',
            'content'=>'woman clothes',
            'cat_child'=>null,
            'status'=>'1'
        ]);

        Category::create([
            'image'=>null,
            'thumbnail'=>null,
            'name'=>'woman skirt',
            'content'=>'woman skirts',
            'cat_child'=>$woman->id,
            'status'=>'1'
        ]);

        Category::create([
            'image'=>null,
            'thumbnail'=>null,
            'name'=>'woman bag',
            'content'=>'woman bags',
            'cat_child'=>$woman->id,
            'status'=>'1'
        ]);


       $child= Category::create([
            'image'=>null,
            'thumbnail'=>null,
            'name'=>'child',
            'content'=>'child clothes',
            'cat_child'=>null,
            'status'=>'1'
        ]);

        Category::create([
            'image'=>null,
            'thumbnail'=>null,
            'name'=>'child body',
            'content'=>'child bodies',
            'cat_child'=>$child->id,
            'status'=>'1'
        ]);
        Category::create([
            'image'=>null,
            'thumbnail'=>null,
            'name'=>'child toy',
            'content'=>'child toys',
            'cat_child'=>$child->id,
            'status'=>'1'
        ]);

    }
}
