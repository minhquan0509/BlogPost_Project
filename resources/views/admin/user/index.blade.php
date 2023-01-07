@extends('layouts.master')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">

            <div class="card-header">
                <h4>
                    View Users
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
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->role_as ? 'Admin' : 'User' }}</td>
                                <td>
                                    <a href="{{ url('/admin/user/' . $item->id) }}" class="btn btn-danger">Edit</a>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
