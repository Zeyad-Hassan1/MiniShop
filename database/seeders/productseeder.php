<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\products;

class productseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        products::create([
            'name'=>'iphone 16 promax',
            'description'=>'The iPhone 16 Pro and iPhone 16 Pro Max are smartphones developed and marketed by Apple. Alongside the iPhone 16 and iPhone 16 Plus, they form the eighteenth generation of the iPhone, succeeding the iPhone 15 Pro and iPhone 15 Pro Max, and were announced on September 9, 2024, and released on September 20, 2024. The iPhone 16 Pro and iPhone 16 Pro Max include a larger 6.3-inch and 6.9-inch display, a faster processor, upgraded wide and ultra-wide cameras, support for Wi-Fi 7, larger batteries, and come pre-installed with iOS 18. They were discontinued on September 9, 2025, following the announcement of the iPhone 17 Pro and 17 Pro Max.[6]',
            'price'=>45000,
            'image'=>'defualt.png'
        ]);
    }
}
