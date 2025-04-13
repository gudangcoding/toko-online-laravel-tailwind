<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index()
    {
        $userId = Auth::id();
        $order = Order::with(['user', 'orderDetail'])
            ->where("user_id", Auth::id()) // hanya ambil order milik user login
            ->orderBy("id", "desc")
            ->paginate(5);
            $total = Order::where("user_id", $userId)->count();
            $selesai = Order::where("user_id", $userId)
                ->where('status', 'Selesai')
                ->count();
            $proses = Order::where("user_id", $userId)
                ->where('status', 'Proses')
                ->count();

        return view("dashboard", compact("order", "total", "selesai", "proses"));
    }
    public function create()
    {

    }
    public function detail($id)
    {
        $order = Order::with(['user', 'OrderDetail'])->where("id", $id)->first();
        // dd($order->OrderDetail);
        return view("detailorder", compact("order"));
    }
    public function sukses()
    {
        return view("sukses");
    }
    public function riawayat()
    {
        return view("sukses");
    }
}

// <?php

// namespace App\Http\Controllers\api;

// use App\Http\Controllers\Controller;
// use App\Models\Order;
// use App\Services\RajaOngkirService;
// use App\Services\MidtransService;
// use Illuminate\Http\Request;

// class OrderController extends Controller
// {
//     protected $rajaOngkirService;
//     protected $midtransService;

//     public function __construct(RajaOngkirService $rajaOngkirService, MidtransService $midtransService)
//     {
//         $this->rajaOngkirService = $rajaOngkirService;
//         $this->midtransService = $midtransService;
//     }

//     /**
//      * Membuat order dan transaksi Midtrans
//      */
//     public function createOrder(Request $request)
//     {
//         // Ambil data untuk perhitungan ongkir
//         $origin = $request->origin; // ID kota asal
//         $destination = $request->destination; // ID kota tujuan
//         $weight = $request->weight; // Berat dalam gram
//         $courier = $request->courier; // Kurir (jne, tiki, etc.)

//         // Cek ongkir dengan RajaOngkir
//         $ongkir = $this->rajaOngkirService->checkOngkir($origin, $destination, $weight, $courier);

//         // Validasi ongkir
//         if (isset($ongkir->rajaongkir->results[0]->costs)) {
//             $costs = $ongkir->rajaongkir->results[0]->costs;
//             $shippingCost = $costs[0]->cost[0]->value; // Ambil ongkir pertama (sesuaikan jika ada opsi lain)
//         } else {
//             return response()->json(['error' => 'Ongkir tidak ditemukan.'], 400);
//         }

//         // Data order dan detail transaksi
//         $orderDetails = [
//             'order_id' => 'ORDER-' . time(),
//             'gross_amount' => 100000 + $shippingCost, // Total pembayaran, termasuk ongkir
//             'customer_name' => $request->customer_name,
//             'customer_email' => $request->customer_email,
//             'customer_phone' => $request->customer_phone,
//             'shipping_address' => $request->shipping_address,
//             'courier' => $courier,
//             'shipping_cost' => $shippingCost,
//         ];

//         // Buat transaksi Midtrans dengan menggunakan MidtransService
//         try {
//             $transaction = $this->midtransService->createTransaction($orderDetails);
//             // dd($transaction); // Debug output
//             dd($orderDetails); // Debug output
//             // return json_decode(json_encode($transaction));
//             //yang betul
//             // return response()->json([
//             //     // 'payment_url' => $transaction->redirect_url
//             //     'snap_token' => $transaction->token
//             // ]);
//         } catch (\Exception $e) {
//             return response()->json(['error' => $e->getMessage()], 500);
//         }
//     }

//     /**
//      * Callback untuk verifikasi pembayaran
//      */
//     public function paymentCallback(Request $request)
//     {
//         // Tangkap data callback dari Midtrans
//         $callbackData = $request->all();

//         // Proses status pembayaran
//         try {
//             $this->midtransService->handleCallback($callbackData);
//             return response()->json(['status' => 'success', 'data' => $callbackData]);
//         } catch (\Exception $e) {
//             return response()->json(['status' => 'failed', 'error' => $e->getMessage()]);
//         }
//     }

//     public function refundOrder(Request $request, $orderId)
//     {
//         $amount = $request->amount; // Jumlah yang akan di-refund

//         // Validasi jumlah refund (misalnya tidak boleh lebih dari total pembayaran)
//         $order = Order::find($orderId);
//         if (!$order) {
//             return response()->json(['error' => 'Order not found.'], 404);
//         }

//         if ($amount > $order->total_amount) {
//             return response()->json(['error' => 'Refund amount exceeds the total order amount.'], 400);
//         }

//         // Melakukan refund melalui service Midtrans
//         $refundResponse = $this->midtransService->refundTransaction($order->transaction_id, $amount);

//         if (isset($refundResponse['error'])) {
//             return response()->json(['error' => $refundResponse['error']], 500);
//         }

//         return response()->json(['status' => 'success', 'refund_response' => $refundResponse]);
//     }
// }