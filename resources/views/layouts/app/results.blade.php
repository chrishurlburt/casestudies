@extends('base')

@section('content')

<h1>Search Results for: </h1>
<h4>{{ $search['terms'] }}</h4>
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

        @if($search['type'] == 'outcomes')
            @include('layouts.app.filters.courses')
        @elseif($search['type'] == 'courses')
            @include('layouts.app.filters.outcomes')
        @elseif($search['type'] == 'keywords')
            @include('layouts.app.filters.outcomes')
            @include('layouts.app.filters.courses')
        @endif

    </div>

</div>

<div class="row">
    <div class="col-lg-offset-3">
        {!! $studies->render() !!}
    </div>
</div>

@endif

@stop
