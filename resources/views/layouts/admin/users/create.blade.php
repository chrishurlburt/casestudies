@extends('admin-base')
@section('bodyclass', 'create_user')
@section('sectionid', 'create-user')

@section('content')
<section id="heading">
    <h3 class="page-title">Add New User</h3>
    {!! Breadcrumbs::render('create-user') !!}
</section>

@include('layouts.admin.partials._success')
@include('layouts.admin.partials._errors')

<section id="create-user-form" class="card">
    {!! Form::open(['route' => 'admin.users.store']) !!}

    @include('layouts.admin.partials._users-form', ['edit' => false])

    <div class="card-footer">
        {!! Form::submit('Create User', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
</section>

@stop