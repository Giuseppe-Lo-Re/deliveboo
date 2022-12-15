<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function getUser($slug){

        $user = User::where('slug' ,'=', $slug)->first();

        if($user->cover){
        
            $user->cover = asset('storage/' . $user->cover);	
        }

        $data = [
            'success' => true,
            'results' => $user
        ];

        return response()->json($data);
        
    }
}
