@extends('layouts.app')

@section('content')
    <div class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-9">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a
                                    href="/questions/{{ strtolower($question->category->name) }}">{{ $question->category->name }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $question->title }}</li>
                        </ol>
                    </nav>

                    <div class="mt-3">
                        <h2 style="color: rgb(189, 24, 24)">{{ $question->category->name . ' / ' . $question->title }}</h5>
                            <h6 style="color: rgb(65, 72, 133)">Posted by : {{ $question->user->name }} at
                                {{ floor((time() - strtotime($question->created_at)) / (60 * 60 * 24)) }}
                                days ago</h6>

                            @php
                                // $totalLikes = DB::table('like_post')
                                //     ->where('post_id', $post->id)
                                //     ->count();
                                $totalAnswers = DB::table('answers')
                                    ->where('question_id', $question->id)
                                    ->count();
                            @endphp

                            {{-- <button type="button" class="btn btn-labeled btn-primary"> --}}
                            {{-- <span class="btn-label"><i class="fa fa-thumbs-up"></i></span> {{ $totalLikes }} people
                            liked
                            this post</button> --}}

                            <a href="#comment" type="button" class="btn btn-labeled btn-warning">
                                <span class="btn-label"><i class="fa-solid fa-comment"></i></span> {{ $totalAnswers }}
                                answers for this answers</a>

                    </div>

                    {{-- For post's description section --}}
                    <div class="card card-shadow mt-4">
                        <div class="card-body post-description">
                            {!! $question->description !!}
                        </div>
                    </div>

                    {{-- Xử lý phần like với cả unlike cho bài post --}}

                    {{-- @if (Auth::user())
                        @php
                            $isLiked = DB::table('like_post')
                                ->where('post_id', $post->id)
                                ->where('user_id', Auth::user()->id)
                                ->get();
                            $totalLikes = DB::table('like_post')
                                ->where('post_id', $post->id)
                                ->count();
                        @endphp

                        @if ($isLiked->count() > 0)
                            <div class="mt-3">
                                <h6>Total {{ $totalLikes }} likes </h6>
                                <form action="/unlike-post" method="post">
                                    @csrf
                                    <input name="user_id" value="{{ Auth::user()->id }}" hidden>
                                    <input name="post_id" value="{{ $post->id }}" hidden>
                                    <button type="submit" class="btn btn-labeled btn-danger">
                                        <span class="btn-label"><i class="fa fa-thumbs-down"></i></span>Unlike</button>
                                </form>
                            </div>
                        @else
                            <div class="mt-3">
                                <h6 style="color: rgb(43, 87, 104)">Total {{ $totalLikes }} likes </h6>
                                <form action="/like-post" method="post">
                                    @csrf
                                    <input name="user_id" value="{{ Auth::user()->id }}" hidden>
                                    <input name="post_id" value="{{ $post->id }}" hidden>
                                    <button type="submit" class="btn btn-labeled btn-success">
                                        <span class="btn-label"><i class="fa fa-thumbs-up"></i></span>Like</button>
                                </form>
                            </div>
                        @endif
                    @else
                        <p class="alert alert-danger text-center mt-3">Please login first to like and comment this post </p>
                    @endif --}}

                    {{-- For comments section --}}
                    <div id="comment" class="comment-area mt-4">

                        @if (session('message'))
                            <h6 class="alert alert-success mb-3">{{ session('message') }}</h6>
                        @endif

                        <div class="card card-body">
                            <div class="card-title">
                                <h5 style="color: rgb(136, 106, 30)">Make a new answer for this question</h5>
                            </div>
                            <form action="{{ url('answer') }}" method="POST">
                                @csrf
                                <input type="hidden" name="question_slug" value="{{ $question->slug }}">
                                <textarea id="mySummernote" name="answer_text" class="form-control" rows="3" required></textarea>
                                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                            </form>
                        </div>

                        @forelse ($question->answers as $answer)
                            <div class="comment-container card card-body shadow-sm mt-3">

                                <div class="detail-area">

                                    <h6 class="user-name mb-1 text-primary">
                                        @if ($answer->user)
                                            {{ $answer->user->name }}
                                        @endif
                                        <small class="ms-3 text-secondary postedOn">Answer at
                                            {{ $answer->created_at }}</small>
                                    </h6>

                                    <p class="user-answer mb-1">
                                        {!! $answer->answer_text !!}
                                    </p>
                                </div>


                                @if (Auth::check() && Auth::user()->id == $answer->user->id)
                                    <div>

                                        <button type="button" value="{{ $answer->id }}"
                                            class="deleteComment btn btn-danger btn-sm me-2">Delete</button>
                                    </div>
                                @endif

                            </div>
                        @empty
                            <h6 class="alert alert-danger text-center">
                                This question currently does not have any answers
                            </h6>
                        @endforelse

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="card mt-3">

                        <div class="card-header">
                            <h4>Highest interaction questions</h4>
                        </div>

                        <div class="card-body">
                            @if(count($highest_answers) > 0)
                                @foreach ($highest_answers as $highest_answer)
                                    <a href="{{ url('questions/' . $highest_answer->question->category->slug . '/' . $highest_answer->question->slug) }}"
                                        class="text-decoration-none">
                                        <h6>▶({{ $highest_answer->total_answers }}
                                            <i class="fa-regular fa-comment"></i>) {{ $highest_answer->question->title }}
                                        </h6>
                                    </a>
                                @endforeach
                            @endif
                        </div>

                    </div>

                    {{-- <div class="card mt-3">

                        <div class="card-header">
                            <h4>Latest Posts List about {{ $post->category->name }}</h4>
                        </div>

                        <div class="card-body">
                            @foreach ($latest_posts as $latest_post)
                                <a href="{{ url('tutorial/' . $latest_post->category->slug . '/' . $latest_post->slug) }}"
                                    class="text-decoration-none">
                                    <h6>> {{ $latest_post->name }}
                                        ({{ floor((time() - strtotime($latest_post->created_at)) / (60 * 60 * 24)) }} days
                                        ago)
                                    </h6>
                                </a>
                            @endforeach
                        </div>

                    </div> --}}

                </div>

            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '.deleteComment', function() {
                if (confirm("Are you sure to delete this answer?")) {
                    let thisClicked = $(this);
                    let commentID = thisClicked.val();
                    $.ajax({
                        type: "POST",
                        url: "/delete-answer",
                        data: {
                            'answer_id': commentID
                        },
                        success: function(response) {
                            if (response.status == 200) {
                                thisClicked.closest('.comment-container').remove();
                                alert(response.message);
                            } else {
                                alert(response.message);
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
