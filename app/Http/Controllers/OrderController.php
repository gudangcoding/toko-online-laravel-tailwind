<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::with("user")->orderBy("id", "desc")->paginate(10);
        $total = Order::count();
        $selesai = Order::where('status', 'Selesai')->count();
        $proses = Order::where('status', 'Proses')->count();

        return view("dashboard", compact("orders", "total", "selesai", "proses"));
    }
    public function create()
    {

    }
    public function detail($id)
    {
        $order = Order::where("id", $id)->first();
        return view("detailorder", compact("order"));
    }
    public function sukses()
    {
        return view("sukses");
    }
}
