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
        $categoryId = [1, 4, 7];
        $size = ['XS', 'S', 'M', 'L', 'XL'];
        $color = ['White', 'Red', 'Yellow', 'Green', 'Blue', 'Black', 'Purple', 'Orange'];

        $productName = ucfirst($color[random_int(0, 7)]) . ' ' . ucfirst($size[random_int(0, 4)]) . ' Product';

        return [
            'name' => $productName,
            'category_id' => $categoryId[random_int(0, 2)],
            'details' => 'Lorem ipsum dolor sit amet Details',
            'price' => random_int(10, 500),
            'size' => $size[random_int(0, 4)],
            'color' => $color[random_int(0, 7)],
            'quantity' => 1,
            'status' => '1',
            'content' => 'Lorem ipsum dolor sit amet Content'
        ];
    }
}
