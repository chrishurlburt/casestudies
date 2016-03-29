@extends('base')
@section('bodyclass', 'landing')
@section('page_id', 'landing-page')

@section('content')

    @include('layouts.app.partials._nav')

    <header id="hero">

        <section class="logo">
            <figure>
                <img src="img/rwu_white.gif" alt="logo" />
            </figure>
        </section>

        @include('layouts.app.partials._search')

            <a href="#latest" class="down-section">
                <i class="fa fa-angle-double-down"></i>
            </a>

    </header>

    @if($errors->any())
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

            @endforeach
        </ul>
    @endif


    <section id="latest">

        <h3 class="section-title">Latest Case Studies</h3>

            @foreach($studies as $study)

                @include('layouts.app.partials._study-listing', ['study' => $study])

            @endforeach

            <a href="#" class="view-all">View All Case Studies <i class="fa fa-arrow-right"></i></a>
    </section>

    <footer id="footer">
        <p>Copyright 2016, <a href="rwu.edu">Roger Williams University</a> • One Old Ferry Road, Bristol, RI 02809</p>
        <p>1-800-458-7144 • 401-253-1040</p>
    </footer>

@stop