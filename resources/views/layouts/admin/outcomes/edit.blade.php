@extends('admin-base')

@section('content')
<main id="edit-outcome">
    <section id="heading">
        @include('layouts.admin.partials._heading', ['heading' => 'Edit Learning Outcome'])
        {!! Breadcrumbs::render('edit-outcome', $outcome->id) !!}
    </section>

    @include('layouts.admin.partials._errors')
    <section id="edit-outcome-form" class="card">
        {!! Form::model($outcome, ['method' => 'PUT', 'route' => ['admin.outcomes.update', $outcome->id]]) !!}

        @include('layouts.admin.partials._outcomes-form')

        <div class="card-footer">
            {!! Form::submit('Update Learning Outcome', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </section>
</main>

@stop