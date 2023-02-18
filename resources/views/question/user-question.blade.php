@extends('layouts.app')

@section('content')
    <div class="container py-4 px-4">
        @if (session('msg'))
            <div class="alert alert-success" role="alert">
                {{ session('msg') }}
            </div>
        @endif

            <h4>
                My questions
            </h4>
            <div class="underline"></div>
            <a href="{{ url('questions/add-question') }}" class="btn btn-primary float-end">
                Add new question
            </a>

        @forelse ($questions as $question)
            <div class="mt-4 col-md-6">
                <div class="card card-body mb-3 bg-gray shadow question-card">
                    <div class="question-action__wrapper">
                        <a href="{{ url('/questions/edit-question/' . $question->id) }}" class="action-btn edit-btn"><i class="fa-regular fa-pen-to-square"></i></a>
                        <a href="{{ url('/questions/delete-question/' . $question->id) }}" class="action-btn delete-btn"><i class="fa-regular fa-trash-can"></i></a>
                    </div>
                    <a href="{{ url('questions/' . $question->category->slug . '/' . $question->slug) }}"
                        class="text-decoration-none">
                        <h3 class="post-heading">{{ $question->title }}</h2>
                    </a>
                    <div class="post-info mt-2">
                        <h5 class="postedOn mt-2">
                            <i class="fa-regular fa-calendar"></i> Date:
                            {{ $question->created_at->format('d-m-Y') }}
                        </h5>
                        <span class="ms-5"><i class="fa-regular fa-comment"></i> {{ count($question->answers) }} answers</span>
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
@endsection
