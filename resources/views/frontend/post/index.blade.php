@extends('layouts.app')

@section('title', $category)

{{-- Phần này là để show tất cả các bài viết thuộc một category nào đó và hiển thị lên giao diện --}}

@section('content')
    <div class="py-4">
        <div class="container">
            <div class="row">
                    <div class="category-heading">
                        <h2>Posts about {{ $category }}</h2>
                    </div>

                    @forelse ($posts as $post)
                        <div class="mt-4 col-md-6">
                            <div class="card card-body mb-3 bg-gray shadow">
                                <img src="{{ asset('uploads/cover/' . $post->cover) }}" alt="" style="max-height:300px; object-fit: contain;">
                                <a href="{{ url('tutorial/' . $post->category->slug . '/' . $post->slug) }}"
                                    class="text-decoration-none">
                                    <h3 class="post-heading">{{ $post->name }}</h2>
                                </a>

                                <h6>
                                    Posted on : {{ $post->created_at->format('d-m-Y') }}
                                    <span class="ms-5">Created by : {{ $post->user->name }}</span>
                                    <span class="ms-5"><i class="fa-regular fa-thumbs-up"></i> {{ count($post->likes) }} likes</span>
                                    <span class="ms-5"><i class="fa-regular fa-comment"></i> {{ count($post->comments) }} comments</span>
                                </h6>

                            </div>
                        </div>
                    @empty
                        <div class="card card-shadow mt-4">
                            <div class="card-body">
                                <h4>No Post Available...</h1>
                            </div>
                        </div>
                    @endforelse

                    {{-- For pagination --}}
                    <div class="your-paginate mt-3">
                        {{ $posts->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
