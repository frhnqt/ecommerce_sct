<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesananmodel;
use App\Models\Cartmodel;
use Midtrans\Config;
use Midtrans\Snap;

class CekoutController extends Controller
{
    public function indexcekout()
    {
        // Ambil semua item cart dari database
        $cartItems = Cartmodel::where('user_id', auth()->user()->id)->get();

        // Hitung total belanja
        $subtotal = $cartItems->sum(function($item) {
            return $item->product->harga * $item->quantity;
        });

        // Asumsi biaya pengiriman tetap
        $deliveryFee = 10000; // Contoh biaya pengiriman
        $discount = 0; // Contoh diskon, jika ada

        $total = $subtotal + $deliveryFee - $discount;

        return view('checkout', compact('cartItems', 'subtotal', 'deliveryFee', 'discount', 'total'));
    }

    public function storecekout(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'metodepembayaranid' => 'required|string|max:255',
        ]);

        $checkout = Pesananmodel::create($request->all());

        // // Midtrans Configuration
        // Config::$serverKey = config('midtrans.server_key');
        // Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        // Config::$isSanitized = env('MIDTRANS_IS_SANITIZED', true);
        // Config::$is3ds = env('MIDTRANS_IS_3DS', true);

        // Midtrans Transaction Parameters
        $params = [
            'transaction_details' => [
                'order_id' => $checkout->id,
                'gross_amount' => $request->total, // Total amount to be paid
            ],
            'customer_details' => [
                'first_name' => $request->name,
                'email' => $request->email,
                'phone' => $request->no_telp,
                'address' => $request->address,
            ],
        ];

        // $snapToken = Snap::getSnapToken($params);

        return view('checkout_payment', compact('snapToken', 'checkout', 'cartItems', 'subtotal', 'deliveryFee', 'discount', 'total'));
    }
}
