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
            <div id="editor"></div>  <!-- Quill editor will be here -->
            <input type="hidden" name="content" id="content" required> <!-- Hidden input to store formatted content -->
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image (optional)</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection

<!-- Include Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<!-- Include Quill JS -->
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<script>
    // Initialize Quill editor
    var quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': '1' }, { 'header': '2' }, { 'font': [] }],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['bold', 'italic', 'underline'],
                ['link', 'image'],
                [{ 'align': [] }],
                ['clean'] // Button to clear formatting
            ]
        }
    });

    // Capture the content of the Quill editor and put it in the hidden input
    $('form').on('submit', function() {
        var content = quill.root.innerHTML;  // Get formatted content
        $('#content').val(content);  // Insert content into hidden input
    });
</script>
