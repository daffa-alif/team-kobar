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
            <!-- Summernote editor untuk konten -->
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

<!-- Tambahkan CDN untuk Summernote -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<!-- Inisialisasi Summernote -->
<script>
    $(document).ready(function() {
        // Pastikan Summernote hanya diinisialisasi setelah jQuery dimuat
        $('#content').summernote({
            height: 200, // Tinggi editor
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']], // Tombol format teks
                ['insert', ['link', 'picture']], // Menyisipkan link dan gambar
                ['view', ['fullscreen', 'codeview']] // Tombol view
            ]
        });
    });
</script>
