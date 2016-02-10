<div class="form-group">
    <h3>Title</h3>
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#problem" aria-controls="home" role="tab" data-toggle="tab">Problem</a></li>
    <li role="presentation"><a href="#solution" aria-controls="solution" role="tab" data-toggle="tab">Solution</a></li>
    <li role="presentation"><a href="#analysis" aria-controls="analysis" role="tab" data-toggle="tab">Analysis</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="problem">
        <div class="form-group">
            <h3>Problem</h3>
            {!! Form::textarea('problem', null, ['class' => 'form-control editor']) !!}
        </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="solution">
        <div class="form-group">
            <h3>Solution</h3>
            {!! Form::textarea('solution', null, ['class' => 'form-control editor']) !!}
        </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="analysis">
        <div class="form-group">
            <h3>Analysis</h3>
            {!! Form::textarea('analysis', null, ['class' => 'form-control editor']) !!}
        </div>
    </div>
</div>

