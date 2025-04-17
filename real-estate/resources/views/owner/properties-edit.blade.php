@extends('layouts.owner')

@section('content')
<div class="container">
    <h1>Edit Property</h1>
    <form action="{{ route('properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $property->title }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" required>{{ $property->description }}</textarea>
        </div>

        <!-- Add other fields as necessary -->

        <button type="submit" class="btn btn-primary">Update Property</button>
    </form>
</div>
@endsection
