@extends('admin-base')

@section('content')

<main id="change-password">
    <section id="heading">
        @include('layouts.admin.partials._heading', ['heading' => 'Change Password for'.' '.$user->first_name.' '.$user->last_name])
        {!! Breadcrumbs::render('change-password', $user->id) !!}
    </section>

    @include('layouts.admin.partials._success')
    @include('layouts.admin.partials._errors')
    <section id="change-password-form" class="card">
        {!! Form::open(['method' => 'PUT', 'route' => ['admin.users.password.update', $user->id]]) !!}

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
            {!! Form::close() !!}
        </div>
    </section>
</main>

@stop