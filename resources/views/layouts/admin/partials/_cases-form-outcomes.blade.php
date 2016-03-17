
    <div class="form-group outcomes-list">

        <h3>Learning Outcomes <small>(Check all that apply)</small></h3>

        <div class="outcomes-wrapper">
            @foreach($outcomes as $outcome)
                <div class="checkbox">
                    <label class="learning-outcome" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="left" data-content="{{ $outcome->description }}">
                        @if($create)
                            {!! Form::checkbox('outcomes[]', $outcome->id) !!}
                            {!! $outcome->name !!}
                        @else
                            {!! Form::checkbox('outcomes[]', $outcome->id, in_array($outcome->id, $data->outcomes()->lists('outcome_id')->toArray())) !!}
                            {!! $outcome->name !!}
                        @endif
                    </label>
                </div>
            @endforeach
        </div>

    </div>