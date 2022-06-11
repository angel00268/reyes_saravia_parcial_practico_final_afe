<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'product_name' => 'Refrigeradora',
            'product_description' => 'Refrigeradora mabe',
            'unit_price' => 500,
            'stock' => 20,
            'warranty' => '5 años',
            'seller_id' => 1,
        ]);

        Product::create([
            'product_name' => 'Televisor',
            'product_description' => 'Televisor de 14 pulgadas',
            'unit_price' => 200,
            'stock' => 20,
            'warranty' => '1 año',
            'seller_id' => 2,
        ]);

        Product::create([
            'product_name' => 'Radio',
            'product_description' => 'Equipo de sonido de 300 watts',
            'unit_price' => 300,
            'stock' => 20,
            'warranty' => '2 años',
            'seller_id' => 3,
        ]);

        Product::create([
            'product_name' => 'Tablet',
            'product_description' => 'Tablet de 8 pulgadas',
            'unit_price' => 150,
            'stock' => 20,
            'warranty' => '6 meses',
            'seller_id' => 4,
        ]);
    }
}
