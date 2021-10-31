@extends('layouts.app')
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
        <div class="panel-heading"><h1>{{ $user->fullname }}</h1></div>
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
        </div>
    </div>
@endsection
