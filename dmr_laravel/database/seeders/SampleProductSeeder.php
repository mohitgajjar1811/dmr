<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class SampleProductSeeder extends Seeder
{
    public function run(): void
    {
        // Sample Products
        $products = [
            [
                'name' => 'Heavy Duty Industrial Lathe',
                'description' => 'Precision engineering lathe for industrial applications.',
                'specification' => 'Max diameter: 500mm, Power: 5kW',
                'main_image' => 'products/sample_lathe.jpg',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Automatic Voltage Regulator',
                'description' => 'High-stability voltage regulation for sensitive equipment.',
                'specification' => 'Range: 160V-280V, Output: 230V +/- 1%',
                'main_image' => 'products/sample_avr.jpg',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Digital Multimeter Pro',
                'description' => 'Professional grade multimeter with data logging.',
                'specification' => 'Accuracy: 0.05%, Bluetooth connectivity',
                'main_image' => 'products/sample_multimeter.jpg',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Industrial Safety Harness',
                'description' => 'Five-point safety harness for high-altitude work.',
                'specification' => 'Material: High-tensile nylon, EN361 certified',
                'main_image' => 'products/sample_harness.jpg',
                'is_featured' => true,
                'is_active' => true,
            ],
        ];

        foreach ($products as $pData) {
            $pData['slug'] = Str::slug($pData['name']);
            Product::create($pData);
        }
    }
}
