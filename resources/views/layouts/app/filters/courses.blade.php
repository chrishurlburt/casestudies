<div class="row">
    <div class="col-lg-12">
        <h3>Filter by Course</h3>
        {!! Form::open(['route' => 'app.results.filter', 'method' => 'PUT']) !!}
        @foreach($courses as $course)
            <div class="checkbox">
                <label>
                    @if(isset($courses_checked))
                    {!! Form::checkbox('courses[]', $course->id, in_array($course->id, $courses_checked)) !!}
                    @else
                    {!! Form::checkbox('courses[]', $course->id) !!}
                    @endif
                    {!! $course->subject_name.' '.$course->course_number !!}
                </label>
            </div>
        @endforeach
        {!! Form::submit('Filter', ['class' => 'btn btn-primary form-control', 'name' => 'courses_reset']) !!}
        {!! Form::close() !!}
    </div>
</div>