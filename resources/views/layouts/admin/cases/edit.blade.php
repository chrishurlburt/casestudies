@extends('admin-base')

@section('bodyclass', 'edit_case_study case_study_editor')


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
                    {!! Form::text('slug', null, ['class' => 'form-control custom-url']) !!}
                    {!! Form::hidden('_old_slug', $study->slug)!!}
                    <div class="custom-url-warning alert alert-warning alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        Changing a custom URL will break all links to the case study at it's old URL.
                    </div>
                </div>

                <div class="form-group">
                    <h3>Keywords <small>(Separate each with a comma)</small></h3>
                    {!! Form::text('keywords', $keywords, ['class' => 'form-control']) !!}
                </div>

                @include('layouts.admin.partials._cases-form-outcomes', ['create' => false])

            </div>

            <div class="col-lg-offset-8 col-lg-4">
                <div class="form-group">
                    @if($study->draft)

                        {!! Form::submit('Update Draft', ['class' => 'btn btn-primary form-control', 'name' => 'update-draft'] ) !!}

                        @if(Sentinel::findById(Auth::user()->id)->hasAccess(['publish']))
                        {!! Form::submit('Publish Draft', ['class' => 'btn btn-primary form-control', 'name' => 'publish-draft'] ) !!}
                        @endif

                    @else
                        @if(Sentinel::findById(Auth::user()->id)->hasAccess(['publish']))
                        {!! Form::submit('Update Case Study', ['class' => 'btn btn-primary form-control', 'name' => 'update']) !!}
                        {!! Form::submit('Revert To Draft', ['class' => 'btn btn-primary form-control', 'name' => 'redraft']) !!}
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

