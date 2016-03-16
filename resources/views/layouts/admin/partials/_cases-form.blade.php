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