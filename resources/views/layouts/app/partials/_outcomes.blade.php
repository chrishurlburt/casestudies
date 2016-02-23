@foreach($outcomes as $outcome)
    <div class="checkbox">
        <label for="outcomes" class="learning-outcome" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="right" data-content="{{ $outcome->description }}">
            {!! Form::checkbox('outcomes[]', $outcome->id) !!}
            {!! $outcome->name !!}
        </label>
    </div>
@endforeach