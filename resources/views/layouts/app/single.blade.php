@extends('base')

@section('content')

<h3>Title</h3>
<h1>{{ $study->name }}</h1>

<h3>Problem</h3>
<p>{{ $study->problem }}

<h3>Solution</h3>
<p>{{ $study->solution }}</p>

<h3>Analysis</h3>
<p>{{ $study->analysis }}<p>

<h3>Keywords</h3>
<ul>
    @foreach($study->keywords as $keyword)
       <li>{{ $keyword->name}}</li>
    @endforeach
</ul>

<h3>Learning Outcomes</h3>
<ul>
    @foreach($study->outcomes as $outcome)
        <li>{{ $outcome->name }}</li>
    @endforeach
</ul>

<h3>Applicable Courses</h3>
<ul>
    @foreach($study->courses as $course)
        <li>{{ $course->name }}</li>
    @endforeach
</ul>

<a href="/">Back</a>

@stop