@extends('layouts.app')
@section('title')
    User Posts
@endsection
@section('content')
    <div class="bg-white border">
        <table class="table m-0 table-hover">
            <thead>
            <tr>
                <th scope="col">Post Title</th>
                <th scope="col">Status</th>
                <th scope="col">Published</th>
                <th scope="col">Last Updated</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            @foreach($posts as $post)
                <tr>
                    <td class="align-middle"><a href="/post/{{ $post->slug }}">{{ $post->title }}</a></td>
                    <td class="align-middle">
                        @if($post->active)
                            <span class="badge badge-success">PUBLISHED</span>
                        @else
                            <span class="badge badge-secondary">DRAFT</span>
                        @endif
                    </td>
                    <td class="align-middle">{{ $post->created_at->format('M d,Y \a\t h:i a') }}</td>
                    <td class="align-middle">{{ $post->updated_at->format('M d,Y \a\t h:i a') }}</td>
                    <td class="align-middle">
                        <a class="btn btn-info" href="/edit/{{ $post->slug }}">Edit</a>
                        <a class="btn btn-danger" href="/delete/{{ $post->id }}">Delete</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
