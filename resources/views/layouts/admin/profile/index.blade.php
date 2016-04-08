@extends('admin-base')
@section('bodyclass', 'profile')
@section('sectionid', 'profile')

@section('content')

<section id="heading">
    <h3 class="page-title">My Profile</h3>
    {!! Breadcrumbs::render('profile') !!}
</section>

@include('layouts.admin.partials._success')
@include('layouts.admin.partials._errors')

@include('layouts.admin.partials._account-info', ['auth_user' => true])

<section id="user-studies" class="card">
    <div class="card-header">
        <h3>My Case Studies</h3>
    </div>
    @if(collect($studies)->isEmpty())
        <h3>You have not added any case studies.</h3>
    @else
        @include('layouts.admin.partials._user-studies')
    @endif
</section>

@stop