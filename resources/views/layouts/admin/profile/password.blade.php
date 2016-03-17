@extends('admin-base')

@section('content')

<section id="heading">
    @include('layouts.admin.partials._heading', ['heading' => 'Change Password'])
    {!! Breadcrumbs::render('profile-change-password') !!}
</section>

@include('layouts.admin.partials._success')
@include('layouts.admin.partials._errors')

<main id="profile-change-password">
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
</main>



@stop