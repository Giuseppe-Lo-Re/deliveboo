<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\User;

class ProductController extends Controller
{
    public function restaurantMenu($slug){

        $user = User::where('slug', '=', $slug)->first();
        
        // richiamo i prodotti dal database e gli assegno una quesry che li seleziona solo se la colonna user_id che si trova in product presenta lo stesso id
        $products = Product::where('user_id', '=', $user->id)->get();
    
        foreach($products as $product){
            
            if($product->cover){
            
                $product->cover = asset('storage/' . $product->cover);	
            }
        }

        // li inserisco in un $data
        $data = [
            'success' => true,
            'results' => $products,
        ];

        // trasferisco i dati in formato json
        return response()->json($data);
    }
}
