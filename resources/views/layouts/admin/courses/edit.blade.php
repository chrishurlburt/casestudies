@extends('admin-base')

@section('content')
<main id="edit-course">
    <section id="heading">
        @include('layouts.admin.partials._heading', ['heading' => 'Edit Course'])
        {!! Breadcrumbs::render('edit-course', $course->id) !!}
    </section>

    @include('layouts.admin.partials._errors')

    <section id="edit-course-form" class="card">
        {!! Form::model($course, ['method' => 'PUT', 'route' => ['admin.courses.update', $course->id]]) !!}

        @include('layouts.admin.partials._courses-form')

        {!! Form::submit('Update Course', ['class' => 'btn btn-primary form-control']) !!}

        {!! Form::close() !!}
    </section>
</main>

@stop