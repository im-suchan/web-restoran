<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class MenuController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('menu', compact('products'));
    }

    public function kategori($kategori)
    {
        $products = Product::where('category', $kategori)->get();
        return view('menu', compact('products'));
    }
}