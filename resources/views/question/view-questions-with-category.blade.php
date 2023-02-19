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
                                <h5 class="text-primary mb-0 mt-2">{{ strlen($question->title) < 70 ? $question->title : substr($question->title, 0, 70) . '...' }}</h5>
                            </a>
                            <div class="post-info mt-2">
                                <h5 class="post-author mt-2"><i class="fa-regular fa-user"></i>
                                    {{ $question->user->name }}
                                </h5>
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

                {{-- For pagination --}}
                <div class="your-paginate mt-3">
                    {{ $questions->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
