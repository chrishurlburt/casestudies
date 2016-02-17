@extends('admin-base')

@section('bodyclass', 'case_study_editor')


@section('content')

<main id="cases-form">

    @include('layouts.admin.partials._heading', ['heading' => 'Add New Case Study'])

    {!! Breadcrumbs::render('create') !!}

    @include('layouts.admin.partials._success')
    @include('layouts.admin.partials._errors')

    <div class="row">
            {!! Form::open(['route' => 'admin.cases.store']) !!}
            <div class="col-lg-8">

               @include('layouts.admin.partials._cases-form')

            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <h3>Custom URL</h3>
                    {!! Form::text('slug', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    <h3>Keywords <small>(Separate each with a comma)</small></h3>
                    {!! Form::text('keywords', null, ['class' => 'form-control']) !!}
                </div>

                @include('layouts.admin.partials._cases-form-outcomes', ['create' => true])

            </div>

            <div class="col-lg-4">
                <div class="form-group">

                @if(Sentinel::findById(Auth::user()->id)->hasAccess(['publish']))
                    {!! Form::submit('Publish Case Study', ['class' => 'btn btn-primary form-control', 'name' => 'publish']) !!}
                @endif
                    {!! Form::submit('Save Draft', ['class' => 'btn btn-primary form-control', 'name' => 'draft']) !!}
                </div>
            </div>

            {!! Form::close() !!}
    </div>

</main>

@stop