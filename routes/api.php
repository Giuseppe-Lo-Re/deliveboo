<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// creo la route che ci permette di accedere a tutti gli utenti
Route::get('/{slug}/user', 'Api\UserController@getUser');

// creo la route per la visione di tutti i ristoranti con vuejs
Route::get('/{slug}/menu', 'Api\ProductController@restaurantMenu');

// creo l'api per ottenere tutte le categorie
Route::get('/restaurants-categories', 'Api\CategoryController@getAllCategories');

// creo l'api per ottenere tutti i ristoranti filtrati per categoria
Route::get('/restaurants', 'Api\RestaurantsController@getRestaurantsByCategory');

// Rotte per la gestione dei pagamenti con braintree:
// Rotta che genera il token
Route::get('orders/generate', 'Api\Orders\OrderController@generate');
// Rotta che effettua la transazione
Route::post('orders/make/payment', 'Api\Orders\OrderController@makePayment');

// Rotta per la gestione degli ordini
Route::post('orders', 'Api\Orders\OrderController@store');