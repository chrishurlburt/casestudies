@extends('admin-base')
@section('bodyclass', 'profile')


@section('content')

<section id="heading">
    @include('layouts.admin.partials._heading', ['heading' => 'My Profile'])
    {!! Breadcrumbs::render('profile') !!}
</section>


@include('layouts.admin.partials._success')
@include('layouts.admin.partials._errors')

<main id="profile">
    <section id="account-info" class="card">
        <div class="card-header">
            <h3>{{ $user->first_name.' '.$user->last_name }}</h3>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <h3>Email</h3>
                <p>{{ $user->email }}</p>
            </div>
            <div class="col-lg-4">
                <h3>Role</h3>
                <p>{{ \Sentinel::findById($user->id)->roles()->first()->name }}</p>
            </div>
            <div class="col-lg-4">
                <h3>Published Studies</h3>
                <p>{{ count($studies) }}</p>
            </div>
        </div>

        <div class="card-footer">
            <a href="{{ route('admin.profile.password') }}"><button type="button" class="btn btn-primary">Change Password</button></a>
        </div>

    </section>

    <section id="user-studies" class="card">
        <div class="card-header">
            <h3>My Case Studies</h3>
        </div>
        @include('layouts.admin.partials._user-studies')
    </section>

</main>

@stop