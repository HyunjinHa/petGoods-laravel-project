<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('dashboard', compact('products'));
    }

    public function create()
    {
        return view('create_product');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('images/'), $imageName);

        $product = new Product;
        $product->user_id = Auth::id();
        $product->title = $request->title;
        $product->price = $request->price;
        $product->content = $request->content;
        $product->image = $imageName;
        $product->save();

        return redirect('/dashboard')
            ->with('success','상품이 등록되었습니다.')
            ->with('image',$imageName);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if($product !== null) {
            return view('show_product', ['product' => $product]);
        } else {
            return redirect('/dashboard')->with('error', '해당 상품을 찾을 수 없습니다.');
        }
    }

    public function edit($id)
    {
        $product = Product::find($id);
        if($product !== null && $product->user_id == Auth::id()) {
            return view('edit_product', ['product' => $product]);
        } else {
            return redirect('/dashboard')->with('error', '해당 게시글을 찾거나 수정할 권한이 없습니다.');
        }
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if($product !== null && $product->user_id == Auth::id()) {
            $request->validate([
                'title' => 'required',
                'content' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $product = Product::find($id);
            if($product !== null) {
                if($request->hasFile('image')) {
                    $imageName = time().'.'.$request->image->extension();
                    $request->image->move(public_path('images'), $imageName);
                    $product->image = $imageName;
                }

                $product->title = $request->title;
                $product->price = $request->price;
                $product->content = $request->content;
                $product->save();

                return redirect('/dashboard')->with('success', '게시글이 수정되었습니다.');
            } else {
                return redirect('/dashboard')->with('error', '해당 게시글을 찾을 수 없습니다.');
            }
        } else {
            return redirect('/dashboard')->with('error', '해당 게시글을 찾거나 수정할 권한이 없습니다.');
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if($product !== null && $product->user_id == Auth::id()) {
            $product = Product::find($id);
            if($product !== null) {
                $product->delete();
                return redirect('/dashboard')->with('success', '게시글이 삭제되었습니다.');
            } else {
                return redirect('/dashboard')->with('error', '해당 게시글을 찾을 수 없습니다.');
            }
        } else {
            return redirect('/dashboard')->with('error', '해당 게시글을 찾거나 삭제할 권한이 없습니다.');
        }
    }
}
