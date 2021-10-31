@extends('layouts.app')
@section('notification')
    @if (\Session::has('success'))
        <div class="alert alert-success">
            {!! \Session::get('success') !!}
        </div>
    @endif
@endsection
@section('title')
    @if($post)
        {{ $post->title }}
        @if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->is_admin()))
            <button class="btn" style="float: right"><a href="{{ url('edit/'.$post->slug)}}">Edit Post</a></button>
        @endif
    @else
        Page does not exist
    @endif
    @if ($errors->any())
        <div class='flash alert-danger'>
            <ul class="panel-body">
                @foreach ( $errors->all() as $error )
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
@section('title-meta')
    <p>{{ $post->created_at->format('M d,Y \a\t h:i a') }} By <a
            href="{{ url('/user/'.$post->author_id)}}">{{ Auth::user()->getFullNameAttribute() }}</a></p>
@endsection
@section('content')
    @if($post)
        <section>
            <p>{{ $post->body }}</p>
        </section>
    @else
        404 error
    @endif
@endsection
