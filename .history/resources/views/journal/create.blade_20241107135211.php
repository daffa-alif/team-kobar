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
            
            <!-- Buttons to apply text styles -->
            <div class="btn-group mb-2">
                <button type="button" class="btn btn-secondary" onclick="document.execCommand('bold', false, null)"><b>B</b></button>
                <button type="button" class="btn btn-secondary" onclick="document.execCommand('italic', false, null)"><i>I</i></button>
                <button type="button" class="btn btn-secondary" onclick="document.execCommand('underline', false, null)"><u>U</u></button>
            </div>
            
            <!-- Textarea with content -->
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
    // Optional: you can use JavaScript to ensure the focus stays on the textarea when applying formats.
    document.querySelectorAll('.btn-group button').forEach(button => {
        button.addEventListener('click', function () {
            document.querySelector('#content').focus();
        });
    });
</script>

@endsection
