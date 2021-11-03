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
        <div class="panel-body">
            <section>
                <div class="bg-white border">
                    <table class="table mb-0 table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">E-mail Address</th>
                            <th scope="col">Joined on</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        @foreach($users as $user)
                            <tr class=".flex-row">
                                <td class="align-middle">{{ $user->user_name }}</td>
                                <td class="align-middle">{{ $user->first_name }}</td>
                                <td class="align-middle">{{ $user->last_name }}</td>
                                <td class="align-middle">{{ $user->email }}</td>
                                <td class="align-middle">{{ $user->created_at->format('M d,Y') }}</td>
                                <td class="align-middle col-5">
                                    <a class="btn btn-primary" href="/admin/user/{{ $user->id }}">Edit User</a>
                                    <a class="btn btn-secondary" href="/admin/user/{{ $user->id }}/posts">View User's posts</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </section>
            <br>
            <br>
        </div>
    </div>
@endsection
