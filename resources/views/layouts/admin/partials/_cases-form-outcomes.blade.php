
    <div class="form-group">

        <h3>Learning Outcomes <small>(Check all that apply)</small></h3>

        <div class="outcomes-wrapper">
            @foreach($outcomes as $outcome)
                <div class="checkbox">
                    <label>
                        @if($create)
                            {!! Form::checkbox('outcomes[]', $outcome->id) !!}
                            {!! $outcome->name !!}
                        @else
                            {!! Form::checkbox('outcomes[]', $outcome->id, in_array($outcome->id, $study->outcomes()->lists('outcome_id')->toArray())) !!}
                            {!! $outcome->name !!}
                        @endif
                    </label>
                </div>
            @endforeach
        </div>

    </div>