<div class="row">
    <div class="col-lg-12">
        <h3>Filter by Outcome</h3>
        {!! Form::open(['route' => 'app.results.filter', 'method' => 'PUT']) !!}
        <input name="outcomes_reset" type="hidden" value="1">

        @foreach($outcomes as $outcome)
            <div class="checkbox">
                <label>
                    @if(isset($outcomes_checked))
                    {!! Form::checkbox('outcomes[]', $outcome->id, in_array($outcome->id, $outcomes_checked)) !!}
                    @else
                    {!! Form::checkbox('outcomes[]', $outcome->id) !!}
                    @endif
                    {!! $outcome->name !!}
                </label>
            </div>
        @endforeach

        <input class="btn btn-primary form-control" type="submit" value="Filter">
        {!! Form::close() !!}
    </div>
</div>