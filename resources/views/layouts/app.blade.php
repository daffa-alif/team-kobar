<!DOCTYPE html>
<html lang="en">
<head>
    <title>Diary Journal</title>
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/587zdcqu5fv7s17cbm84aya9rtkh2snlkcr9ym8xt4tgn0xd/tinymce/5/tinymce.min.js"></script>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('journal.index') }}">Diary Journal</a>
            <button 
                class="navbar-toggler" 
                type="button" 
                data-bs-toggle="collapse" 
                data-bs-target="#navbarNav" 
                aria-controls="navbarNav" 
                aria-expanded="false" 
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('journal.index') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('journal.create') }}">Unggah</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.welcome') }}">Profil</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content Section -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Bootstrap JS (required for collapsible menu) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- TinyMCE Initialization -->
    <script>
        tinymce.init({
          selector: 'textarea#content',
          plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
          toolbar_mode: 'floating',
          setup: function (editor) {
              editor.on('change', function () {
                  tinymce.triggerSave();
              });
              editor.on('BeforeSetContent', function(e) {
                  e.content = e.content.replace(/{/g, '').replace(/}/g, '');
              });
          }
        });
      </script>
          
</body>
</html>
