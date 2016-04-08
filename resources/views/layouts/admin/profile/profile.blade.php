@extends('admin-base')
@section('bodyclass', 'profile')
@section('sectionid', 'user-profile')

@section('content')

<section id="heading">
    <h3 class="page-title">{{ $user->first_name.' '.$user->last_name }}</h3>
    {!! Breadcrumbs::render('user-profile', $user) !!}
</section>

@include('layouts.admin.partials._account-info', ['auth_user' => false])

<section id="user-studies" class="card">
    <div class="card-header">
        <h3>Case Studies</h3>
    </div>
    @if(collect($studies)->isEmpty())
        <h3>This user has not added any case studies.</h3>
    @else
        @include('layouts.admin.partials._user-studies')
    @endif
</section>

@stop