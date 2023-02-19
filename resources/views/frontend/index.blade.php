@extends('layouts.app')
@section('title', 'Home Page')
@section('content')
    {{-- Phần này là nội dung cái thanh carousel trượt để hiển thị tất cả các categories và hình ảnh của nó --}}
    <div class="bg-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="owl-carousel category-carousel owl-theme ">

                        @foreach ($allCategories as $category)
                            <div class="item">

                                <a href="{{ url('tutorial/' . $category->slug) }}" class="text-decoration-none">
                                    <div class="card">
                                        <img height="140px" width="100px"
                                            src="{{ asset('uploads/category/' . $category->image) }}" alt="Image">
                                        <div class="card-body text-center">
                                            <h5 class="text-dark">{{ $category->name }}</h5>
                                        </div>
                                    </div>
                                </a>

                            </div>
                        @endforeach

                    </div>

                </div>
            </div>
        </div>
    </div>


    {{-- For the content --}}

    <div class="py-1 bg-gray">
        <div class="container">
            <div class="border p-3 text-center">
                <h3>Introduction to our blog post</h3>
            </div>
        </div>
    </div>


    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Blog post about Technology</h4>
                    <div class="underline"></div>
                    <p>
                        This blog post is all about web's technologies.
                        It contains many posts which are related to Javascript PHP Laravel NodeJS ... and many of another
                        programming languages as well as frameworks.
                        This blog post is built by PHP programming language using Laravel framework version 8.x and the
                        database used in the project is
                        MySQL. Please login first to use full services of us.
                        The administrators and users can interact with each other by posting new posts , like the posts and
                        make comments to
                        it .
                    </p>
                </div>
            </div>
        </div>
    </div>


    <div class="py-5 bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>All Categories</h4>
                    <div class="underline"></div>
                </div>

                @foreach ($allCategories as $category)
                    <div class="col-md-2 category">
                        <div class="card card-body mb-3 p-1">
                            <a href="{{ url('tutorial/' . $category->slug) }}" class="text-decoration-none">
                                <h5 class="text-dark mb-0 text-center category-text">{{ $category->name }}</h5>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>


    <div class="py-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Latest Posts</h4>
                    <div class="underline"></div>
                </div>
            </div>
            <div class="row">
                    @foreach ($latestPosts as $latestPost)
                    <div class="mt-4 col-md-6">
                        <div class="card card-body mb-3 bg-gray shadow">
                            <img src="{{ asset('uploads/cover/' . $latestPost->cover) }}" alt="" style="height:300px; object-fit: contain; border-radius: 2px;">
                                <a href="{{ url('tutorial/' . $latestPost->category->slug . '/' . $latestPost->slug) }}"
                                    class="text-decoration-none">
                                    <h5 class="text-primary mb-0 mt-2">{{ $latestPost->name }}</h5>
                                </a>
                            <div class="post-info mt-2">
                                <h5 class="post-author mt-2"><i class="fa-regular fa-user"></i>
                                    {{ $latestPost->user->name }}
                                </h5>
                                <h5 class="postedOn mt-2">
                                    <i class="fa-regular fa-calendar"></i> Date:
                                    {{ $latestPost->created_at->format('d-m-Y') }}
                                </h5>
                                <span class="ms-5"><i class="fa-regular fa-thumbs-up"></i> {{ count($latestPost->likes) }} likes</span>
                                <span class="ms-5"><i class="fa-regular fa-comment"></i> {{ count($latestPost->comments) }} comments</span>
                            </div>
                        </div>
                    </div>
                    @endforeach

                <!-- <div class="col-md-3">
                    <div class="border p-3 text-center">
                        <h3>Another content</h3>
                    </div>
                </div> -->

            </div>
        </div>
    </div>
@endsection
