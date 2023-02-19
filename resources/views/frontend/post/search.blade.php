@extends('layouts.app')

@section('title', $category)

{{-- Phần này là để show tất cả các bài viết thuộc một category nào đó và hiển thị lên giao diện --}}

@section('content')
    <div class="py-4">
        <div class="container">
            <div class="row">

                    <div class="category-heading">
                        <h2>Posts about {{ $category}}</h2>
                    </div>

                    @forelse ($posts as $post)
                        <div class="mt-4 col-md-6">
                            <div class="card card-body mb-3 bg-gray shadow">
                                <img src="{{ asset('uploads/cover/' . $post->cover) }}" alt="" style="height:300px; object-fit: contain;">
                                <a href="{{ url('tutorial/' . $post->category->slug . '/' . $post->slug) }}"
                                    class="text-decoration-none">
                                    <h3 class="post-heading">{{ strlen($post->name) < 48 ? $post->name : substr($post->name, 0, 48) . '...' }}</h2>
                                </a>

                                <div class="post-info mt-2">
                                    <h5 class="post-author mt-2"><i class="fa-regular fa-user"></i>
                                        {{ $post->user->name }}
                                    </h5>
                                <h5 class="postedOn mt-2">
                                    <i class="fa-regular fa-calendar"></i> Date:
                                    {{ $post->created_at->format('d-m-Y') }}
                                </h5>
                                <span class="ms-5"><i class="fa-regular fa-thumbs-up"></i> {{ count($post->likes) }} likes</span>
                                <span class="ms-5"><i class="fa-regular fa-comment"></i> {{ count($post->comments) }} comments</span>
                            </div>

                            </div>
                        </div>
                    @empty
                        <div class="card card-shadow mt-4">
                            <div class="card-body">
                                <h4>No Post Available...</h1>
                            </div>
                        </div>
                    @endforelse
            </div>
        </div>
    </div>
@endsection
