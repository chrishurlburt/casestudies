<div class="row">
    <div class="col-lg-12">
        <h3>Filter by Course</h3>
        {!! Form::open(['route' => 'app.results.filter', 'method' => 'PUT']) !!}
        <input name="courses_reset" type="hidden" value="1">

        @foreach($courses as $course)
            <div class="checkbox">
                <label>
                    @if(isset($courses_checked))
                    {!! Form::checkbox('courses[]', $course->id, in_array($course->id, $courses_checked)) !!}
                    @else
                    {!! Form::checkbox('courses[]', $course->id) !!}
                    @endif
                    {!! $course->name !!}
                </label>
            </div>
        @endforeach

        <input class="btn btn-primary form-control" type="submit" value="Filter">
        {!! Form::close() !!}
    </div>
</div>