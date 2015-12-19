@extends('admin-base')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1>Edit Case Study</h1>
    </div>
</div>

{!! Breadcrumbs::render('edit', $study->slug) !!}

@include('layouts.admin.partials._errors')

    {!! Form::model($study, ['method' => 'PATCH', 'route' => ['admin.cases.update', $study->slug]]) !!}

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
            {!! Form::text('keywords', $keywords, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">

            {!! Form::label(null, 'Check all outcomes that apply') !!}<br />

            @foreach($outcomes as $outcome)
                {!! Form::label('outcomes', $outcome->name) !!}
                {!! Form::checkbox('outcomes[]', $outcome->id, in_array($outcome->id, $study->outcomes()->lists('outcome_id')->toArray())) !!}
            @endforeach

        </div>

        <div class="form-group">
            @if($study->draft)

                {!! Form::submit('Update Draft', ['class' => 'btn btn-primary form-control', 'name' => 'update-draft'] ) !!}

                @if(Sentinel::findById(Auth::user()->id)->hasAccess(['publish']))
                {!! Form::submit('Publish Draft', ['class' => 'btn btn-primary form-control', 'name' => 'publish-draft'] ) !!}
                @endif

            @else
                @if(Sentinel::findById(Auth::user()->id)->hasAccess(['publish']))
                {!! Form::submit('Update Case Study', ['class' => 'btn btn-primary form-control', 'name' => 'update']) !!}
                @endif
            @endif



        </div>
    {!! Form::close() !!}
@stop

