<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Order;
use Midtrans\Notification;

class MidtransController extends Controller
{
    public function bayar(Request $request)
    {
        $order = Order::with('orderDetail.produk', 'user')->findOrFail($request->order_id);

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $items = [];
        foreach ($order->orderDetail as $item) {
            $items[] = [
                'id' => $item->produk->id,
                'price' => (int) $item->harga,
                'quantity' => $item->jumlah,
                'name' => substr($item->produk->nama, 0, 50),
            ];
        }

        $transaction_details = [
            'order_id' => 'ORD-' . str_pad($order->id, 3, '0', STR_PAD_LEFT) . '-' . time(),
            'gross_amount' => (int) $order->total_harga,
        ];

        $customer_details = [
            'first_name' => $order->user->name ?? 'Customer',
            'email' => $order->user->email ?? 'dummy@email.com',
            'phone' => $order->user->no_hp ?? '08123456789',
            'shipping_address' => [
                'address' => $order->user->alamat ?? 'Alamat belum diisi',
            ],
        ];

        $transaction = [
            'transaction_details' => $transaction_details,
            'item_details' => $items,
            'customer_details' => $customer_details,
            'enabled_payments' => ['gopay', 'bank_transfer', 'credit_card'], // optional
            'callbacks' => [
                'finish' => route('midtrans.callback'), // after payment completed
            ]
        ];

        $response = Snap::createTransaction($transaction);

        return redirect($response->redirect_url);
    }



    public function handleCallback(Request $request)
    {
        // Ambil data dari query string
    $orderId = $request->order_id; // Contoh: ORD-003-1743812033
    $status = $request->transaction_status; // settlement, pending, etc

    // Ambil ID asli dari order_id
    $parts = explode('-', $orderId); // ['ORD', '003', '1743812033']
    $id = isset($parts[1]) ? (int) ltrim($parts[1], '0') : null;

    if (!$id) {
        return redirect()->route('home')->with('error', 'Order ID tidak valid');
    }

    $order = Order::find($id);
    if (!$order) {
        return redirect()->route('home')->with('error', 'Order tidak ditemukan');
    }

    // Update status pembayaran berdasarkan transaction_status
    switch ($status) {
        case 'settlement':
        case 'capture':
            $order->status_pembayaran = 'dibayar';
            break;
        case 'pending':
            $order->status_pembayaran = 'pending';
            break;
        case 'deny':
        case 'cancel':
        case 'expire':
            $order->status_pembayaran = 'gagal';
            break;
    }

    $order->save();

    return redirect()->route('order.detail',$id)->with('success', 'Pembayaran berhasil diproses');

    }

}
