<?php

namespace App\Http\Controllers\Api\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Http\Requests\Orders\OrderRequest;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Order;
use App\Product;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewOrderUserMail;
use App\Mail\NewOrderCustomerMail;


class OrderController extends Controller
{
    public function generate(Request $request,Gateway $gateway) {

       // Genero il token
       $token = $gateway->clientToken()->generate();

       $data = [
            'success' => true,
            'token' => $token
        ];

        return response()->json($data,200);
    }

    public function makePayment(OrderRequest $request,Gateway $gateway) {

        // Simulo una transazione, passandogli nella vendita un importo e un token che il frontend
        // invierà in risposta alla chiamata API makePayment
        $result = $gateway->transaction()->sale([
            'amount' => $request->amount,
            'paymentMethodNonce' => 'fake-valid-nonce',
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if($result->success) {
            $data = [
                'success' => true,
                'message' => "Transazione eseguita con Successo!"
            ];
            return response()->json($data,200);
        }else {
            $data = [
                'success' => false,
                'message' => "Transazione Fallita!"
            ];
            return response()->json($data,401);
        }
    }

    public function store(Request $request, Faker $faker) {

        // salvo i dati dell'utente
        $data = $request->all();
        
        // Ricalcolo l'importo totale dell'ordine(in quanto lato fronte-end è modificabile)
        $total_amount = 0;

        // Salvo in una variabile ogni singolo dato
        $order_cart = $data['order_cart'];
        $customer_name = $data['order_customerName'];
        $customer_mail = $data['order_customerEmail'];
        $customer_phone = $data['order_customerPhoneNumber'];
        $customer_address = $data['order_customerAddress'];
        $user_id = $order_cart[0]['user_id'];

        for ($i=0; $i < count($order_cart); $i++) { 
            $total_amount += floatval($order_cart[$i]['price']) * intval($order_cart[$i]['quantity']);
        }

        $products_ids_array = [];

        // Salvo in un array tutti gli id dei prodotti nel carrello
        for($i = 0; $i < count($order_cart); $i++) {
            $products_ids_array[] = $order_cart[$i]['id'];
        }

        $product_quantity_array = [];

        for($i = 0; $i < count($order_cart); $i++) {
            $product_quantity_array[] = $order_cart[$i]['quantity'];
        }


        // Salvo in una variabile la query raw con  tutti gli numeri ordine dalla tabella "orders" 
        $sql_query = 'SELECT order_number FROM orders';
        // e salvo in una variabile tutti i numeri ordine selezionati
        $order_numbers = DB::select($sql_query);
        
        $order_number_array = [];
        
        // ciclo tutti i numeri d'ordine e li conservo in un array
        for($i = 0; $i < count($order_numbers); $i++) {
            $order_number_array[] = $order_numbers[$i]->order_number;
        }
        
        $start_condition = true;
        $order_number;

        // genero delle numero random e li salvo nell'array a condizione che esistano già nell'array
        while ($start_condition) {
            // genero un numero casuale unico per il numero d'ordine
            $order_number = $faker->numberBetween(100000000000000, 999999999999999);
            // Se il numero d'ordine è non presente nel l'array dei numeri d'ordine
            if(!in_array($order_number, $order_number_array)) {
                $start_condition = false;
            } 
        }

        // Salvo i dati nel database
        $new_order = new Order();
        $new_order->user_id = $user_id;
        $new_order->total_amount = $total_amount;
        $new_order->order_number = $order_number;
        $new_order->customer_name = $customer_name;
        $new_order->customer_mail = $customer_mail;
        $new_order->customer_address = $customer_address;
        $new_order->customer_phone_number = $customer_phone;
        $new_order->save();

        // Eseguo un ciclo for per la lunghezza di "$products_ids_array" e per ogni iterazione 
        // associo l'id del prodotto presente in "$products_ids_array" e la sua relativa quantità salvata in "$product_quantity_array"
        for ($i=0; $i < count($products_ids_array); $i++) { 
            $new_order->products()->attach($products_ids_array[$i], ['quantity' => $product_quantity_array[$i]]);
        }

        $user = User::findOrFail($user_id);

        Mail::to('hilary.lion@gmail.com')->send(new NewOrderUserMail($new_order, $user));
        Mail::to('hilary.lion@gmail.com')->send(new NewOrderCustomerMail($new_order, $user));
        



        return response()->json([
            'success' => true
        ]);
    }
}


