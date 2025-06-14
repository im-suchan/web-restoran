<?php

// File: app/Http/Controllers/Admin/OrderController.php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar semua pesanan.
     */
    public function index()
    {
        $orders = Order::latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Menampilkan detail satu pesanan.
     */
    public function show(Order $order)
    {
        $order->load('items');
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Menghapus pesanan dari database.
     * Metode ini baru ditambahkan.
     */
    public function destroy(Order $order)
    {
        // Hapus pesanan dari database
        $order->delete();

        // Redirect kembali ke halaman daftar pesanan dengan pesan sukses
        return redirect()->route('admin.orders.index')
                         ->with('success', 'Pesanan #' . $order->id . ' berhasil dihapus.');
    }
}