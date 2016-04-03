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

<section id="study-footer" class="study-section">
    <aside class="keywords footer-block">
        <h3>Keywords</h3>
        <ul class="keywords">
        @foreach($study->keywords as $keyword)
            <li><span class="label label-default">{{ $keyword->name }}</span></li>
        @endforeach
        </ul>
    </aside>
    <aside class="outcomes footer-block">
        <h3>Outcomes</h3>
        <ul>
        @foreach($study->outcomes as $outcome)
            <li>{{ $outcome->name }}</li>
        @endforeach
        </ul>
    </aside>
    <aside class="courses footer-block">
        <h3>Courses</h3>
        <ul>
        @foreach($study->outcomes as $outcome)
            @foreach($outcome->courses as $course)
                <li>{!! $course->subject_name.' '.$course->course_number !!}</li>
            @endforeach
        @endforeach
        </ul>
    </aside>
</section>


@stop