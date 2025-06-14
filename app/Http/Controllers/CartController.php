<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class CartController extends Controller
{
    /**
     * Menampilkan halaman keranjang belanja.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('keranjang', compact('cart'));
    }

    /**
     * Menambahkan produk ke keranjang.
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $productId = $request->input('product_id');
        $product = Product::findOrFail($productId);
        $cart = session()->get('cart', []);

        // Jika produk sudah ada di keranjang, tambahkan kuantitasnya
        if (isset($cart[$productId])) {
            $cart[$productId]['qty']++;
        } else {
            // Jika belum ada, tambahkan produk baru
            $cart[$productId] = [
                "id"    => $product->id,
                "nama"  => $product->nama,
                "qty"   => 1,
                "harga" => $product->harga,
                "foto"  => $product->foto, // Menggunakan 'foto' sesuai dengan model
                "foto_url" => $product->foto_url // Menambahkan URL foto yang sudah diformat
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('keranjang')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    /**
     * Memperbarui kuantitas item di keranjang.
     */
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["qty"] = $request->quantity;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Kuantitas berhasil diperbarui.');
        }
        return redirect()->back()->with('error', 'Gagal memperbarui kuantitas.');
    }

    /**
     * Menghapus item dari keranjang.
     */
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang.');
        }
        return redirect()->back()->with('error', 'Gagal menghapus produk.');
    }

    /**
     * Memproses checkout dan menyimpan pesanan ke database.
     */
    public function prosesCheckout(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'telepon' => 'required|string|max:50', // 'telepon' digunakan untuk Nomor Meja
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('keranjang')->with('error', 'Keranjang Anda kosong!');
        }

        $total = 0;
        foreach($cart as $item) {
            $total += $item['harga'] * $item['qty'];
        }
        // Tambahkan biaya layanan jika ada
        $total += 2000;

        // Simpan data order
        $order = Order::create([
            'customer_name' => $request->nama,
            'table_number'  => $request->telepon, // Menyimpan nomor meja
            'total_price'   => $total,
        ]);

        // Simpan data order items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id'     => $order->id,
                'product_name' => $item['nama'],
                'price'        => $item['harga'],
                'quantity'     => $item['qty'],
            ]);
        }

        // Kosongkan keranjang setelah checkout berhasil
        session()->forget('cart');

        return redirect()->route('menu')->with('success', 'Pesanan Anda berhasil dibuat dan akan segera diproses!');
    }
}