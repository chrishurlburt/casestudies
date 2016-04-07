@extends('base')
@section('bodyclass', 'error')
@section('page_id', 'error')

@section('content')
    <section id="error-message">
        <div class="wrap">
            <h1>We're sorry, the page you requested cannot be found!</h1>
            <p>Be sure to check your spelling.</p>
            <a href="{{ route('app.landing') }}">Get me outta here!</a>
        </div>
    </section>
@stop