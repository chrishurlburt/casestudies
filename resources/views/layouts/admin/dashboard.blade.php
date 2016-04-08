@extends('admin-base')
@section('bodyclass', 'dashboard')
@section('sectionid', 'main-dashboard')


@section('content')
<section id="heading">
    <h2 class="page-title dashboard-heading">Dashboard <small>Welcome back, {{ Auth::user()->first_name.' '.Auth::user()->last_name }}!</small></h2>
</section>

@include('layouts.admin.partials._success')
@include('layouts.admin.partials._errors')

<section id="widgets" class="container-fluid">
    <div class="row">
        <article class="col-sm-12 col-md-6 col-lg-6">
            @include('layouts.admin.partials.widgets._notifications')
        </article>

        <article class="col-sm-12 col-md-6 col-lg-6">
            @include('layouts.admin.partials.widgets._team')
        </article>
    </div>
</section>

@stop