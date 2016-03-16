@extends('admin-base')

@section('bodyclass', 'course_editor')

@section('content')
<main id="create-course">
    <section id="heading">
        @include('layouts.admin.partials._heading', ['heading' => 'Add New Course'])
        {!! Breadcrumbs::render('create-course') !!}
    </section>

    @include('layouts.admin.partials._success')
    @include('layouts.admin.partials._errors')

    <section id="create-course-form" class="card">
        <div class="row">
            {!! Form::open(['route' => 'admin.courses.store']) !!}

            <div class="col-lg-8">
                @include('layouts.admin.partials._courses-form')
            </div>

            <div class="col-lg-4">
                @include('layouts.admin.partials._cases-form-outcomes', ['create' => true])
            </div>

            <div class="card-footer">
                {!! Form::submit('Add Course', ['class' => 'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </section>
</main>

@stop