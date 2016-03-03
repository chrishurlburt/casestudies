@extends('admin-base')


@section('content')
<main id="create-course">
    <section id="heading">
        @include('layouts.admin.partials._heading', ['heading' => 'Add New Course'])
        {!! Breadcrumbs::render('create-course') !!}
    </section>

    @include('layouts.admin.partials._success')
    @include('layouts.admin.partials._errors')

    <section id="create-course-form" class="card">
        {!! Form::open(['route' => 'admin.courses.store']) !!}

        @include('layouts.admin.partials._courses-form')
        {!! Form::submit('Add Course', ['class' => 'btn btn-primary form-control']) !!}

        {!! Form::close() !!}
    </section>
</main>

@stop