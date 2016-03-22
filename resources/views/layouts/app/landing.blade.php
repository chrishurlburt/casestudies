@extends('base')
@section('bodyclass', 'landing')

@section('content')
<main id="landing-page">

    @include('layouts.app.partials._nav')

    <header id="hero">
        <figure>
            <img src="img/rwu-logo.png" class="logo" alt="logo" />
        </figure>
    </header>

    @if($errors->any())
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

            @endforeach
        </ul>
    @endif

    @include('layouts.app.partials._search')

    <section id="latest">
        <div class="latest">
            <h3>Latest Case Studies</h3>
            @foreach($studies as $study)
                <article>
                    <a href="/study/{{ $study->slug }}">{!! $study->title !!}</a></p>
                </article>
            @endforeach
            <a href="#">View All Case Studies <i class="fa fa-arrow-right"></i></a>
        </div>
    </section>

    <footer>

    </footer>

</main>
@stop