<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    function index()  {
        return view("blog");
    }

    function detail($id) { 
        return view("blog-detail");
    }
}
