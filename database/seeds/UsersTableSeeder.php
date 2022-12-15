<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Category;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'email' => 'maki@mail.it',
                'password' => Hash::make('12345678'),
                'business_name' => 'Maki',
                'cover' => null,
                'address' => 'Via Cremona 8, RM',
                'vat' => '12345678910',
                'categories' => [1, 2],
            ],
            [
                'email' => 'tyler@mail.it',
                'password' => Hash::make('12345678'),
                'business_name' => 'Tyler',
                'cover' => null,
                'address' => 'Piazzale di Ponte Milvio 31, RM',
                'vat' => '12345678911',
                'categories' => [3],
            ],
            [
                'email' => 'pizzium@mail.it',
                'password' => Hash::make('12345678'),
                'business_name' => 'Pizzium',
                'cover' => null,
                'address' => 'Via Piave 9, RM',
                'vat' => '12345678912',
                'categories' => [8],
            ],
            [
                'email' => 'ami_poke@mail.it',
                'password' => Hash::make('12345678'),
                'business_name' => 'Ami Poké',
                'cover' => null,
                'address' => 'Via della Madonna dei Monti 38, RM',
                'vat' => '12345678913',
                'categories' => [1, 2, 9],
            ],
            [
                'email' => 'smash_tag@mail.it',
                'password' => Hash::make('12345678'),
                'business_name' => 'Smash Tag',
                'cover' => null,
                'address' => 'Via Michele di Lando 22/24, RM',
                'vat' => '12345678914',
                'categories' => [3],
            ],
            [
                'email' => 'neko_sushi@mail.it',
                'password' => Hash::make('12345678'),
                'business_name' => 'Neko Sushi',
                'cover' => null,
                'address' => 'Via Nomentana 861/A, RM',
                'vat' => '12345678915',
                'categories' => [1, 2],
            ],
            [
                'email' => 'tiki111@mail.it',
                'password' => Hash::make('12345678'),
                'business_name' => 'Tiki 111',
                'cover' => null,
                'address' => 'V.le America 111, RM',
                'vat' => '12345678916',
                'categories' => [2],
            ],
            [
                'email' => 'pizzarium_bonci@mail.it',
                'password' => Hash::make('12345678'),
                'business_name' => 'Pizzarium Bonci',
                'cover' => null,
                'address' => 'Via della Meloria 43, RM',
                'vat' => '12345678917',
                'categories' => [8],
            ],
            [
                'email' => 'mcdonalds@mail.it',
                'password' => Hash::make('12345678'),
                'business_name' => 'McDonald\'s',
                'cover' => null,
                'address' => 'Piazza Regina Margherita 15, RM',
                'vat' => '12345678918',
                'categories' => [3],
            ],
            [
                'email' => 'mex&tex@mail.it',
                'password' => Hash::make('12345678'),
                'business_name' => 'Mex & Tex',
                'cover' => null,
                'address' => 'Via del Quartaccio 28, RM',
                'vat' => '12345678919',
                'categories' => [3, 7],
            ],
            [
                'email' => 'aromaticus@mail.it',
                'password' => Hash::make('12345678'),
                'business_name' => 'Aromaticus',
                'cover' => null,
                'address' => 'Via Urbana 134, RM',
                'vat' => '12345678920',
                'categories' => [9],
            ],
            [
                'email' => 'maharajah@mail.it',
                'password' => Hash::make('12345678'),
                'business_name' => 'Maharajah',
                'cover' => null,
                'address' => 'Via dei Serpenti 124, RM',
                'vat' => '12345678921',
                'categories' => [4],
            ],
            [
                'email' => 'sancho_pizza@mail.it',
                'password' => Hash::make('12345678'),
                'business_name' => 'Sancho Pizza',
                'cover' => null,
                'address' => 'Via della Torre Clementina 142, RM',
                'vat' => '12345678922',
                'categories' => [8],
            ],
            [
                'email' => 'pho1@mail.it',
                'password' => Hash::make('12345678'),
                'business_name' => 'Pho 1',
                'cover' => null,
                'address' => 'Via Merulana 115, RM',
                'vat' => '12345678923',
                'categories' => [10],
            ],
            [
                'email' => 'yallayalla@mail.it',
                'password' => Hash::make('12345678'),
                'business_name' => 'Yalla Yalla',
                'cover' => null,
                'address' => 'Via Cavour 291, RM',
                'vat' => '12345678924',
                'categories' => [6],
            ],
        ];

        foreach($users as $_user) {
            $user = new User();
            $user->email = $_user['email'];
            $user->password = $_user['password'];
            $user->business_name = $_user['business_name'];
            $user->cover = $_user['cover'];
            $user->address = $_user['address'];
            $user->vat = $_user['vat'];
            $user->slug = $this->getSlugFromBusinessName($_user['business_name']);
            $user->save();
            $user->categories()->sync($_user['categories']);
        }
        
    }

    protected function getSlugFromBusinessName($business_name) {

        // saving in a variable the slugged version of the $business_name
        $slug_to_save = Str::slug($business_name, '-');

        // saving the base version of the slugged title in a variable
        $base_slug = $slug_to_save;

        // check if the slug already exists in the database
        $existing_slug = User::where('slug', '=', $slug_to_save)->first();

        // setting the while '$counter' to 1
        $counter = 1;

        // start a while cycle untill '$existing_slug' is !== null
        while($existing_slug) {
            // appending the '$counter' to '$slug_to_save'
            $slug_to_save = $base_slug . '-' . $counter;

            // check if even the slug with the '$counter' appended exists in the database
            $existing_slug = User::where('slug', '=', $slug_to_save)->first();

            // if not we increment the '$counter' and we "restart" the while cycle
            $counter++;
        }

        // when the '$existing_slug' is !== null we return '$slug_to_save'
        return $slug_to_save;
    }
}
