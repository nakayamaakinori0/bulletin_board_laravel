@extends('layouts.app')

@section('content')
    <h1>{{ $post->getTitle() }}</h1>
    <p>{{ $post->getContent() }}</p>
    <small>Created at: {{ $post->getCreatedAt()->format('Y-m-d H:i:s') }}</small>
    <br>
    <a href="{{ route('posts.index') }}>Back to all posts</a>
@endsection
