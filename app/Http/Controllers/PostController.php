<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('post', compact('posts'));
    }

    public function create()
    {
        return view('create_post');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('images'), $imageName);

        $post = new Post;
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->image = $imageName;
        $post->save();

        return redirect('/post')
            ->with('success','게시글이 등록되었습니다.')
            ->with('image',$imageName);
    }

    public function show($id)
    {
        $post = Post::find($id);
        if($post !== null) {
            return view('show_post', ['post' => $post]);
        } else {
            return redirect('/posts')->with('error', '해당 게시글을 찾을 수 없습니다.');
        }
    }

    public function edit($id)
    {
        $post = Post::find($id);
        if($post !== null && $post->user_id == Auth::id()) {
            return view('edit_post', ['post' => $post]);
        } else {
            return redirect('/post')->with('error', '해당 게시글을 찾거나 수정할 권한이 없습니다.');
        }
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        if($post !== null && $post->user_id == Auth::id()) {
            $request->validate([
                'title' => 'required',
                'content' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $post = Post::find($id);
            if($post !== null) {
                if($request->hasFile('image')) {
                    $imageName = time().'.'.$request->image->extension();
                    $request->image->move(public_path('images'), $imageName);
                    $post->image = $imageName;
                }

                $post->title = $request->title;
                $post->content = $request->content;
                $post->save();

                return redirect('/post')->with('success', '게시글이 수정되었습니다.');
            } else {
                return redirect('/post')->with('error', '해당 게시글을 찾을 수 없습니다.');
            }
        } else {
            return redirect('/post')->with('error', '해당 게시글을 찾거나 수정할 권한이 없습니다.');
        }
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        if($post !== null && $post->user_id == Auth::id()) {
            $post = Post::find($id);
            if($post !== null) {
                $post->delete();
                return redirect('/post')->with('success', '게시글이 삭제되었습니다.');
            } else {
                return redirect('/post')->with('error', '해당 게시글을 찾을 수 없습니다.');
            }
        } else {
            return redirect('/post')->with('error', '해당 게시글을 찾거나 삭제할 권한이 없습니다.');
        }
    }
}
