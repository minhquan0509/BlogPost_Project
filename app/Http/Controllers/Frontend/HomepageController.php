<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function search(Request $request)
    {
        $search_string = $request->query('search_string');
        // dd($search_string);
        $posts = Post::where('name', 'like', '%'.$search_string.'%')->orWhere('description', 'like', '%'.$search_string.'%')->paginate(1);
        $category = $search_string;
        // dd($posts->count());
        return view('frontend.post.index', compact('category', 'posts'));
        // return view('welcome');
    }

    public function viewCategoryPost($category_slug)
    {
        $Category = Category::where('slug', $category_slug)
            ->where('status', 0)
            ->first();
        if ($Category) {
            $posts = Post::where('category_id', $Category->id)
                ->where('status', 0)
                ->paginate(1);
            $category = $Category->name;
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
            //Tìm tất cả các posts mà có cùng category mà được đăng gần nhất
            $latest_posts = Post::where('category_id', $category->id)
                ->where('status', 0)
                ->orderBy('created_at', 'DESC')
                ->take(15)
                ->get();
            // Đưa ra tất cả các posts trong hệ thống mà có lượng likes cao nhất
            $highest_like_posts = Like::groupBy('post_id')
                ->select('post_id', DB::raw('count(*) as total_likes'))
                ->having('total_likes', '>', '0')
                ->orderBy('total_likes', 'DESC')
                ->take(15)
                ->get();
            // Nhét cái đống thông tin này vào phía view để thực hiện render giao diện
            return view('frontend.post.view', compact('post', 'latest_posts', 'highest_like_posts'));
        } else return redirect('/');
    }
}
