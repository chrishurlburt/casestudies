@extends('admin-base')
@section('bodyclass', 'studies_settings')
@section('sectionid', 'studies-settings')

@section('content')

<section id="heading">
    <h3 class="page-title">Case Study Settings</h3>
    {!! Breadcrumbs::render('study-settings') !!}
</section>

@include('layouts.admin.partials._success')
@include('layouts.admin.partials._errors')

<section id="URLs" class="card">
    <div class="card-header">
        <h3>Reset URLs</h3>
    </div>

    {!! Form::open(['method' => 'PUT', 'route' => 'admin.settings.studies.reseturls', 'id' => 'reseturlform']) !!}
    {!! Form::submit('Reset URLs', ['id' => 'reseturls', 'class' => 'btn btn-warning', 'name' => 'reseturls']) !!}
    {!! Form::close() !!}

</section>


@include('layouts.admin.partials._reseturl-modal')


@stop