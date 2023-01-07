@extends('layouts.app')

@section('content')
    <div class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-9">

                    <div class="category-heading">
                        <h2>{{ $category->name }}</h2>
                    </div>

                    @forelse ($posts as $post)
                        <div class="card card-shadow mt-4">
                            <div class="card-body">
                                <a href="{{ url('tutorial/' . $category->slug . '/' . $post->slug) }}"
                                    class="text-decoration-none">
                                    <h3 class="post-heading">{{ $post->name }}</h2>
                                </a>

                                <h6>
                                    Posted on : {{ $post->created_at->format('d-m-Y') }}
                                    <span class="ms-3">Created by : {{ $post->user->name }}</span>
                                </h6>

                            </div>
                        </div>
                    @empty
                        <div class="card card-shadow mt-4">
                            <div class="card-body">
                                <h1>No Post Available...</h1>
                            </div>
                        </div>
                    @endforelse

                    {{-- For pagination --}}
                    <div class="your-paginate mt-3">
                        {{ $posts->links() }}
                    </div>

                </div>
                <div class="col-md-3">
                    <div class="border p-2">
                        <h4>Advertising Area</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
