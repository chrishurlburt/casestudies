@extends('base')
@section('bodyclass', 'single-study')
@section('page_id', 'single-page')

@section('content')
<header id="header">
    <h1 class="title">{{ $study->title }}</h1>
    <p class="date"><i class="fa fa-clock-o"></i> {!! date('F d, Y', strtotime($study->created_at)) !!}</p>
    <ul class="subnav">
        <li><a href="#problem">Problem</a></li>
        <li><a href="#solution">Solution</a></li>
        <li><a href="#analysis">Analysis</a></li>
        <li><a href="#background">Background</a></li>
    </ul>

</header>

<section id="problem" class="study-section">
    <h2 class="study-section-title">Problem</h2>
    {!! $study->problem !!}
</section>

<section id="solution" class="study-section">
    <h2 class="study-section-title">Solution</h2>
    {!! $study->solution !!}
</section>

<section id="analysis" class="study-section">
    <h2 class="study-section-title">Analysis</h2>
    {!! $study->analysis !!}
</section>

<section id="background" class="study-section">
    <h2 class="study-section-title">Background Information</h2>

    <section id="study-background" class="background-info">
        <article class="background-block">
            <p>Topic: {{ $study->topic or 'Not Given' }}</p>
            <p>Project Location: {{ $study->location or 'Not Given' }}</p>
            <p>Estimated Schedule (months): {{ $study->estimated_schedule or 'Not Given' }}</p>
            <p>Contract Value ($): {{ $study->contract_value or 'Not Given' }}</p>
        </article>
        <article class="background-block">
            <p>Project Schedule Impacted: {{ $study->schedule_impact or 'Not Given'  }}</p>
            <p>Project Budget Impacted: {{ $study->budget_impact or 'Not Given' }}</p>
            <p>Market Sector: {{ $study->market_sector or 'Not Given' }}</p>
            <p>Delivery Method: {{ $study->delivery_method or 'Not Given' }}</p>
        </article>
    </section>

    <section id="categories" class="background-info">
        <article class="keywords category-block">
            <h3>Keywords</h3>
            <ul class="keywords">
            @foreach($study->keywords as $keyword)
                <li><span class="label label-default">{{ $keyword->name }}</span></li>
            @endforeach
            </ul>
        </article>
        <article class="outcomes category-block">
            <h3>Outcomes</h3>
            <ul>
            @foreach($study->outcomes as $outcome)
                <li>{{ $outcome->name }}</li>
            @endforeach
            </ul>
        </article>
        <article class="courses category-block">
            <h3>Courses</h3>
            <ul>
            @foreach($study->outcomes as $outcome)
                @foreach($outcome->courses as $course)
                    <li>{!! $course->subject_name.' '.$course->course_number !!}</li>
                @endforeach
            @endforeach
            </ul>
        </article>
    </section>

</section>



@include('layouts.app.partials._footer')

@stop