<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Product::create([
           'name'=>'Product 1',
           'image'=>'front/images/cloth_1.jpg',
           'category_id'=>1,
           'details'=>'Short details',
           'price'=>100,
           'size'=>'Small',
           'color'=>'White',
           'quantity'=>'10',
           'status'=>'1',
           'content'=>'defkrfkkgtrjltrjklrgjtrkjhktrjkhgfkhj',
        ]);

        Product::create([
            'name'=>'Product 2',
            'image'=>'front/images/cloth_2.jpg',
            'category_id'=>2,
            'details'=>'Short details',
            'price'=>150,
            'size'=>'Large',
            'color'=>'Red',
            'quantity'=>5,
            'status'=>'1',
            'content'=>'defkrfkkgtrjltrjklrgjtrkjhktrjkhgfkhjeee',
        ]);
    }
}
