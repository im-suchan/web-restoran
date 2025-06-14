<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.produk.index', compact('products'));
    }

    public function create()
    {
        $kategori = ['Daging', 'Sayuran', 'Minuman'];
        return view('admin.produk.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori' => 'required',
            'nama' => 'required|string|max:255',
            'detail' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
        ]);

        $produk = new Product();
        $produk->category = $request->kategori;
        $produk->nama = $request->nama;
        $produk->detail = $request->detail;
        $produk->harga = $request->harga;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('produk', 'public');
            $produk->foto = $foto;
        }

        $produk->save();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil disimpan');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $kategori = ['Daging', 'Sayuran', 'Minuman'];
        return view('admin.produk.edit', compact('product', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori' => 'required',
            'nama' => 'required|string|max:255',
            'detail' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
        ]);

        $product = Product::findOrFail($id);
        $product->category = $request->kategori;
        $product->nama = $request->nama;
        $product->detail = $request->detail;
        $product->harga = $request->harga;

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($product->foto && Storage::disk('public')->exists($product->foto)) {
                Storage::disk('public')->delete($product->foto);
            }
            
            $foto = $request->file('foto')->store('produk', 'public');
            $product->foto = $foto;
        }

        $product->save();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diupdate');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Hapus file foto jika ada
        if ($product->foto && Storage::disk('public')->exists($product->foto)) {
            Storage::disk('public')->delete($product->foto);
        }

        $product->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}