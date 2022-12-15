<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // mi salvo in una variabile $user l'utente loggato
        $user = Auth::user();

        // salvo nei $data il prodotto
        $data = [
            'user' => $user,
        ];

        // se la variabile $id convertita in numero è uguale all'id
        // dell'utente correntemente registarto mostro il form altrimenti torno la pagina 404
        if(intval($id) === $user->id) {
            return view('admin.users.edit', $data);
        } else {
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        // validiamo i dati ottenuti dal form
        $request->validate($this->getValidationRules());
        
        // una volta validati se sono corretti li salviamo in $form_data
        $form_data = $request->all();

        // mi salvo in una variabile $user l'utente loggato
        $user = Auth::user();

        // mi salvo in $product_to_update il prodotto da aggiornare
        $user_to_update = User::findOrFail($id);

        // se la chiave $form_data['cover'] è settata e $user_to_update->cover esiste
        // eliminiamo dalla cartella in locale restaurants-cover in storage l'immagine e salviamo la nuova
        // dopodichè salviamo il path dell'immagine in $form_data['cover'] 
        if(isset($form_data['cover'])) {
            if($user_to_update->cover) {
                Storage::delete($user_to_update->cover);
            }
            $cover_path = Storage::put('restaurants-cover', $form_data['cover']);
            $form_data['cover'] = $cover_path;
        }

        if($form_data['business_name'] !== $user_to_update->business_name) {
            // assegno alla colonna slug di users lo slug generato dalla funzione getSlugFromBusinessName() passandogli $data['business_name']
            $user_to_update->slug = $this->getSlugFromBusinessName($form_data['business_name']);
        }
        
        // se l'id dell'utente da modificare è uguale all'id
        // dell'utente correntemente registarto mostro il form altrimenti torno la pagina 404
        if($user_to_update->id === $user->id) {
            $user_to_update->update($form_data);

            // una volta effettuato l'update salvo nei data l'utente modificato
            // e salvo nella key 'user_updated' la stringa 'y'
            $data = [
                'user' => $user_to_update,
                'user_updated' => 'y',
            ];

            return redirect()->route('admin.home', $data);
        } else {
            return abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // funzione per validare i dati del form
    public function getValidationRules() {
        return [
            'business_name' => ['required', 'string', 'max:255'],
            'cover' => ['file', 'mimes:jpeg,jpg,bmp,png', 'max:15000', 'nullable'],
            'address' => ['required', 'max:60000'],
            'vat' => ['required', 'string', 'max:20'],
        ];
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
