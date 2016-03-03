@extends('admin-base')

@section('content')
<main id="create-outcome">
    <section id="heading">
        @include('layouts.admin.partials._heading', ['heading' => 'Add New Learning Outcome'])
        {!! Breadcrumbs::render('create-outcome') !!}
    </section>

    <section id="create-outcome-form" class="card">
        @include('layouts.admin.partials._success')
        @include('layouts.admin.partials._errors')


        {!! Form::open(['route' => 'admin.outcomes.store']) !!}

        @include('layouts.admin.partials._outcomes-form')

        {!! Form::submit('Add Learning Outcome', ['class' => 'btn btn-primary form-control']) !!}

        {!! Form::close() !!}
    </section>
</main>

@stop