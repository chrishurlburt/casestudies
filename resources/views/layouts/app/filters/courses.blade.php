<div class="row">
    <div class="col-lg-12">
        <h3>Filter by Course</h3>
        {!! Form::open(['route' => 'app.results.filter', 'method' => 'PUT']) !!}
        <div class="scrollable check-group">
            @foreach($courses as $course)
                <div class="checkbox">
                    @if(isset($courses_checked))
                        <input name="courses[]" type="checkbox" <?php if(in_array($course->id, $courses_checked)){ echo "checked='checked'";} ?> value="{{ $course->id }}" class="checkbox-custom" id="fc{{ $course->id }}"><label class="checkbox-custom-label" for="fc{{ $course->id }}"></label>
                    @else
                        <input name="courses[]" type="checkbox" value="{{ $course->id }}" class="checkbox-custom" id="fc{{ $course->id }}"><label class="checkbox-custom-label" for="fc{{ $course->id }}"></label>
                    @endif

                    <p class="checkbox-label">{!! $course->subject_name.' '.$course->course_number !!}</p>
                </div>
            @endforeach
        </div>
        {!! Form::submit('Filter', ['class' => 'btn btn-primary', 'name' => 'courses_reset']) !!}
        {!! Form::close() !!}
    </div>
</div>