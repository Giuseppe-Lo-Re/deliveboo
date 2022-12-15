<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Category;

class PresentationUsersTableSeeder extends Seeder
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
                'email' => 'dim_sum@mail.it',
                'password' => Hash::make('12345678'),
                'business_name' => 'Dim Sum',
                'cover' => null,
                'address' => 'Via Nino Bixio, 29, 20129 Milano MI',
                'vat' => '12345678925',
                'categories' => [1, 2],
            ],
            [
                'email' => 'wang_jao@mail.it',
                'password' => Hash::make('12345678'),
                'business_name' => 'Wang Jao',
                'cover' => null,
                'address' => 'Via Paolo Lomazzo, 16, 20154 Milano MI',
                'vat' => '12345678926',
                'categories' => [1],
            ],
            [
                'email' => 'kensho@mail.it',
                'password' => Hash::make('12345678'),
                'business_name' => 'Keinsho',
                'cover' => null,
                'address' => 'Via dei Mercanti, 16, 10122 Torino TO',
                'vat' => '12345678927',
                'categories' => [2, 10],
            ],
            [
                'email' => 'teikit@mail.it',
                'password' => Hash::make('12345678'),
                'business_name' => 'Teikit',
                'cover' => null,
                'address' => 'Travessera de Gràcia, 50, 08021 Barcelona',
                'vat' => '12345678928',
                'categories' => [2],
            ],
            [
                'email' => 'hundred_burger@mail.it',
                'password' => Hash::make('12345678'),
                'business_name' => 'Hundred Burger',
                'cover' => null,
                'address' => 'Carrer de Misser Mascó, 22, Bajo derecha, 46010 València, Spagna',
                'vat' => '12345678929',
                'categories' => [3],
            ],
            [
                'email' => 'manik@mail.it',
                'password' => Hash::make('12345678'),
                'business_name' => 'Manik - L\'Officina del Burger',
                'cover' => null,
                'address' => 'Via Francesco Corradi, 32, 18038 Sanremo IM',
                'vat' => '12345678930',
                'categories' => [3],
            ],
            [
                'email' => 'himalaya@mail.it',
                'password' => Hash::make('12345678'),
                'business_name' => 'Himalaya\'s Kashmir',
                'cover' => null,
                'address' => 'Via Principe Amedeo, 325/327, 00185 Roma RM',
                'vat' => '12345678931',
                'categories' => [4],
            ],
            [
                'email' => 'moon_india@mail.it',
                'password' => Hash::make('12345678'),
                'business_name' => 'Moon India',
                'cover' => null,
                'address' => 'Via Giuseppe la Masa, 2, 90139 Palermo PA',
                'vat' => '12345678931',
                'categories' => [4, 10],
            ],
            [
                'email' => 'el_pueblo@mail.it',
                'password' => Hash::make('12345678'),
                'business_name' => 'El Pueblo',
                'cover' => null,
                'address' => 'Via Giacinto de Vecchi Pieralice, 34, 00167 Roma RM',
                'vat' => '12345678932',
                'categories' => [7, 3],
            ],
            [
                'email' => 'piedra_del_sol@mail.it',
                'password' => Hash::make('12345678'),
                'business_name' => 'Piedra del Sol',
                'cover' => null,
                'address' => 'Via Emilio Cornalia, 2, 20124 Milano MI',
                'vat' => '12345678933',
                'categories' => [7],
            ],
            [
                'email' => 'da_michele@mail.it',
                'password' => Hash::make('12345678'),
                'business_name' => 'L\'Antica Pizzeria Da Michele',
                'cover' => null,
                'address' => 'Via Cesare Sersale, 1, 80139 Napoli NA',
                'vat' => '12345678934',
                'categories' => [8, 5],
            ],
            [
                'email' => 'pizzeria_gourmet@mail.it',
                'password' => Hash::make('12345678'),
                'business_name' => 'Pizzeria Gourmet Giuseppe Vesi',
                'cover' => null,
                'address' => 'Via Luca Giordano, 162, 80129 Napoli NA',
                'vat' => '12345678935',
                'categories' => [8, 5],
            ],
            [
                'email' => 'romeow_cat_bistrot@mail.it',
                'password' => Hash::make('12345678'),
                'business_name' => 'Romeow Cat Bistrot',
                'cover' => null,
                'address' => 'Via Francesco Negri, 15, 00154 Roma RM',
                'vat' => '12345678936',
                'categories' => [9],
            ],
            [
                'email' => 'soul_kitchen@mail.it',
                'password' => Hash::make('12345678'),
                'business_name' => 'Soul Kitchen - Creatività Vegetale',
                'cover' => null,
                'address' => 'Via Santa Giulia, 2, 10124 Torino TO ',
                'vat' => '12345678937',
                'categories' => [9],
            ],
            [
                'email' => 'casa_vietnam@mail.it',
                'password' => Hash::make('12345678'),
                'business_name' => 'Casa Vietnam',
                'cover' => null,
                'address' => 'Viale Nazario Sauro 5, 20124 Milano',
                'vat' => '12345678938',
                'categories' => [10, 4],
            ],
            [
                'email' => 'thien_kim@mail.it',
                'password' => Hash::make('12345678'),
                'business_name' => 'Ristorante Thien Kim Roof Garden',
                'cover' => null,
                'address' => 'Piazzale di Ponte Milvio 31, RM',
                'vat' => '12345678939',
                'categories' => [10],
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
