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

</main>

@stop