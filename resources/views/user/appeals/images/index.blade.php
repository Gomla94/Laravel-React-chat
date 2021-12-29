@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">All Appeals</div>
            <div class="card-body">
                <a href="{{ route('user.appeal-images.create', $appeal->id) }}" class="btn btn-success mb-3">Add New Image</a>
                <table class="table">
                    <thead>
                        <tr>
                            <td>title</td>
                            <td>image</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appeal_images as $image)
                            <tr>
                                <td>{{ $image->title }}</td>
                                <td><img src="{{ asset($image->image) }}" width="150px" height="100px"></td>
                                <td style="display:flex;">
                                    <a href="{{ route('user.appeal-images.edit', [$appeal->id, $image->id]) }}" class="btn btn-warning mr-3">Edit</a>
                                    <form action="{{ route('user.appeal-images.delete', [$appeal->id, $image->id]) }}" method="POST">
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