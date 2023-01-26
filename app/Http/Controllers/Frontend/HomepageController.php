<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomepageController extends Controller
{
    public function index()
    {
        $allCategories = Category::where('status', '0')->get();
        $latestPosts = Post::where('status', '0')
            ->orderBy('created_at', 'DESC')
            ->take(15)
            ->get();
        return view('frontend.index', compact('allCategories', 'latestPosts'));
    }

    public function viewCategoryPost($category_slug)
    {
        $category = Category::where('slug', $category_slug)
            ->where('status', 0)
            ->first();
        if ($category) {
            $posts = Post::where('category_id', $category->id)
                ->where('status', 0)
                ->paginate(1);
            return view('frontend.post.index', compact('category', 'posts'));
        } else return redirect('/');
    }

    public function viewPost(string $category_slug, string $post_slug)
    {
        // Lấy thông tin về 1 category dựa trên input client nhập vào thông qua biến $category_slug
        $category = Category::where('slug', $category_slug)->where('status', 0)->first();
        // Sau khi lấy được thông tin về category , tiếp tục lấy thông tin của post dựa trên $category_slug vừa lấy
        // và slug của post (input từ phía client thông qua biến $post_slug)
        if ($category) {
            $post = Post::where('category_id', $category->id)
                ->where('status', 0)
                ->where('slug', $post_slug)
                ->first();
            //Tìm tất cả các post mà có cùng category
            $latest_posts = Post::where('category_id', $category->id)
                ->where('status', 0)
                ->orderBy('created_at', 'DESC')
                ->take(15)
                ->get();

            return view('frontend.post.view', compact('post', 'latest_posts'));
        } else return redirect('/');
    }
}
