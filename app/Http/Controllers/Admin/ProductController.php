<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // salvo in una variabile l'utente al momento loggato
        $user = Auth::user();

        // salvo in $products tutta la lista dei prodotti associati all'utente loggato
        $products = Product::where('user_id', '=', $user->id)->orderBy('name')->get();

        // se $request['product_deleted'] esiste salvo in $product_deleted_confirm
        // il dato e lo passo nei data altrimenti salvo nei data solo $products
        if($request['product_deleted']) {
            $product_deleted_confirm = $request['product_deleted'];
            
            $data = [
                'products' => $products,
                'product_deleted_confirm' => $product_deleted_confirm,
                'user' => $user
            ];
        } else {
            $data = [
                'products' => $products,
                'user' => $user
            ];
        }

        return view('admin.products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        // salvo in una variabile l'utente al momento loggato
        $user = Auth::user();

        $data = [
            'user' => $user
        ];

        return view('admin.products.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validiamo i dati ottenuti dal form
        $request->validate($this->getValidationRules());

        // una volta validati se sono corretti li salviamo in $form_data
        $form_data = $request->all();
        $form_data['cooking_time'] = intval($form_data['cooking_time']);
        $form_data['price'] = floatval($form_data['price']);
        
        // salvo in una variabile l'utente al momento loggato
        $user = Auth::user();
        
        // se $form_data['visible'] è presente, e dunque l'utente ha impostato la input
        // "Disponibilità" su "on" allora converto il dato ottenuto dal form in 1
        if(isset($form_data['visible'])) {
            $form_data['visible'] = 1;
        } else {
            $form_data['visible'] = 0;
        }

        
        // se la chiave $form_data['cover'] è settata salviamo l'immagine nella cartella
        // dishes-cover e salviamo il path dell'immagine in $form_data['cover'] 
        if(isset($form_data['cover'])) {
            $cover_path = Storage::put('dishes-cover', $form_data['cover']);
            $form_data['cover'] = $cover_path;

            $user->product()->create([
                'name' => $form_data['name'],
                'cover' => $form_data['cover'],
                'description' => $form_data['description'],
                'ingredients' => $form_data['ingredients'],
                'cooking_time' => $form_data['cooking_time'],
                'price' => $form_data['price'],
                'visible' => $form_data['visible']
            ]);
        } else {
            $user->product()->create([
                'name' => $form_data['name'],
                'description' => $form_data['description'],
                'ingredients' => $form_data['ingredients'],
                'cooking_time' => $form_data['cooking_time'],
                'price' => $form_data['price'],
                'visible' => $form_data['visible']
            ]);
        }

        // converto la collection $user->product in un array tramite la funzione getArrayFromCollection()
        $new_array = $this->getArrayFromCollection($user->product);

        // mi calcolo l'ultima key(index) dell'array $new_array
        $last_array_key = count($new_array) - 1;

        // passo nel return l'ultimo prodotto creato presente nell'array $new_array
        return redirect()->route('admin.products.show', ['product' => $new_array[$last_array_key]['id'], 'product_created' => 'y']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        // salvo in una variabile l'utente al momento loggato
        $user = Auth::user();

        // converto la collection $user->product in un array tramite la funzione getArrayFromCollection()
        $new_array = $this->getArrayFromCollection($user->product);

        // definisco un array vuoto $ids_array
        $ids_array = [];

        // tramite un ciclo foreach mi salvo l'id di ogni $item nell'array $ids_array
        foreach($new_array as $item) {
            $ids_array[] = $item['id'];
        }

        // mi prendo tramite findOrFail il prodotto da mostrare in pagina tramite $id e lo salvo in $product
        $product = Product::findOrFail($id);

        // se $product->id è presente in $ids_array passo alla view $product
        // altrimenti torno la pagina 404
        if(in_array($product->id, $ids_array)) {

            // se $request['product_created'] esiste:
            // - salvo in $product_created_confirm il dato, lo salvo nei $data con $product e passo alla view i $data
            // - altrimenti salvo nei $data $product e passo alla view i $data
            if($request['product_created']) {
                $product_created_confirm = $request['product_created'];
                
                $data = [
                    'product' => $product,
                    'product_created_confirm' => $product_created_confirm,
                    'user' => $user
                ];
            } else if($request['product_updated']) {
                $product_updated_confirm = $request['product_updated'];
                
                $data = [
                    'product' => $product,
                    'product_updated_confirm' => $product_updated_confirm,
                    'user' => $user
                ];
            } else {
                $data = [
                    'product' => $product,
                    'user' => $user
                ];
            }
        } else {
            return abort('404');
        }

        return view('admin.products.show', $data);
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

        // salvo in $product il prodotto da modificare così da poter mostrare il form della edit precompilato con i dati necessari
        $product = Product::findOrFail($id);

        // salvo nei $data il prodotto
        $data = [
            'product' => $product,
            'user' => $user
        ];

        // se la foreign key/($product->user_id) di $product è uguale all'id
        // dell'utente correntemente registarto mostro il form altrimenti torno la pagina 404
        if($product->user_id === $user->id) {
            return view('admin.products.edit', $data);
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
        $form_data['cooking_time'] = intval($form_data['cooking_time']);
        $form_data['price'] = floatval($form_data['price']);

        // se $form_data['visible'] è presente, e dunque l'utente ha impostato la input
        // "Disponibilità" su "on" allora converto il dato ottenuto dal form in 1
        if(isset($form_data['visible'])) {
            $form_data['visible'] = 1;
        } else {
            $form_data['visible'] = 0;
        }

        // mi salvo in una variabile $user l'utente loggato
        $user = Auth::user();

        // mi salvo in $product_to_update il prodotto da aggiornare
        $product_to_update = Product::findOrFail($id);

        // se la chiave $form_data['cover'] è settata e $product_to_update->cover esiste
        // eliminiamo dalla cartella in locale dishes-cover in storage l'immagine e salviamo la nuova
        // dopodichè salviamo il path dell'immagine in $form_data['cover'] 
        if(isset($form_data['cover'])) {
            if($product_to_update->cover) {
                Storage::delete($product_to_update->cover);
            }
            $cover_path = Storage::put('dishes-cover', $form_data['cover']);
            $form_data['cover'] = $cover_path;
        }

        // se la foreign key/($product_to_update->user_id) di $product_to_update è uguale all'id
        // dell'utente correntemente loggato effettuo l'update del prodotto altrimenti
        // non effettuo alcuna operazione
        if($product_to_update->user_id === $user->id) {
            $product_to_update->update($form_data);

            // una volta effettuato l'update salvo nei data l'id del prodotto modificato
            // e salvo nella key 'product_updated' la stringa 'y'
            $data = [
                'product' => $product_to_update->id,
                'product_updated' => 'y',
            ];

            // e torno la view della show del prodotto
            return redirect()->route('admin.products.show', $data);
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
        // mi salvo in una variabile $user l'utente loggato
        $user = Auth::user();

        // mi salvo in $product_to_update il prodotto da aggiornare
        $product_to_delete = Product::findOrFail($id);

        // se la foreign key/($product_to_delete->user_id) di $product_to_delete è uguale all'id
        // dell'utente correntemente loggato: 
        // - se $product_to_delete->cover esiste eliminiamo dalla cartella in locale dishes-cover, in storage, l'immagine ed effettuiamo il delete()
        // - se $product_to_delete->cover non esiste effettuiamo direttamente il delete()
        // mi salvo in $product_deleted la stringa 'y' se la cancelazione va a buon fine altrimenti 'n'
        if($product_to_delete->user_id === $user->id) {
            if($product_to_delete->cover) {
                Storage::delete($product_to_delete->cover);
            }

            if(isset($product_to_delete->orders)) {
                $product_to_delete->orders()->sync([]);
            }
            
            $product_to_delete->delete();

            $product_deleted = 'y';
        } else {
            $product_deleted = 'n';
        }
        
        // mi salvo nei $data $product_deleted e lo passo alla route()
        $data = [
            'product_deleted' => $product_deleted
        ];

        return redirect()->route('admin.products.index', $data);
    }

    // funzione per validare i dati del form
    public function getValidationRules() {
        return [
            'name' => ['required', 'string', 'max:255'],
            'cover' => ['file', 'mimes:jpeg,jpg,bmp,png', 'max:15000', 'nullable'],
            'description' => ['max:60000', 'nullable'],
            'ingredients' => ['max:60000', 'nullable'],
            'cooking_time' => ['max:2', 'nullable'],
            'price' => ['required', 'numeric', 'between: 0.01, 999.99'],
        ];
    }

    // funzione per convertire una collection in un array
    public function getArrayFromCollection($collection) {
        return $collection->toArray();
    }
}
