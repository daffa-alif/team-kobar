@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        @if($journal->image_url)
            <img src="{{ asset('storage/' . $journal->image_url) }}" class="card-img-top" alt="{{ $journal->title }}" style="height: 400px; object-fit: cover;">
        @endif
        <div class="card-body">
            <h1 class="card-title display-4">{{ $journal->title }}</h1>
            <p class="text-muted">Published on {{ $journal->created_at->format('F j, Y') }}</p>
            <hr>
            <p class="card-text" style="font-size: 18px; line-height: 1.6;">
                {!! $journal->content !!}
            </p>
            <a href="{{ route('journal.index') }}" class="btn btn-secondary mt-4">Back to Journals</a>
        </div>
    </div>
</div>
@endsection
