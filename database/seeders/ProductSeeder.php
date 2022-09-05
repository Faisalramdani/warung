<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Product::Create(
            [
                'name' => 'Aqua',
                'description' => 'admin',
                'image'=>'/products/Bt01Kxbk5Eoyj4r8FlQgvC0WY9nywwyg3M3K9Lez.png',
                'barcode'=> 2,
                'price_buy' => 25000,
                'price' => 50000,
                'quantity' => 50,
                'status' => 1,
            ]);
    }
}
