<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        return view('reservation');
    }

    public function store(Request $request)
    {
        // Validasi & simpan reservasi
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'reservation_time' => 'required|date',
            'people_count' => 'required|integer|min:1',
        ]);

        \DB::table('reservations')->insert($validated);

        return redirect()->back()->with('success', 'Reservasi berhasil dikirim!');
    }
}
