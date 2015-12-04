@extends('admin-base')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1>Add New Case Study</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i> <a href="/admin">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-wrench"></i> Add New Case Study
            </li>
        </ol>
    </div>
</div>

    {!! Form::open(['route' => 'admin.studies.store']) !!}

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

            {!! Form::label(null, 'Check all classes that apply') !!}<br />

            {!! Form::label('class1', 'Class 1') !!}
            {!! Form::checkbox('class1', 'class1'); !!}

            {!! Form::label('class2', 'Class 2') !!}
            {!! Form::checkbox('class2', 'class2'); !!}

            {!! Form::label('class3', 'Class 3') !!}
            {!! Form::checkbox('class3', 'class3'); !!}

            {!! Form::label('class4', 'Class 4') !!}
            {!! Form::checkbox('class4', 'class4'); !!}

            {!! Form::label('class5', 'Class 5') !!}
            {!! Form::checkbox('class5', 'class5'); !!}
        </div>

        <div class="form-group">

            {!! Form::label(null, 'Check all outcomes that apply') !!}<br />

            {!! Form::label('outcome1', 'outcome 1') !!}
            {!! Form::checkbox('outcome1', 'outcome1'); !!}

            {!! Form::label('outcome2', 'outcome 2') !!}
            {!! Form::checkbox('outcome2', 'outcome2'); !!}

            {!! Form::label('outcome3', 'outcome 3') !!}
            {!! Form::checkbox('outcome3', 'outcome3'); !!}

            {!! Form::label('outcome4', 'outcome 4') !!}
            {!! Form::checkbox('outcome4', 'outcome4'); !!}

            {!! Form::label('outcome5', 'outcome 5') !!}
            {!! Form::checkbox('outcome5', 'outcome5'); !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Publish Case Study', ['class' => 'btn btn-primary form-control', 'name' => 'publish']) !!}
            {!! Form::submit('Save Draft', ['class' => 'btn btn-primary form-control', 'name' => 'draft']) !!}
        </div>
    {!! Form::close() !!}
@stop