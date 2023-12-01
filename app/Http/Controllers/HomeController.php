<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Log;



class HomeController extends Controller
{
    public function home(Request $request) {
        $items = Item::all();

        $request->session()->put('color', "all");
        $request->session()->put('category', "None");
        $request->session()->put('orderBy', "None");
        $request->session()->put('price', "null");
        $request->session()->put('inStock', true); 

        return view('pages.home', [
            'items' => $items,
            'totalItems' => $items->count()
        ]);
    }
    
}
