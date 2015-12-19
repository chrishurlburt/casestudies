@extends('admin-base')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1>Add New Case Study</h1>
    </div>
</div>

{!! Breadcrumbs::render('create') !!}

@include('layouts.admin.partials._success')
@include('layouts.admin.partials._errors')

    {!! Form::open(['route' => 'admin.cases.store']) !!}

        <div class="form-group">
            {!! Form::label('title', 'Title') !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('problem', 'Problem') !!}
            {!! Form::textarea('problem', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('solution', 'Solution') !!}
            {!! Form::textarea('solution', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('analysis', 'Analysis') !!}
            {!! Form::textarea('analysis', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('slug', 'Custom URL') !!}
            {!! Form::text('slug', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('keywords', 'Keywords (Separate each with comma)') !!}
            {!! Form::text('keywords', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">

            {!! Form::label(null, 'Check all outcomes that apply') !!}<br />

            @foreach($outcomes as $outcome)
                {!! Form::label('outcomes', $outcome->name) !!}
                {!! Form::checkbox('outcomes[]', $outcome->id) !!}
            @endforeach

        </div>

        <div class="form-group">

        @if(Sentinel::findById(Auth::user()->id)->hasAccess(['publish']))
            {!! Form::submit('Publish Case Study', ['class' => 'btn btn-primary form-control', 'name' => 'publish']) !!}
        @endif
            {!! Form::submit('Save Draft', ['class' => 'btn btn-primary form-control', 'name' => 'draft']) !!}
        </div>
    {!! Form::close() !!}

@stop