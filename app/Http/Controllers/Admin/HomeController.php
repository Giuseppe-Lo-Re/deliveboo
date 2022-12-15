<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request) {
        
        // se $request['user_updated'] esiste:
        // - salvo in $user_updated_confirm il dato, lo salvo nei $data con $user e passo alla view i $data
        // - altrimenti salvo nei $data $user e passo alla view i $data
        if($request['user_updated']) {
            
            $user_updated_confirm = $request['user_updated'];
            
            $user = User::findOrFail($request['user']);

            $data = [
                'user_updated_confirm' => $user_updated_confirm,
                'user' => $user
            ];

        } else {
            $user = Auth::user();

            $data = [
                'user' => $user
            ];
        } 

        return view('admin.home', $data);
    }
}
