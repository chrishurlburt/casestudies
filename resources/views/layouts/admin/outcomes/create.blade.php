@extends('admin-base')

@section('content')

@include('layouts.admin.partials._heading', ['heading' => 'Add New Learning Outcome'])

{!! Breadcrumbs::render('create-outcome') !!}

@include('layouts.admin.partials._success')
@include('layouts.admin.partials._errors')


{!! Form::open(['route' => 'admin.outcomes.store']) !!}

@include('layouts.admin.partials._outcomes-form')

{!! Form::submit('Add Learning Outcome', ['class' => 'btn btn-primary form-control']) !!}

{!! Form::close() !!}

@stop