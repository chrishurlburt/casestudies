@extends('admin-base')
@section('bodyclass', 'edit_user')
@section('sectionid', 'edit-user')

@section('content')

<section id="heading">
    <h3 class="page-title">Edit User</h3>
    {!! Breadcrumbs::render('edit-user', $user->id) !!}
</section>

@include('layouts.admin.partials._success')
@include('layouts.admin.partials._errors')

<section id="edit-user-form" class="card">
    {!! Form::model($user, ['method' => 'PUT', 'route' => ['admin.users.update', $user->id]]) !!}

        @include('layouts.admin.partials._users-form', ['edit' => true])

        <div class="card-footer">
            {!! Form::submit('Update User', ['class' => 'btn btn-primary']) !!}
            <a href="{{ route('admin.users.password.index', $user->id) }}"><button type="button" class="btn btn-secondary">Change Password</button></a>
        </div>

    {!! Form::close() !!}

</section>

@stop