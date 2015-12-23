@extends('admin-base')

@section('content')

@include('layouts.admin.partials._heading', ['heading' => 'Edit User'])

{!! Breadcrumbs::render('create-user') !!}

@include('layouts.admin.partials._success')
@include('layouts.admin.partials._errors')


{!! Form::model($user, ['method' => 'PUT', 'route' => ['admin.users.update', $user->id]]) !!}

@include('layouts.admin.partials._users-form', ['edit' => true])

{!! Form::submit('Update User', ['class' => 'btn btn-primary form-control']) !!}

{!! Form::close() !!}

<div class="row">
    <div class="col-lg-12">
        <a href="#"><button class="btn btn-primary form-control">Change Password</button></a>
    </div>
</div>

@stop