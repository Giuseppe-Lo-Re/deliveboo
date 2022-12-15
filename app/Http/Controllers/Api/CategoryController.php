<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function getAllCategories() {
        
        // salvo in "$categories" tutte le categorie
        $categories = Category::all();

        // salvo le categorie nei $data
        $data = [
            'success' => true,
            'results' => $categories,
        ];

        // e converto i dati ottenuti in Json
        return response()->json($data);
    }
}
