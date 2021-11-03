@extends('layouts.app')
@section('notification')
    @if (\Session::has('success'))
        <div class="alert alert-danger">
            {!! \Session::get('success') !!}
        </div>
    @endif
@endsection
@section('title')
    {{$title}}
@endsection
@section('content')
    @if ( !$posts->count() )
        There is no post till now. Login and write a new post now!!!
    @else
        <div class="panel-body">
            <div class="list-group">
                <div class="pagination p-4 justify-content-center">
                    {{ $posts->links() }}
                </div>
                @foreach( $posts as $post )

                    <div class="list-group-item">
                        <h3><a href="{{ url('post/'.$post->slug) }}">{{ $post->title }}</a>
                            @if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->is_admin()))
                                @if($post->active == '1')
                                    <button class="btn" style="float: right"><a href="{{ url('edit/'.$post->slug)}}">Edit
                                            Post</a></button>
                                @else
                                    <button class="btn" style="float: right"><a href="{{ url('edit/'.$post->slug)}}">Edit
                                            Draft</a></button>
                                @endif
                            @endif
                        </h3>
                        <p>{{ $post->created_at->format('M d,Y \a\t h:i a') }} By <a
                                href="{{ url('/user/'.$post->author_id.'/posts')}}">{{ $post->author->fullname }}</a></p>
                    </div>
                    <div class="list-group-item mb-3">
                        <article>
                            {!! Str::limit($post->body, $limit = 1500, $end = '....... <a href='.url("/".$post->slug).'>Read More</a>') !!}
                        </article>
                    </div>

                @endforeach
            </div>
        </div>
        <div class="pagination p-4 justify-content-center">
            {{ $posts->links() }}
        </div>
        <br>
        <br>
    @endif
@endsection
