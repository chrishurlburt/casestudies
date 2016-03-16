@extends('admin-base')

@section('bodyclass', 'edit_case_study case_study_editor')


@section('content')
<main id="cases-form">

    <section id="heading">
        @include('layouts.admin.partials._heading', ['heading' => 'Edit Case Study'])
        {!! Breadcrumbs::render('edit', $study->slug) !!}
    </section>

    @include('layouts.admin.partials._errors')

    <section id="edit-case">
            {!! Form::model($study, ['method' => 'PUT', 'route' => ['admin.cases.update', $study->slug]]) !!}

                @include('layouts.admin.partials._cases-form', ['create' => false])

                <div class="card">
                    <div class="form-group">
                        @if($study->draft)
                            @if(Sentinel::findById(Auth::user()->id)->hasAccess(['publish']))
                                {!! Form::submit('Publish Draft', ['class' => 'btn btn-primary', 'name' => 'publish-draft'] ) !!}
                            @endif
                                {!! Form::submit('Update Draft', ['class' => 'btn btn-secondary', 'name' => 'update-draft'] ) !!}
                            @else
                                @if(Sentinel::findById(Auth::user()->id)->hasAccess(['publish']))
                                    {!! Form::submit('Update Case Study', ['class' => 'btn btn-primary', 'name' => 'update']) !!}
                                    {!! Form::submit('Revert To Draft', ['class' => 'btn btn-secondary', 'name' => 'redraft']) !!}
                                @endif
                            @endif

                            <a href="#revisions" data-toggle="collapse" aria-expanded="false" aria-controls="revisions">Show Revision History</a>

                        </div>

                        <div class="collapse" id="revisions">
                            @include('layouts.admin.partials._revisions')
                        </div>
                </div>


            {!! Form::close() !!}


    </section>
</main>

@stop

