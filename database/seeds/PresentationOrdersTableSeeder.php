<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;
use App\Order;
use App\Product;

class PresentationOrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $faker->addProvider(new \Faker\Provider\en_US\Person($faker));

        $user_products = [
            [151, 152, 153, 154, 155],
            [156, 157, 158, 159, 160, 161],
            [162, 163, 164, 165, 166, 167],
            [168, 169, 170, 171, 172, 173],
            [174, 175, 176, 177, 178, 179, 180, 181, 182, 183, 184, 185],
            [186, 187, 188, 189, 190, 191, 192, 193, 194, 195, 196, 197],
            [198, 199, 200, 201, 202, 203],
            [204, 205, 206, 207],
            [208, 209, 210],
            [211, 212, 213, 214],
            [215, 216, 217],
            [218, 219, 220],
            [221, 222, 223],
            [224, 225, 226],
            [227, 228, 229, 230, 231],
            [232, 233, 234]
        ];

        $user_id = 16;

        $counter = 0;

        for($i = 0; $i < 8000; $i++) {

            $user_array = $user_products[$counter];

            $order = new Order();
            $order->user_id = $user_id;
            $order->total_amount = $faker->randomFloat(2, 20, 400);
            $order->order_number = $faker->numberBetween(100000000000000, 999999999999999);
            $order->customer_name = $faker->firstName($gender = $faker->randomElements(['male', 'female'])) . '' . $faker->lastName();
            $order->customer_mail = $faker->freeEmail();
            $order->customer_address = $faker->address();
            $order->customer_phone_number = $faker->phoneNumber();
            $order->created_at = $faker->dateTimeBetween('-3 year','now');
            $order->save();

            $rand_ids_array = $faker->randomElements($user_array, rand(1, count($user_array)));

            $ids_collection = collect($rand_ids_array)->mapWithKeys(function ($single_id) {
                return [$single_id => ['quantity' => rand(1, 5)]];
            });

            $order->products()->sync($ids_collection, $rand_ids_array);

            if($i === 499 || $i === 999 || $i === 1499 || $i === 1999 || $i === 2499 || $i === 2999 || $i === 3499 || $i === 3999 || $i === 4499 || $i === 4999 || $i === 5499 || $i === 5999 || $i === 6499 || $i === 6999 || $i === 7499) {
                
                ++$counter;
                ++$user_id;
            }
        }
    }

    // public function generateRandomName($faker) {

    //     $faker->addProvider(new \Faker\Provider\en_US\Person($faker));
            
    //     $first_name = $faker->firstName($gender = $faker->randomElements(['male', 'female']));
    //     $last_name = $faker->lastName();

    //     return $first_name . '' . $last_name;
    // }
}
