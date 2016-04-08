@extends('admin-base')
@section('bodyclass', 'profile_change_password')
@section('sectionid', 'profile-change-password')

@section('content')

<section id="heading">
    <h3 class="page-title">Change Password</h3>
    {!! Breadcrumbs::render('profile-change-password') !!}
</section>

@include('layouts.admin.partials._success')
@include('layouts.admin.partials._errors')

<section id="profile-change-password-form" class="card">

    {!! Form::open(['method' => 'PUT', 'route' => ['admin.profile.password.update']]) !!}

    <div class="row">
        <div class="form-group col-lg-6">
            <label>Old Password</label>
            {!! Form::password('old_password', ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="row">
        <div class="form-group col-lg-6">
            <label>New Password</label>
            {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-lg-6">
            <label>Confirm New Password</label>
            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="card-footer">
        {!! Form::submit('Update Password', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
</section>

@stop