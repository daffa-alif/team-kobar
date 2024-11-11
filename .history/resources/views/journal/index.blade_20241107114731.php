@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Menampilkan pesan sukses jika ada -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h2>My Journals</h2>
    <div class="row">
        @forelse($journals as $journal)
            <div class="col-md-4 mb-4">
                <div class="card" style="width: 18rem;">
                    <img src="{{ $journal->image_url ? asset('storage/' . $journal->image_url) : 'https://via.placeholder.com/150' }}" class="card-img-top" alt="{{ $journal->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $journal->title }}</h5>
                        <p class="card-text">{{ Str::limit($journal->content, 100) }}</p>
                        
                        <!-- Menampilkan tanggal pembuatan dan pembaruan -->
                        <p class="text-muted">
                            Tanggal dibuat: {{ $journal->created_at->format('d M Y H:i') }}<br>
                            @if($journal->created_at != $journal->updated_at)
                            pembaruan terakhir {{ $journal->updated_at->format('d M Y H:i') }}
                            @endif
                        </p>

                        <a href="{{ route('journal.show', $journal->id) }}" class="btn btn-primary">Read More</a>

                        <form action="{{ route('journal.destroy', $journal->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus jurnal ini?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">No journals found.</p>
        @endforelse
    </div>
</div>
@endsection
