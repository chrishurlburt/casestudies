<div class="scrollable check-group">
    @foreach($outcomes as $outcome)
        <div class="checkbox">
                <label for="outcomes" class="learning-outcome checkbox" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="right" data-content="{{ $outcome->description }}">
                    <input name="outcomes[]" type="checkbox" value="{{ $outcome->id }}" class="checkbox-custom" id="o{{ $outcome->id }}"><label class="checkbox-custom-label" for="o{{ $outcome->id }}"></label>
                    <p class="checkbox-label">{!! $outcome->name !!}</p>
                </label>
            </label>
        </div>
    @endforeach
</div>