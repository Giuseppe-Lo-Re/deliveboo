<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;
use App\Order;
use App\Product;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $faker->addProvider(new \Faker\Provider\en_US\Person($faker));

        $ids_array = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

        $user_id = 1;

        for($i = 0; $i < 750; $i++) {
            $order = new Order();
            $order->user_id = $user_id;
            $order->total_amount = $faker->randomFloat(2, 20, 300);
            $order->order_number = $faker->numberBetween(100000000000000, 999999999999999);
            $order->customer_name = $faker->firstName($gender = $faker->randomElements(['male', 'female'])) . '' . $faker->lastName();;
            $order->customer_mail = $faker->freeEmail();
            $order->customer_address = $faker->address();
            $order->customer_phone_number = $faker->phoneNumber();
            $order->created_at = $faker->dateTimeBetween('-3 year','now');
            $order->save();

            $rand_ids_array = $faker->randomElements($ids_array, rand(1, 10));

            $ids_collection = collect($rand_ids_array)->mapWithKeys(function ($single_id) {
                return [$single_id => ['quantity' => rand(1, 5)]];
            });

            $order->products()->sync($ids_collection, $rand_ids_array);

            if($i === 49 || $i === 99 || $i === 149 || $i === 199 || $i === 249 || $i === 299 || $i === 349 || $i === 399 || $i === 449 || $i === 499 || $i === 549 || $i === 599 || $i === 649 || $i === 699) {
                for($j = 0; $j < count($ids_array); $j++) {
                    $new_id = $ids_array[$j] + 10;
                    $ids_array[$j] = $new_id;
                }
                ++$user_id;
            }
        }
    }
}