@extends('admin-base')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1>Edit Learning Outcome</h1>
    </div>
</div>

{!! Breadcrumbs::render('edit-outcome', $outcome->id) !!}

@include('layouts.admin.partials._errors')

{!! Form::model($outcome, ['method' => 'PATCH', 'route' => ['admin.outcomes.update', $outcome->id]]) !!}

@include('layouts.admin.partials._outcomes-form')

{!! Form::submit('Update Learning Outcome', ['class' => 'btn btn-primary form-control']) !!}

{!! Form::close() !!}

@stop