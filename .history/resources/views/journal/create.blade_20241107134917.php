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
            <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image (optional)</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection

<!-- Tambahkan TinyMCE dengan API Key yang didapat dari TinyMCE -->
<script src="https://cdn.tiny.cloud/1/uvigt2i4ozvotz3ul2v94jo8wq327zjbvb6t8jk7anffbj5g/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    tinymce.init({
        selector: '#content', // Selektor untuk elemen textarea
        plugins: 'advlist autolink lists link image charmap print preview anchor',
        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | link image media | code',
        valid_elements: '*[*]',  // Membolehkan semua elemen HTML
        setup: function(editor) {
            editor.on('change', function() {
                tinymce.triggerSave();  // pastikan konten disimpan dengan benar
            });
        }
    });
</script>
