<div class="row">
    <div class="col-lg-12">
        <h3>Filter by Outcome</h3>
        {!! Form::open(['route' => 'app.results.filter', 'method' => 'PUT']) !!}

        @foreach($outcomes as $outcome)
            <div class="checkbox">
                <label for="outcomes" class="learning-outcome" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="left" data-content="{{ $outcome->description }}">
                    @if(isset($outcomes_checked))
                    {!! Form::checkbox('outcomes[]', $outcome->id, in_array($outcome->id, $outcomes_checked)) !!}
                    @else
                    {!! Form::checkbox('outcomes[]', $outcome->id) !!}
                    @endif
                    {!! $outcome->name !!}
                </label>
            </div>
        @endforeach
        {!! Form::submit('Filter', ['class' => 'btn btn-primary form-control', 'name' => 'outcomes_reset']) !!}
        {!! Form::close() !!}
    </div>
</div>