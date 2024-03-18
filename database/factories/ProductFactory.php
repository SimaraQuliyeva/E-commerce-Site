<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categoryId=[1,2,3,4,5,6,7,8,9];
        $size=['S', 'M', 'L', 'XS', 'XL'];
        $color=['White', 'Red', 'Yellow', 'Green', 'Blue', 'Black', 'Purple', 'Orange'];
        return [
            'name'=>fake()->word(),
            'category_id'=>$categoryId[random_int(0,8)],
            'details'=>'Lorem ipsum dolor sit amet Details',
            'price'=>random_int(10,500),
            'size'=>$size[random_int(0,4)],
            'color'=>$color[random_int(0,7)],
            'quantity'=>1,
            'status'=>'1',
            'content'=>'Lorem ipsum dolor sit amet Content'
        ];
    }
}
