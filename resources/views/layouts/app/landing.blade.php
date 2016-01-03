@extends('base')

@section('content')

@if($errors->any())
    <ul class="alert alert-danger">
        @foreach($errors->all() as $error)

        <li>{{ $error }}</li>

        @endforeach
    </ul>
@endif

<h1>Landing Page</h1>

<a href="/auth/login">Log in</a>

{!! Form::open(['route' => 'app.search']) !!}

<div class="form-group">
    <h3>Keyword Search <small>(Enter keywords separated by comma or space)</small></h3>
    {!! Form::text('keywords', null, ['class' => 'form-control']) !!}
</div>

{!! Form::submit('Search', ['class' => 'btn btn-primary form-control']) !!}

{!! Form::close() !!}

@stop