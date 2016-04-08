@extends('admin-base')
@section('bodyclass', 'edit_outcome')
@section('sectionid', 'edit-outcome')

@section('content')
<section id="heading">
    <h3 class="page-title">Edit Learning Outcome</h3>
    {!! Breadcrumbs::render('edit-outcome', $outcome->id) !!}
</section>

@include('layouts.admin.partials._errors')

<section id="edit-outcome-form" class="card">
    {!! Form::model($outcome, ['method' => 'PUT', 'route' => ['admin.outcomes.update', $outcome->id]]) !!}

        @include('layouts.admin.partials._outcomes-form')

        <div class="card-footer">
            {!! Form::submit('Update Learning Outcome', ['class' => 'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}
</section>

@stop