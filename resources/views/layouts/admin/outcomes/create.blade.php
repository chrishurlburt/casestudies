@extends('admin-base')
@section('bodyclass', 'create_outcome')
@section('sectionid', 'create-outcome')

@section('content')
<section id="heading">
    <h3 class="page-title">Add New Learning Outcome</h3>
    {!! Breadcrumbs::render('create-outcome') !!}
</section>

<section id="create-outcome-form" class="card">
    @include('layouts.admin.partials._success')
    @include('layouts.admin.partials._errors')

    {!! Form::open(['route' => 'admin.outcomes.store']) !!}

        @include('layouts.admin.partials._outcomes-form')

        <div class="card-footer">
        {!! Form::submit('Add Learning Outcome', ['class' => 'btn btn-primary']) !!}
        </div>

    {!! Form::close() !!}
</section>

@stop