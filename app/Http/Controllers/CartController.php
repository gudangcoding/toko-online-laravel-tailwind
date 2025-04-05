<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // Menampilkan keranjang belanja
    public function index()
    {
        $cart = session()->get('cart', []);
        // dd($cart);
        return view('keranjang', compact('cart'));
    }

    // Menambahkan produk ke keranjang
    public function addToCart($id)
    {
        $product = Produk::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['jumlah']++;
        } else {
            $cart[$id] = [
                'id' => $product->id,
                'nama_produk' => $product->nama,
                'harga' => $product->harga,
                'gambar' => $product->gambar,
                'jumlah' => 1
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Produk ditambahkan ke keranjang');
    }

    

    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['jumlah'] = $request->jumlah;
            session()->put('cart', $cart);
        }
        return response()->json(['success' => true]);
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return response()->json(['success' => true]);
    }


    // Mengosongkan keranjang belanja
    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Keranjang dikosongkan');
    }
    public function checkout(Request $request)
    {
        // Pastikan pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('pelanggan.login')->with('error', 'Silakan login terlebih dahulu untuk melanjutkan checkout.');
        }

        // Ambil data keranjang dari sesi
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja kosong.');
        }

        // Hitung total harga dari semua item
        $total_harga = 0;
        foreach ($cart as $item) {
            $total_harga += (float) $item['harga'] * (int) $item['jumlah'];
        }

        // Simpan data order ke database
        $order = new Order();
        $order->user_id = Auth::id();
        $order->total_harga = $total_harga;
        $order->status_pembayaran = 'pending';
        $order->status = 'pending'; // atau status default lainnya
        $order->save();

        // Simpan detail item pesanan
        foreach ($cart as $item) {
            // Cek produk valid dan ada di database
            $produk = Produk::find($item['id']);
            if (!$produk) {
                continue; // Skip kalau produk tidak ditemukan
            }

            $subtotal = $item['harga'] * $item['jumlah'];

            OrderDetail::create([
                'order_id' => $order->id,
                'produk_id' => $produk->id,
                'jumlah' => $item['jumlah'],
                'harga' => $item['harga'],
                'subtotal' => $subtotal,
            ]);
        }

        // Hapus keranjang dari sesi
        session()->forget('cart');

        return redirect()->route('order.detail', $order->id)->with('success', 'Pesanan berhasil dibuat. Silakan lakukan pembayaran.');
    }
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('order.index')->with('success', 'Order berhasil dihapus.');
    }
}