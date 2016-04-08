@extends('admin-base')
@section('bodyclass', 'manage_users')
@section('sectionid', 'manage-users')

@section('content')

<section id="heading">
    <h3 class="page-title">Manage Users</h3>
    {!! Breadcrumbs::render('manage-users') !!}
</section>

@include('layouts.admin.partials._success')
@include('layouts.admin.partials._errors')

<section id="users" class="card">

    <div class="card-header">
        <a href="{{ route('admin.users.create') }}"><button class="btn btn-primary">New User</button></a>
        <div class="right">
            <span class="checked-count checked-count-users"></span>
            @include('layouts.admin.partials._card-header-menu', ['menu' => 'users'])
        </div>
    </div>

    @include('layouts.admin.partials._users', ['users' => $users, 'deactivated' => false])

    {!! Form::open(['method' => 'DELETE', 'id' => 'form-delete']) !!}
    {!! Form::close() !!}

</section>

@if(!$usersTrashed->isEmpty())
<section id="deactivated-users" class="card">
    <div class="card-header">
        <h4>Deactivated Users</h4>
        <div class="right">
            <span class="checked-count checked-count-deactivated-users"></span>
            @include('layouts.admin.partials._card-header-menu', ['menu' => 'deactivated-users'])
        </div>
    </div>

    @include('layouts.admin.partials._users', ['users' => $usersTrashed, 'deactivated' => true])

    {!! Form::open(['method' => 'PUT', 'id' => 'form-reactivate']) !!}
    {!! Form::close() !!}

</section>
@endif

@stop

@include('layouts.admin.partials._delete-modal')
