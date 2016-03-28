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
        <div class="latest">
            <h3>Latest Case Studies</h3>
            @foreach($studies as $study)

                @include('layouts.app.partials._study-listing', ['study' => $study])

            @endforeach
            <a href="#">View All Case Studies <i class="fa fa-arrow-right"></i></a>
        </div>
    </section>

    <footer>

    </footer>

@stop