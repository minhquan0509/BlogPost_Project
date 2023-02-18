@extends('layouts.app')

@section('content')
    <div class="py-4">
        <div class="container">
            <div class="row">
                <div class="category-heading">
                    <h2>Questions about {{ $category }}</h2>
                </div>

                @forelse ($questions as $question)
                    <div class="mt-4 col-md-6">
                        <div class="card card-body mb-3 bg-gray shadow">

                            <a href="{{ url('questions/' . $question->category->slug . '/' . $question->slug) }}"
                                class="text-decoration-none">
                                <h3 class="post-heading">{{ $question->title }}</h2>
                            </a>

                            <h6>
                                Posted on : {{ $question->created_at->format('d-m-Y') }}
                                <span class="ms-5">Created by : {{ $question->user->name }}</span>
                                <span class="ms-5"><i class="fa-regular fa-comment"></i> {{ count($question->answers) }} answers</span>
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
                    {{ $questions->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
