<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Product;

class MypostController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $posts = Post::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        $products = Product::where('user_id', $user->id)->orderByRaw("CASE WHEN request = '' THEN 1 ELSE 0 END, created_at DESC")->get();
        // $myProducts = Product::where('request', $user->id)->get();
        // return view('mypost', ['posts' => $posts], ['products' => $products], ['myProducts' => $myProducts]);
        return view('mypost', ['posts' => $posts], ['products' => $products]);
    }
}
