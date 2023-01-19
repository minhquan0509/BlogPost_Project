@extends('layouts.app')

@section('title', $post->meta_title)
@section('meta_description', $post->meta_description)
@section('meta_keyword', $post->meta_keyword)

{{-- Phần này là xem chi tiết 1 bài post dựa trên category slug và post slug --}}

@section('content')
    <di v class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-9">

                    <div class="category-heading">
                        <h2>{!! $post->name !!}</h2>
                    </div>

                    <div class="mt-3">
                        <h6>{{ $post->category->name . ' / ' . $post->name }}</h6>
                    </div>

                    {{-- For post's description section --}}
                    <div class="card card-shadow mt-4">
                        <div class="card-body post-description">
                            {!! $post->description !!}
                        </div>
                    </div>

                    {{-- For comments section --}}
                    <div class="comment-area mt-4">

                        @if (session('message'))
                            <h6 class="alert alert-danger mb-3">{{ session('message') }}</h6>
                        @endif

                        <div class="card card-body">
                            <div class="card-title">Leave a comment for this post</div>
                            <form action="{{ url('comments') }}" method="POST">
                                @csrf
                                <input type="hidden" name="post_slug" value="{{ $post->slug }}">
                                <textarea name="comment_text" class="form-control" rows="3" required></textarea>
                                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                            </form>
                        </div>

                        @forelse ($post->comments as $comment)
                            <div class="card card-body shadow-sm mt-3">

                                <div class="detail-area">
                                    {{-- Information of the user who commented --}}
                                    <h6 class="user-name mb-1">
                                        @if ($comment->user)
                                            {{ $comment->user->name }}
                                        @endif
                                        <small class="ms-3 text-primary">Comment at {{ $comment->created_at }}</small>
                                    </h6>

                                    <p class="user-comment mb-1">
                                        {{ $comment->comment_text }}
                                    </p>
                                </div>


                                @if (Auth::check() && Auth::user()->id == $comment->user->id)
                                    <div>
                                        <a href="" class="btn btn-primary btn-sm me-2">Edit</a>
                                        <a href="" class="btn btn-danger btn-sm me-2">Delete</a>
                                    </div>
                                @endif

                            </div>
                        @empty
                            <h6>This post doesnt have comments</h6>
                        @endforelse



                    </div>

                </div>

                <div class="col-md-3">

                    <div class="border p-2">
                        <h4>Advertising Area</h4>
                    </div>

                    <div class="card mt-3">

                        <div class="card-header">
                            <h4>Latest Posts</h4>
                        </div>

                        <div class="card-body">
                            @foreach ($latest_posts as $latest_post)
                                <a href="{{ url('tutorial/' . $latest_post->category->slug . '/' . $latest_post->slug) }}"
                                    class="text-decoration-none">
                                    <h6>> {{ $latest_post->name }}</h6>
                                </a>
                            @endforeach
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </di>
@endsection
