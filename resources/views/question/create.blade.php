@extends('layouts.app')
@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('msg'))
                <div class="alert alert-success" role="alert">
                    {{ session('msg') }}
                </div>
            @endif

            <div class="card-header">
                <h4>
                    Add new question
                </h4>
            </div>

            <div class="card-body">
                <form action="{{ url('questions/add-question') }}" method="post">
                    <div class="mb-3">
                        <label for="">Category</label>
                        <select name="category_id" class="form-control">

                            @foreach ($category as $cateitem)
                                <option value="{{ $cateitem->id }}">{{ $cateitem->name }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="">Question title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                    </div>

                    <div class="mb-3">
                        <label for="">Slug</label>
                        <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
                    </div>

                    <div class="mb-3">
                        <label for="">Description</label>
                        <textarea id="mySummernote" name="description" class="form-control" rows="4"></textarea>
                    </div>

                    <div class="row">

                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary">Post question</button>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
