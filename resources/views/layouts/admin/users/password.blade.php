@extends('admin-base')

@section('content')


<section id="heading">
    @include('layouts.admin.partials._heading', ['heading' => 'Change Password for'.' '.$user->first_name.' '.$user->last_name])
    {!! Breadcrumbs::render('change-password', $user->id) !!}
</section>

@include('layouts.admin.partials._success')
@include('layouts.admin.partials._errors')

{!! Form::open(['method' => 'PUT', 'route' => ['admin.users.password.update', $user->id]]) !!}

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