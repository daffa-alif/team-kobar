@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Edit Journal</h2>
    <form action="{{ route('journal.update', $journal->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Menggunakan PUT untuk update data -->
        
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $journal->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="5" required>{{ old('content', $journal->content) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image (optional)</label>
            <input type="file" class="form-control" id="image" name="image">
            @if($journal->image)
                <div class="mt-2">
                    <p>Current Image:</p>
                    <img src="{{ asset('storage/' . $journal->image) }}" alt="Journal Image" width="150">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
