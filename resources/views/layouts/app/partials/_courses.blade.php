<div class="scrollable check-group">
    @foreach($courses as $course)
        <div class="checkbox">
                <input name="courses[]" type="checkbox" value="{{ $course->id }}" class="checkbox-custom" id="c{{ $course->id }}"><label class="checkbox-custom-label" for="c{{ $course->id }}"></label>
                <p class="checkbox-label">{!! $course->subject_name.' '.$course->course_number !!}</p>
            </label>
        </div>
    @endforeach
</div>