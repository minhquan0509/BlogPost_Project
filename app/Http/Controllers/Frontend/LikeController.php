<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function likeHandle(Request $request)
    {
        //Kiểm tra xem thử cái user này đã like post chưa ? nếu chưa thì insert thông tin vào bảng like_post
        $isLiked = Like::where('post_id', $request->post_id)->where('user_id', $request->user_id)->first();
        if (!$isLiked) {
            $newLike = new Like();
            $newLike->post_id = $request->post_id;
            $newLike->user_id = $request->user_id;
            $newLike->save();
        }
        return redirect()->back();
    }

    public function unlikeHandle(Request $request)
    {
        $likeInfo = Like::where('post_id', $request->post_id)->where('user_id', $request->user_id)->first();
        if ($likeInfo) {
            $likeInfo->delete();
        }
        return redirect()->back();
    }
}
