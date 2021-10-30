@extends('layouts.app')
@section('title')
    @if($post)
        {{ $post->title }}
        @if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->is_admin()))
            <button class="btn" style="float: right"><a href="{{ url('edit/'.$post->slug)}}">Edit Post</a></button>
        @endif
    @else
        Page does not exist
    @endif
@endsection
@section('title-meta')
    <p>{{ $post->created_at->format('M d,Y \a\t h:i a') }} By <a
            href="{{ url('/user/'.$post->author_id)}}">{{ $post->author->fullname }}</a></p>
@endsection
@section('content')
    @if($post)
        <section>
            <h1>{{ $post->title }}</h1>
            <p>{{ $post->body }}</p>
        </section>
    @else
        404 error
    @endif
@endsection
