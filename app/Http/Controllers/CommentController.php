<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'content' => 'required',
        ]);

        $comment = new Comment;
        $comment->user_id = Auth::id();
        $comment->post_id = $request->post_id;
        $comment->content = $request->content;
        $comment->save();

        return back();
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        if($comment) {
            // 사용자와 작성자가 같은지 확인
            if(Auth::user()->id == $comment->user_id) {
                $comment->delete();
                return redirect()->route('post.show', ['id' => $comment->post_id])->with('message', '댓글이 삭제되었습니다.');
            } else {
                // 작성자와 사용자가 다른 경우 에러 메시지
                return back()->with('error', '자신이 작성한 댓글만 삭제할 수 있습니다.');
            }
        } else {

            return back()->with('error', '해당 댓글이 존재하지 않습니다.');
        }
    }
}
