<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    function index()  {
        $produks = Produk::with('kategori')->paginate(3);
        return view("produk-list",compact("produks"));
    }
    function detail($id)  {
        $produk = Produk::findOrFail($id);
        return view("detail-produk",compact("produk"));
    }
}
