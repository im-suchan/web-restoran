<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Makanan; // Pastikan model Makanan sudah dibuat

class HomeController extends Controller
{
    /**
     * Menampilkan halaman beranda
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil data makanan terlaris (contoh: 3 makanan dengan rating tertinggi)
        $makanan = Makanan::all();
        return view('home', [
            'makanan' => $makanan
        ]);
    }
}