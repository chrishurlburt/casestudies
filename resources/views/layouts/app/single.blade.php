@extends('base')

@section('content')

<h1>{{ $study->title }}</h1>
<hr />

<h3>Problem</h3>

{!! $study->problem !!}

<h3>Solution</h3>

{!! $study->solution !!}

<h3>Analysis</h3>

{!! $study->analysis !!}

<h3>Keywords</h3>
<ul>
@foreach($study->keywords as $keyword)
    <li>{{ $keyword->name }}</li>
@endforeach
</ul>

<h3>Outcomes</h3>
<ul>
@foreach($study->outcomes as $outcome)
    <li>{{ $outcome->name }}</li>
@endforeach
</ul>

<h3>Courses</h3>
<ul>
@foreach($study->outcomes as $outcome)
    @foreach($outcome->courses as $course)
        <li>{{ $course->name }}</li>
    @endforeach
@endforeach
</ul>

@stop