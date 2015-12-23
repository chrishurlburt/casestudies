@extends('admin-base')

@section('content')
<main id="cases-form">

    @include('layouts.admin.partials._heading', ['heading' => 'Edit Case Study'])

    <div class="row">
        <div class="col-lg-12">
            {!! Breadcrumbs::render('edit', $study->slug) !!}
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            @include('layouts.admin.partials._errors')
        </div>
    </div>

    <div class="row">
        {!! Form::model($study, ['method' => 'PUT', 'route' => ['admin.cases.update', $study->slug]]) !!}
            <div class="col-lg-8">

                @include('layouts.admin.partials._cases-form')

            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <h3>Custom URL</h3>
                    {!! Form::text('slug', null, ['class' => 'form-control']) !!}
                    {!! Form::hidden('_old_slug', $study->slug)!!}
                </div>

                <div class="form-group">
                    <h3>Keywords <small>(Separate each with a comma)</small></h3>
                    {!! Form::text('keywords', $keywords, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">

                    <h3>Learning Outcomes <small>(Check all that apply)</small></h3>

                    @foreach($outcomes as $outcome)
                    <div class="checkbox">
                        <label>
                            {!! Form::checkbox('outcomes[]', $outcome->id, in_array($outcome->id, $study->outcomes()->lists('outcome_id')->toArray())) !!}
                            {!! $outcome->name !!}
                        </label>
                    </div>
                    @endforeach

                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    @if($study->draft)

                        {!! Form::submit('Update Draft', ['class' => 'btn btn-primary form-control', 'name' => 'update-draft'] ) !!}

                        @if(Sentinel::findById(Auth::user()->id)->hasAccess(['publish']))
                        {!! Form::submit('Publish Draft', ['class' => 'btn btn-primary form-control', 'name' => 'publish-draft'] ) !!}
                        @endif

                    @else
                        @if(Sentinel::findById(Auth::user()->id)->hasAccess(['publish']))
                        {!! Form::submit('Update Case Study', ['class' => 'btn btn-primary form-control', 'name' => 'update']) !!}
                        @endif
                    @endif
                </div>
            </div>

        {!! Form::close() !!}

        @include('layouts.admin.partials._revisions')

        </div>
    </div>
</main>

@stop

