@extends('admin-base')
@section('bodyclass', 'manage_courses')

@section('content')
<main id="manage-courses">
    <section id="heading">
        @include('layouts.admin.partials._heading', ['heading' => 'Manage Courses'])
        {!! Breadcrumbs::render('manage-courses') !!}
    </section>

    @include('layouts.admin.partials._success')
    @include('layouts.admin.partials._errors')

    <section id="courses" class="card">
        @if($courses->isEmpty())
            <h3>There are no courses to show.</h3>
        @else

        <div class="card-header">
            <a href="{{ route('admin.courses.create') }}"><button type="button" class="btn btn-primary">New Course</button></a>
            <div class="right">
                <span class="checked-count"></span>
                @include('layouts.admin.partials._card-header-menu', ['menu' => 'courses'])
            </div>
        </div>

        <table id="courses-table" class="table table-hover table-responsive" data-resource="course">
            <thead>
                <tr>
                    <th><input name="master-check" type="checkbox" value="" class="checkbox-custom master-check" id="master-check" data-name="courses[]"><label class="checkbox-custom-label" for="master-check"></label></th>
                    <th>Name</th>
                    <th>Description</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                    <tr>
                        <td><input name="courses[]" type="checkbox" value="{{ $course->id }}" class="checkbox-custom" id="c{{ $course->id }}"><label class="checkbox-custom-label" for="c{{ $course->id }}"></label></td>
                        <td><a href="{{ route('admin.courses.show', ['id' => $course->id]) }}" data-toggle="modal" data-target="#course" class="course">{{ $course->subject_name.' '.$course->course_number }}</a></td>
                        <td><p>{{ $course->course_name }}</p></td>
                        <td><a href="{{ route('admin.courses.edit', ['id' => $course->id]) }}"><i class="fa fa-pencil"></i></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {!! Form::open(['method' => 'DELETE', 'id' => 'form-delete']) !!}
        {!! Form::close() !!}

        @include('layouts.admin.partials._course-modal')
        @include('layouts.admin.partials._delete-modal')

        @endif
    </section>
</main>
@stop