<!-- resources/views/journal/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $journal->title }}</h2>
    <p>{{ $journal->content }}</p>
</div>
@endsection
