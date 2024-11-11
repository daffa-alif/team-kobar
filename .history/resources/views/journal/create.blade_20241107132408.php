<form action="{{ route('journal.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" required value="{{ old('title') }}">
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <div id="editor"></div>  <!-- Editor untuk input konten -->
        <input type="hidden" name="content" id="content">  <!-- Hidden input untuk mengirim data -->
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image (optional)</label>
        <input type="file" class="form-control" id="image" name="image">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<script>
    var quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': '1'}, { 'header': '2' }, { 'font': [] }],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['bold', 'italic', 'underline'],
                ['link', 'image'],
                [{ 'align': [] }],
                ['clean']
            ]
        }
    });

    // Saat form disubmit, masukkan konten HTML ke dalam hidden input
    $('form').on('submit', function() {
        var content = quill.root.innerHTML;  // Ambil HTML yang dihasilkan oleh Quill
        $('#content').val(content);  // Isi hidden input dengan HTML tersebut
    });
</script>
