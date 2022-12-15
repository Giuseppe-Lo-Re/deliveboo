<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use FakerRestaurant\Restaurant;
use App\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $faker->addProvider(new \FakerRestaurant\Provider\it_IT\Restaurant($faker));

        $counter = 1;

        for($i = 1; $i < 150 + 1; $i++) {
            $product = new Product();
            $product->name = $faker->foodName();
            $product->cover = null;
            $product->description = $faker->text(250);
            $product->ingredients = $faker->text(100);
            $product->cooking_time = rand(1, 20);
            $product->price = rand(1, 30);
            $product->visible = rand(0, 1);
            $product->user_id = $counter;
            $product->save();
            

            if($i === 10 || $i === 20 || $i === 30 || $i === 40 || $i === 50 || $i === 60 || $i === 70 || $i === 80 || $i === 90 || $i === 100 || $i === 110 || $i === 120 || $i === 130 || $i === 140) {
                ++$counter;
            }
        }
    }
}
