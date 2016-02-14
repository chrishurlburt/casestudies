@extends('admin-base')

@section('content')

@include('layouts.admin.partials._heading', ['heading' => 'Change Password'])

{!! Breadcrumbs::render('profile-change-password') !!}

@include('layouts.admin.partials._success')
@include('layouts.admin.partials._errors')

{!! Form::open(['method' => 'PUT', 'route' => ['admin.profile.password.update']]) !!}

<div class="form-group">
    <h3>Old Password</h3>
    {!! Form::password('old_password', ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <h3>New Password</h3>
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <h3>Confirm New Password</h3>
    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
</div>

{!! Form::submit('Update Password', ['class' => 'btn btn-primary form-control']) !!}

{!! Form::close() !!}

@stop