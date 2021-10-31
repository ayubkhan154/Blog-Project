@extends('layouts.app')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"><h1> {{ $user->fullname }} </h1></div>
        <p>Joined on {{$user->created_at->format('M d,Y \a\t h:i a') }}</p>
        @if (\Session::has('success'))
            <div class="alert alert-success">
                {!! \Session::get('success') !!}
            </div>
        @endif
        <div class="panel-body">
            <div class="card-body">
                <form method="POST" action="{{ url('/update-profile') }}">
                    @csrf
                    <h2>Your Information</h2>
{{--                    @if($errors->any())--}}
{{--                        {{ implode('', $errors->all(':message')) }}--}}
{{--                    @endif--}}
{{--                    <table>--}}
                        <tr>
                            <td>Email</td>
                            <td>
                               {{ $user->email  }}
                            </td>
                        </tr> <tr>
                            <td>Username</td>
                            <td>
                                <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name"
                                       value="{{ $user->user_name }}" required autocomplete="username" autofocus>

                                @error('user_name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>First Name</td>
                            <td>
                                <input id="first_name" type="text"
                                       class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                       value="{{ $user->first_name }}" required autocomplete="given-name" autofocus>

                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>Last Name</td>
                            <td><input id="last_name" type="text"
                                       class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                       value="{{ $user->last_name }}" required autocomplete="family-name" autofocus>

                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror</td>
                        </tr>
                    </table>
                    <br>
                    <br>
                    <div class="form-group row mb-0">
                        <div class="col-md-4 offset-md-2">
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{ url('change-password') }}">Change Password</a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
