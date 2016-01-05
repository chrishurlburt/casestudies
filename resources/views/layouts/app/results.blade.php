@extends('base')

@section('content')

<h1>Search Results for: </h1>
<h4>{{ $search_terms }}</h4>
<hr />

@if(!$studies->isEmpty())
<div class="row">
    <div class="col-lg-8">

        <div class="row">
            <div class="col-lg-12">
                @foreach($studies as $study)
                    <a href="{{ route('app.single', ['slug' => $study->slug]) }}"><h4>{{ $study->title }}</h4></a>
                @endforeach
            </div>
        </div>

    </div>

    <div class="col-lg-4">
        <div class="row">
            <div class="col-lg-12">
                <h3>Filter by Outcome</h3>
                {!! Form::open(['route' => 'app.results.filter', 'method' => 'PUT']) !!}
                @foreach($outcomes as $outcome)
                    <div class="checkbox">
                        <label>
                            {!! Form::checkbox('outcomes[]', $outcome->id) !!}
                            {!! $outcome->name !!}
                        </label>
                    </div>
                @endforeach
                <input class="btn btn-primary form-control" type="submit" value="Filter">
                {!! Form::close() !!}
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h3>Filter by Course</h3>

                @foreach($courses as $course)
                    <div class="checkbox">
                        <label>
                            {!! Form::checkbox('courses[]', $course->id) !!}
                            {!! $course->name !!}
                        </label>
                    </div>
                @endforeach
                <input class="btn btn-primary form-control" type="submit" value="Filter">
            </div>
        </div>
    </div>

</div>

@endif

@stop
