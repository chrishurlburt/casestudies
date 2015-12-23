@extends('admin-base')

@section('content')

@include('layouts.admin.partials._heading', ['heading' => 'Edit Course'])
{!! Breadcrumbs::render('edit-course', $course->id) !!}

@include('layouts.admin.partials._errors')

{!! Form::model($course, ['method' => 'PUT', 'route' => ['admin.courses.update', $course->id]]) !!}

@include('layouts.admin.partials._courses-form')

{!! Form::submit('Update Course', ['class' => 'btn btn-primary form-control']) !!}

{!! Form::close() !!}

@stop