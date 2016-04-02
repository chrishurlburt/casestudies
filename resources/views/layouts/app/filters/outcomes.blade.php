<div class="row">
    <div class="col-lg-12">
        <h3>Filter by Outcome</h3>
        {!! Form::open(['route' => 'app.results.filter', 'method' => 'PUT']) !!}
        <div class="scrollable check-group">
            @foreach($outcomes as $outcome)
                <div class="checkbox">
                    <label for="outcomes" class="learning-outcome" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="left" data-content="{{ $outcome->description }}">
                        @if(isset($outcomes_checked))
                            <input name="outcomes[]" type="checkbox" <?php if(in_array($outcome->id, $outcomes_checked)){ echo "checked='checked'";} ?> value="{{ $outcome->id }}" class="checkbox-custom" id="fo{{ $outcome->id }}"><label class="checkbox-custom-label" for="fo{{ $outcome->id }}"></label>
                        @else
                            <input name="outcomes[]" type="checkbox" value="{{ $outcome->id }}" class="checkbox-custom" id="fo{{ $outcome->id }}"><label class="checkbox-custom-label" for="fo{{ $outcome->id }}"></label>
                        @endif
                        <p class="checkbox-label">{!! $outcome->name !!}</p>
                    </label>
                </div>
            @endforeach
        </div>
        {!! Form::submit('Filter', ['class' => 'btn btn-primary', 'name' => 'outcomes_reset']) !!}
        {!! Form::close() !!}
    </div>
</div>
