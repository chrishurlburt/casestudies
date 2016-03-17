@extends('admin-base')

@section('content')
<main id="edit-course">
    <section id="heading">
        @include('layouts.admin.partials._heading', ['heading' => 'Edit Course'])
        {!! Breadcrumbs::render('edit-course', $course->id) !!}
    </section>

    @include('layouts.admin.partials._errors')

    <section id="edit-course-form" class="card">
        <div class="row">
            {!! Form::model($course, ['method' => 'PUT', 'route' => ['admin.courses.update', $course->id]]) !!}

                <div class="col-lg-8">
                    @include('layouts.admin.partials._courses-form')
                </div>

                <div class="col-lg-4">
                    @include('layouts.admin.partials._cases-form-outcomes', ['create' => false, 'data' => $course])
                </div>

                <div class="card-footer">
                    {!! Form::submit('Update Course', ['class' => 'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}
        </div>
    </section>
</main>

@stop