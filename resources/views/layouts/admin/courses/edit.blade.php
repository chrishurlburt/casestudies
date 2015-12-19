@extends('admin-base')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1>Edit Course</h1>
    </div>
</div>

{!! Breadcrumbs::render('edit-course') !!}

@include('layouts.admin.partials._errors')

{!! Form::model($course, ['method' => 'PATCH', 'route' => ['admin.courses.update', $course->id]]) !!}

@include('layouts.admin.partials._courses-form')

{!! Form::submit('Update Course', ['class' => 'btn btn-primary form-control']) !!}

{!! Form::close() !!}

@stop