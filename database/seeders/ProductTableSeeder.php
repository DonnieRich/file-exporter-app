<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            $new_product = new Product();
            $new_product->name = $faker->word();
            $new_product->description = $faker->text(100);
            $new_product->quantity = $faker->numberBetween(0, 50);
            $new_product->price = $faker->randomFloat(2, 5, 300);
            $new_product->save();
        }
    }
}
