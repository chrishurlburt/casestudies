<div class="form-group">
    {!! Form::label('subject_name', 'Subject Name') !!}
    {!! Form::text('subject_name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('course_number', 'Course Number') !!}
    {!! Form::text('course_number', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('course_name', 'Course Name') !!}
    {!! Form::text('course_name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">

    @foreach($outcomes as $outcome)
        {!! Form::label('outcomes', $outcome->name) !!}
        @if(isset($course))
        {!! Form::checkbox('outcomes[]', $outcome->id, in_array($outcome->id, $course->outcomes()->lists('outcome_id')->toArray())) !!}
        @else
        {!! Form::checkbox('outcomes[]', $outcome->id) !!}
        @endif
    @endforeach

</div>