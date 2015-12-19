@extends('admin-base')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1>Add New Course</h1>
    </div>
</div>

{!! Breadcrumbs::render('create-course') !!}

@include('layouts.admin.partials._success')
@include('layouts.admin.partials._errors')


{!! Form::open(['route' => 'admin.courses.store']) !!}

@include('layouts.admin.partials._courses-form')

{!! Form::submit('Add Course', ['class' => 'btn btn-primary form-control']) !!}

{!! Form::close() !!}

@stop