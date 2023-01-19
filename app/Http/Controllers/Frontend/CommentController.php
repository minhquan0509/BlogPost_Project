<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        if (Auth::check()) {

            $validated = Validator::make($request->all(), [
                'comment_text' => 'required|string'
            ]);

            if ($validated->fails()) {
                return redirect()->back()->with('message', 'Submit comment fail');
            }

            $post = Post::where('slug', $request->post_slug)->where('status', '0')->first();

            if ($post) {
                Comment::create([
                    'post_id' => $post->id,
                    'user_id' => Auth::user()->id,
                    'comment_text' => $request->comment_text
                ]);
                return redirect()->back()->with('message', 'Add new comment successfully');
            } else {
                return redirect()->back()->with('message', 'No post found');
            }
        } else {
            return redirect()->route('login')->with('message', 'Please login first to comment');
        }
    }
}
