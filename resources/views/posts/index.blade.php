@extends('layouts.app')
@section('content')
    <h1>Posts</h1>
    @foreach($posts as $post)
    <div>
        <h2>{{ $post->getTitle() }}</h2>
        <p>{{ $post->getContent() }}</p>
        <small>{{ $post->getCreatedAt()->format('Y-m-d H:i:s') }}</small>
    </div>
    @endforeach
    <a href="{{ route('posts.create') }}">Create new post</a>
@endsection
