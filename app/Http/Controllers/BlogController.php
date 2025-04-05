<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    function index()  {
        $blog = Blog::orderBy("created_at","desc")->paginate(10);
        return view("blog",compact("blog"));
    }

    function detail($id) { 
        $detail = Blog::find($id);
        return view("blog-detail",compact("detail"));
    }
}
