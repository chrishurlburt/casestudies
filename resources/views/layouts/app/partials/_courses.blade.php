<div class="check-group">
    @foreach($courses as $course)
        <div class="checkbox">
            <label for="courses">
                {!! Form::checkbox('courses[]', $course->id) !!}
                {!! $course->subject_name.' '.$course->course_number !!}
            </label>
        </div>
    @endforeach
</div>