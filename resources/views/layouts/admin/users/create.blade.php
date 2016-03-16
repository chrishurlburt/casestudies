@extends('admin-base')

@section('content')
<main id="create-user">
    <section id="heading">
        @include('layouts.admin.partials._heading', ['heading' => 'Add New User'])
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
</main>

@stop