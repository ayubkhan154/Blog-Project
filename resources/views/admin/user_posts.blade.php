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
                <td>{{ $post->title }}</td>
                <td>{{ $post->created_at }}</td>
                <td>{{ $post->updated_at }}</td>
                <td>
                    <a href="/edit/{{ $post->id }}">Edit</a>
                    <a href="/delete/{{ $post->id }}">Delete</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
