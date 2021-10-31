@extends('layouts.app')
@section('title')
    Admin Dashboard
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
    <div class="panel panel-default">
        <div class="panel-heading"><h1>Users</h1></div>
        <div class="panel-body">
            <section>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>E-mail Address</th>
                        <th>Joined on</th>
                        <th>Actions</th>
                    </tr>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('M d,Y \a\t h:i a') }}</td>
                            <td><a href="/admin/user/{{ $user->id }}">View Posts</a></td>
                        </tr>
                    @endforeach
                </table>
            </section>
        </div>
    </div>
@endsection
