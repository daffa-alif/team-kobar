@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Create New Journal</h2>
    <form action="{{ route('journal.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <!-- Menggunakan trix editor -->
            <input id="content" type="hidden" name="content">
            <trix-editor input="content"></trix-editor>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image (optional)</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection

<!-- Tambahkan Trix CSS dan JS -->
<link href="https://cdn.jsdelivr.net/npm/trix@2.0.0/dist/trix.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/trix@2.0.0/dist/trix.min.js"></script>
