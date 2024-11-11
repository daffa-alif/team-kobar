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
        
        <!-- Tombol untuk menambahkan format teks -->
        <div class="mb-3">
            <button type="button" class="btn btn-secondary" id="bold-btn"><b>B</b></button>
            <button type="button" class="btn btn-secondary" id="italic-btn"><i>I</i></button>
            <button type="button" class="btn btn-secondary" id="underline-btn"><u>U</u></button>
            <button type="button" class="btn btn-secondary" id="link-btn">Link</button>
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

<script>
    // Function for adding formatting to textarea
    document.getElementById('bold-btn').addEventListener('click', function() {
        addTextFormat('<b>', '</b>');
    });

    document.getElementById('italic-btn').addEventListener('click', function() {
        addTextFormat('<i>', '</i>');
    });

    document.getElementById('underline-btn').addEventListener('click', function() {
        addTextFormat('<u>', '</u>');
    });

    document.getElementById('link-btn').addEventListener('click', function() {
        let url = prompt("Enter the URL:");
        addTextFormat('<a href="' + url + '">', '</a>');
    });

    // Function to insert formatted text into textarea
    function addTextFormat(startTag, endTag) {
        let textarea = document.getElementById('content');
        let selectedText = textarea.value.substring(textarea.selectionStart, textarea.selectionEnd);
        
        // If there's selected text, wrap it in the tags
        if (selectedText) {
            textarea.setRangeText(startTag + selectedText + endTag);
        } else {
            // If no text selected, insert the tags at the cursor position
            let cursorPosition = textarea.selectionStart;
            let currentText = textarea.value;
            textarea.value = currentText.slice(0, cursorPosition) + startTag + currentText.slicea(cursorPosition) + endTag;
        }
    }
</script>

@endsection
