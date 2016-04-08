@extends('admin-base')
@section('bodyclass', 'course_editor')
@section('sectionid', 'create-course')


@section('content')
<section id="heading">
    <h3 class="page-title">Add New Course</h3>
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

@stop