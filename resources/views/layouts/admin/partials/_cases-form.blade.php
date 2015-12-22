<div class="form-group">
    <h3>Title</h3>
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <h3>Problem</h3>
    {!! Form::textarea('problem', null, ['class' => 'form-control editor']) !!}
</div>

<div class="form-group">
    <h3>Solution</h3>
    {!! Form::textarea('solution', null, ['class' => 'form-control editor']) !!}
</div>

<div class="form-group">
    <h3>Analysis</h3>
    {!! Form::textarea('analysis', null, ['class' => 'form-control editor']) !!}
</div>