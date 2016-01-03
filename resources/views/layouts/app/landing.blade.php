@extends('base')

@section('content')

@if($errors->any())
    <ul class="alert alert-danger">
        @foreach($errors->all() as $error)

        <li>{{ $error }}</li>

        @endforeach
    </ul>
@endif

<h1>RWU Construction Management Case Studies</h1>

<a href="/admin">Log in</a>

<div class="row">
    <div class="col-lg-12">
        {!! Form::open(['route' => 'app.search']) !!}

        <div class="form-group">
            <h3>Keyword Search <small>(Enter keywords separated by comma or space)</small></h3>
            <div class="row">
                <div class="col-lg-8">
                {!! Form::text('keywords', null, ['class' => 'form-control']) !!}
                </div>
                <div class="col-lg-4">
                {!! Form::submit('Search Keywords', ['class' => 'btn btn-primary form-control']) !!}
                </div>
            </div>
        </div>



        {!! Form::close() !!}
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6">
        {!! Form::open(['route' => 'app.search']) !!}

            <div class="form-group">
                <h3>Outcome Search</h3>
            </div>

            @foreach($outcomes as $outcome)
                <div class="checkbox">
                    <label for="outcomes">
                        {!! Form::checkbox('outcomes[]', $outcome->id) !!}
                        {!! $outcome->name !!}
                    </label>
                </div>
            @endforeach

        {!! Form::submit('Search Outcomes', ['class' => 'btn btn-primary form-control']) !!}

        {!! Form::close() !!}
    </div>

    <div class="col-sm-12 col-md-6 col-lg-6">
        {!! Form::open(['route' => 'app.search']) !!}

            <div class="form-group">
                <h3>Courses Search</h3>
            </div>

            @foreach($courses as $course)
                <div class="checkbox">
                    <label for="courses">
                        {!! Form::checkbox('courses[]', $course->id) !!}
                        {!! $course->name !!}
                    </label>
                </div>
            @endforeach

        {!! Form::submit('Search Courses', ['class' => 'btn btn-primary form-control']) !!}

        {!! Form::close() !!}
    </div>

</div>

@stop