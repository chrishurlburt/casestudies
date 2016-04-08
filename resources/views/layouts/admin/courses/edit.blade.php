@extends('admin-base')
@section('content')
@section('sectionid', 'edit-course')

<section id="heading">
    <h3 class="page-title">Edit Course</h3>
    {!! Breadcrumbs::render('edit-course', $course->id) !!}
</section>

@include('layouts.admin.partials._errors')

<section id="edit-course-form" class="card">
    <div class="row">
        {!! Form::model($course, ['method' => 'PUT', 'route' => ['admin.courses.update', $course->id]]) !!}

            <div class="col-lg-8">
                @include('layouts.admin.partials._courses-form')
            </div>

            <div class="col-lg-4">
                @include('layouts.admin.partials._cases-form-outcomes', ['create' => false, 'data' => $course])
            </div>

            <div class="card-footer">
                {!! Form::submit('Update Course', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>
</section>

@stop