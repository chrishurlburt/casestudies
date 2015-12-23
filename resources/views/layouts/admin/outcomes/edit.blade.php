@extends('admin-base')

@section('content')

@include('layouts.admin.partials._heading', ['heading' => 'Edit Learning Outcome'])


{!! Breadcrumbs::render('edit-outcome', $outcome->id) !!}

@include('layouts.admin.partials._errors')

{!! Form::model($outcome, ['method' => 'PUT', 'route' => ['admin.outcomes.update', $outcome->id]]) !!}

@include('layouts.admin.partials._outcomes-form')

{!! Form::submit('Update Learning Outcome', ['class' => 'btn btn-primary form-control']) !!}

{!! Form::close() !!}

@stop