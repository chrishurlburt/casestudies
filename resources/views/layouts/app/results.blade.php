@extends('base')
@section('bodyclass', 'results')
@section('page_id', 'results-page')

@section('content')

<header id="header">
    @include('layouts.app.partials._search')
</header>

<section id="results-data" class="row">
    <p class="results-count">{{ $studies->total() }} result(s) for '{{ $search['terms'] }}' - Page {{ $studies->currentPage() }} of {{ ceil($studies->total() / $studies->perPage()) }}</p>
</section>

<section id="results-main" class="row">
    <section id="results" class="col-lg-8">
        <div class="row">

                @if($studies->isEmpty())
                    <h3>No studies to show for the selected filter options.</h3>
                @else
                    @foreach($studies as $study)
                        <div class="col-lg-12">
                            @include('layouts.app.partials._study-listing', ['study' => $study])
                        </div>
                    @endforeach
                @endif
        </div>

        <div class="pagination-wrap">
            {!! $studies->render() !!}
        </div>
    </section>

    <section id="filters" class="col-lg-4">

        @if($search['type'] == 'outcomes')
            @include('layouts.app.filters.courses')
        @elseif($search['type'] == 'courses')
            @include('layouts.app.filters.outcomes')
        @elseif($search['type'] == 'keywords' || $search['type'] == 'all')
            @include('layouts.app.filters.outcomes')
            @include('layouts.app.filters.courses')
        @endif

        @include('layouts.app.filters.reset')

    </section>

</section>

@include('layouts.app.partials._footer')

@stop
