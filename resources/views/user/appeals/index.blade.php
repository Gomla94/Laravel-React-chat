@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">All Appeals</div>
            <div class="card-body">
                <a href="{{ route('user.appeals.create') }}" class="btn btn-success mb-3">Add New Appeal</a>
                <table class="table">
                    <thead>
                        <tr>
                            <td>Title</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($my_appeals as $appeal)
                            <tr>
                                <td>{{ $appeal->title }}</td>
                                <td style="display:flex;">
                                    <a href="{{ route('user.appeals.edit', $appeal->id) }}" class="btn btn-warning mr-3">Edit</a>
                                    <form action="{{ route('user.appeals.delete', $appeal->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection