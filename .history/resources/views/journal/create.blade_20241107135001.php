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
            <div class="editor-toolbar">
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="formatText('bold')"><b>B</b></button>
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="formatText('italic')"><i>I</i></button>
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="formatText('underline')"><u>U</u></button>
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="formatText('insertOrderedList')">1 2 3</button>
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="formatText('insertUnorderedList')">•</button>
            </div>
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

<script>
    // Fungsi untuk menerapkan format teks
    function formatText(command) {
        document.execCommand(command, false, null);
        document.getElementById('content').focus();
    }
</script>
