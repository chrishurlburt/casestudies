@extends('admin-base')

@section('content')

@include('layouts.admin.partials._heading', ['heading' => 'My Profile'])

{!! Breadcrumbs::render('profile') !!}

@include('layouts.admin.partials._success')
@include('layouts.admin.partials._errors')

<main id="profile">
  <h3>Email</h3>
  <p>{{ $user->email }}</p>

  <div class="row">
      <div class="col-lg-12">
          <a href="{{ route('admin.profile.password') }}"><button class="btn btn-primary form-control">Change Password</button></a>
      </div>
  </div>

  <h3>Case Studies</h3>
  @include('layouts.admin.partials._user-studies')

</main>

@stop