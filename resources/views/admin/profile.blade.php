@extends('layouts.app')
@section('title')
    {{ $user->name }}
@endsection
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"><h1>Profile</h1></div>
        <div class="panel-body">
            <section>
                <h2>Your Information</h2>
                <p>Joined on {{$user->created_at->format('M d,Y \a\t h:i a') }}</p>
                <table>
                    <tr>
                        <td>Username</td>
                        <td>{{ $user->user_name }}</td>
                    </tr>
                    <tr>
                        <td>First Name</td>
                        <td>{{ $user->first_name }}</td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td>{{ $user->last_name }}</td>
                    </tr>
                    <tr>
                        <td>E-mail Address</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                </table>
            </section>
            <section>
                <h2>Your Posts</h2>
                @if(!empty($latest_posts[0]))
                    @foreach($latest_posts as $latest_post)
                        <p>
                            <strong><a href="{{ url('/'.$latest_post->slug) }}">{{ $latest_post->title }}</a></strong>
                            <span class="well-sm">On {{ $latest_post->created_at->format('M d,Y \a\t h:i a') }}</span>
                        </p>
                    @endforeach
                @else
                    <p>You have not written any post till now.</p>
                @endif
            </section>
        </div>
    </div>
@endsection
