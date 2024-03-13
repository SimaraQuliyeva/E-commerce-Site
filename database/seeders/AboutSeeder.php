<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::create([
            'name' => 'How We Started new',
            'content' => ' new Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius repellat, dicta at laboriosam, nemo exercitationem itaque eveniet architecto cumque, deleniti commodi molestias repellendus quos sequi hic fugiat asperiores illum. Atque, in, fuga excepturi corrupti error corporis aliquam unde nostrum quas.
Accusantium dolor ratione maiores est deleniti nihil? Dignissimos est, sunt nulla illum autem in, quibusdam cumque recusandae, laudantium minima repellendus.',
            'text1_icon'=>'icon-truck',
            'text1_header'=>'FREE SHIPPING',
            'text1_content'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at iaculis quam. Integer
                            accumsan tincidunt fringilla.',
            'text2_icon'=>'icon-refresh2',
            'text2_header'=>'Free Returns',
            'text2_content'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at iaculis quam. Integer
                            accumsan tincidunt fringilla.',
            'text3_icon'=>'icon-help',
            'text3_header'=>'Customer Support',
            'text3_content'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at iaculis quam. Integer
                            accumsan tincidunt fringilla.',

        ]);
    }
}
