<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TentangKamiController extends Controller
{
    function index()  {
        return view("tentang-kami");
    }
}
