<div class="form-group">
    {!! Form::label('name', 'Course Name') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Description') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
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