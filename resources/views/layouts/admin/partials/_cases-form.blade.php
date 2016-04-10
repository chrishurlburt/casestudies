<div class="row card">

    <div class="col-lg-8">
        <div class="form-group">
            <h3>Title</h3>
                {!! Form::text('title', null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group">
            <h3>Custom URL</h3>
            @if($create)
                {!! Form::text('slug', null, ['class' => 'form-control']) !!}
            @else
                {!! Form::text('slug', null, ['class' => 'form-control custom-url']) !!}
                {!! Form::hidden('_old_slug', $study->slug)!!}
                <div class="custom-url-warning alert alert-warning alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    Changing a custom URL will break all links to the case study at it's old URL.
                </div>
            @endif
        </div>
    </div>

</div>

<div class="row card">

    <div class="col-lg-12">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs card-header" role="tablist">
            <li role="presentation" class="active"><a href="#problem" aria-controls="home" role="tab" data-toggle="tab">Problem</a></li>
            <li role="presentation"><a href="#solution" aria-controls="solution" role="tab" data-toggle="tab">Solution</a></li>
            <li role="presentation"><a href="#analysis" aria-controls="analysis" role="tab" data-toggle="tab">Analysis</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="problem">
                <h3>Problem</h3>
                <div class="form-group">
                    {!! Form::textarea('problem', null, ['class' => 'form-control editor']) !!}
                </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="solution">
                <h3>Solution</h3>
                <div class="form-group">
                    {!! Form::textarea('solution', null, ['class' => 'form-control editor']) !!}
                </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="analysis">
                <h3>Analysis</h3>
                <div class="form-group">
                    {!! Form::textarea('analysis', null, ['class' => 'form-control editor']) !!}
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row card">

    <div class="col-lg-6">
        <div class="form-group">
            <h3>Keywords <small>(Separate each with a comma)</small></h3>
                @if($create)
                    {!! Form::text('keywords', null, ['class' => 'form-control']) !!}
                @else
                    {!! Form::text('keywords', $keywords, ['class' => 'form-control']) !!}
                @endif
        </div>
    </div>

    <div class="col-lg-6">
        @include('layouts.admin.partials._cases-form-outcomes', ['create' => $create])
    </div>

</div>

<div class="row card">
    <div class="card-header">
        <h3>Background Information</h3>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>Topic</label>
                {!! Form::text('topic', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="col-lg-4">
            <div class="form-group">
                <label>Project Location</label><br />
                @include('layouts.admin.partials._locations')
            </div>
        </div>

        <div class="col-lg-4">
            <div class="form-group">
                <label>Estimated Schedule In Months</label>
                <input type="number" name="estimated_schedule" min="1">
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-lg-4">
            <div class="form-group">
                <label>Contract Value ($)</label>
                {!! Form::text('contract_value', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Project Schedule Impacted</label><br />

                <input name="schedule_impact" type="radio" value="yes" @if(!$create && $study->schedule_impact == "Yes")checked="checked"@endif>
                {!! Form::label('schedule_impact', 'Yes') !!}
                <input name="schedule_impact" type="radio" value="no" @if(!$create && $study->schedule_impact == "No" || $create)checked="checked"@endif>
                {!! Form::label('schedule_impact', 'No') !!}
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Project Budget Impacted</label><br />

                <input name="budget_impact" type="radio" value="yes" @if(!$create && $study->budget_impact == "Yes")checked="checked"@endif>
                {!! Form::label('budget_impact', 'Yes') !!}
                <input name="budget_impact" type="radio" value="no" @if(!$create && $study->budget_impact == "No" || $create) checked="checked" @endif>
                {!! Form::label('budget_impact', 'No') !!}
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Market Sector</label>
                {!! Form::text('market_sector', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label>Delivery Method</label>
                {!! Form::text('delivery_method', null, ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>


</div>