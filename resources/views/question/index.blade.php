@extends('layouts.app')

@section('content')
<div class="py-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Latest Questions</h4>
                    <div class="underline"></div>
                </div>
            </div>
            <div class="row">
                    @foreach ($questions as $question)
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
                                <span class="ms-5 me-4"><i class="fa-regular fa-comment"></i> {{ count($question->answers) }} answers</span>
                                <div>
                                    <span class="badge badge-info ">{{$question->category->name}}</span>
                                </div>
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