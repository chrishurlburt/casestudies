@extends('admin-base')

@section('content')

@include('layouts.admin.partials._heading', ['heading' => $user->first_name.' '.$user->last_name ])

{!! Breadcrumbs::render('user-profile', $user) !!}

<main id="user-profile">
  <h3>Email</h3>
  <p>{{ $user->email }}</p>

  <h3>Case Studies</h3>

  @if(collect($studies)->isEmpty())
    <p>This user has not posted any case studies.</p>
  @else
    @include('layouts.admin.partials._user-studies')
  @endif


</main>





@stop