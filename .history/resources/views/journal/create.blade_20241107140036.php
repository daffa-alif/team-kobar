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
            <!-- Input untuk SimpleMDE -->
            <textarea class="form-control" id="content" name="content" rows="5" required>{{ old('content') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image (optional)</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection

<!-- SimpleMDE CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplemde@1.11.2/dist/simplemde.min.css">

<!-- SimpleMDE JS -->
<script src="https://cdn.jsdelivr.net/npm/simplemde@1.11.2/dist/simplemde.min.js"></script>

<script>
    var simplemde = new SimpleMDE({ element: document.getElementById("content") });
</script>
