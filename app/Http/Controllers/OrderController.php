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
            ->paginate(10);
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
