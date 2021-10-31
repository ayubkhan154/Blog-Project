@extends('layouts.app')
@section('title')
    @if (\Session::has('success'))
        <div class="alert alert-success">
            {!! \Session::get('success') !!}
        </div>
    @endif

Add New Post

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

<form action="/new-post" method="post">

<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">

<input required="required" value="{{ old('title') }}" placeholder="Enter title here" type="text" name = "title"class="form-control" />

</div>

<div class="form-group">

<textarea name='body'class="form-control">{{ old('body') }}</textarea>

</div>

<input type="submit" name='publish' class="btn btn-success" value = "Publish"/>

<input type="submit" name='save' class="btn btn-primary" value = "Save Draft" />

</form>

@endsection
