@extends('admin-base')

@section('content')

<main id="edit-user">

    <section id="heading">
        @include('layouts.admin.partials._heading', ['heading' => 'Edit User'])
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


</main>

@stop