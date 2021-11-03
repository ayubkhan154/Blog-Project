@extends('layouts.app')
@section('title')
    {{$title}}
@endsection
@section('content')
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
    @if(Auth::user()->id == $user->id || Auth::user()->is_admin())
        <ul class="list-group">
            <li class="list-group-item">
                Joined on {{$user->created_at->format('M d,Y \a\t h:i a') }}
            </li>
            <li class="list-group-item panel-body">
                <table class="table-padding">
                    <style>
                        .table-padding td{
                            padding: 3px 8px;
                        }
                    </style>
                    <tr>
                        <td>Total Posts</td>
                        <td> {{$posts_count}}</td>
                        @if($posts_count)
                            <td><a href="{{ url('/my-all-posts')}}">Show All</a></td>
                        @endif
                    </tr>
                    <tr>
                        <td>Posts in Draft </td>
                        <td>{{$posts_draft_count}}</td>
                        @if($posts_draft_count)
                            <td><a href="{{ url('my-drafts')}}">Show All</a></td>
                        @endif
                    </tr>
                </table>
            </li>
        </ul>
        <br>
        <br>
    @endif
    @if ( !$posts->count() )
        There is no post till now. Login and write a new post now!!!
    @else
        <div class="">
            <div class="list-group">
                <h2>Published Posts</h2>
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
                                href="{{ url('/user/'.$post->author_id)}}">{{ $post->author->fullname }}</a></p>
                    </div>
                    <div class="list-group-item mb-3">
                        <article>
                            {!! Str::limit($post->body, $limit = 1500, $end = '....... <a href='.url("/".$post->slug).'>Read More</a>') !!}
                        </article>
                    </div>

                @endforeach
            </div>
            <div class="pagination p-4 justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>
    @endif
@endsection
