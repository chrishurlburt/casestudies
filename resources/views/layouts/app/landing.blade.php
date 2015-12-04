@extends('base')

@section('content')

<h1>Landing Page</h1>

<a href="{{ route('home.studies') }}">List all the case studies</a><br />
<a href="/auth/login">Log in</a>

@stop