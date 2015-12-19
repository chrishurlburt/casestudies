@extends('admin-base')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1>Add New Learning Outcome</h1>
    </div>
</div>

{!! Breadcrumbs::render('create-outcome') !!}

@include('layouts.admin.partials._success')
@include('layouts.admin.partials._errors')


{!! Form::open(['route' => 'admin.outcomes.store']) !!}

@include('layouts.admin.partials._outcomes-form')

{!! Form::submit('Add Learning Outcome', ['class' => 'btn btn-primary form-control']) !!}

{!! Form::close() !!}

@stop