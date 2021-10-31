@extends('layouts.app')
@section('title')
    User Posts
@endsection
@section('content')
    <table>
        <tr>
            <th>Post Title</th>
            <th>Published</th>
            <th>Last Updated</th>
            <th>Actions</th>
        </tr>
        @foreach($posts as $post)
            <tr>
                <td><a href="/post/{{ $post->slug }}">{{ $post->title }}</a></td>
                <td>{{ $post->created_at->format('M d,Y \a\t h:i a') }}</td>
                <td>{{ $post->updated_at->format('M d,Y \a\t h:i a') }}</td>
                <td>
                    <a href="/edit/{{ $post->slug }}">Edit</a>
                    <a href="/delete/{{ $post->id }}">Delete</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
