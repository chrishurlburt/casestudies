@extends('admin-base')
@section('bodyclass', 'manage_users')

@section('content')

<section id="heading">
    @include('layouts.admin.partials._heading', ['heading' => 'Manage Users'])
    {!! Breadcrumbs::render('manage-users') !!}
</section>

@include('layouts.admin.partials._success')
@include('layouts.admin.partials._errors')

@include('layouts.admin.partials._users', ['users' => $users, 'deactivated' => false])

@if(!$usersTrashed->isEmpty())
    <a class="btn btn-primary" role="button" data-toggle="collapse" href="#deactivated" aria-expanded="false" aria-controls="collapseExample">
        Show Deactivated Users
    </a>

    <div class="collapse" id="deactivated">

        @include('layouts.admin.partials._users', ['users' => $usersTrashed, 'deactivated' => true])

    </div>
@endif


@stop

@include('layouts.admin.partials._delete-modal')
