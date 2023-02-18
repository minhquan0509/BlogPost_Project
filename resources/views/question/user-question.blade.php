@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            @if (session('msg'))
                <div class="alert alert-success" role="alert">
                    {{ session('msg') }}
                </div>
            @endif
            <div class="card-header">
                <h4>
                    My questions
                    <a href="{{ url('questions/add-question') }}" class="btn btn-primary float-end">
                        Add new question
                    </a>
                </h4>
            </div>

            <div class="card-body">

                @if (session('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif

                <table class="table table-bordered" id="myDataTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Question title</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($questions as $question)
                            <tr>
                                <td>{{ $question->id }}</td>
                                <td>{{ $question->category->name }}</td>
                                <td>{{ $question->title }}</td>
                                <td>
                                    <a href="{{ url('/questions/edit-question/' . $question->id) }}"
                                        class="btn btn-warning">Edit</a>
                                </td>
                                <td>
                                    <a href="{{ url('/questions/delete-question/' . $question->id) }}"
                                        class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
