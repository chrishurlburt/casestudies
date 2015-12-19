@extends('admin-base')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1>Manage Courses</h1>
    </div>
</div>

{!! Breadcrumbs::render('manage-courses') !!}

@include('layouts.admin.partials._success')
@include('layouts.admin.partials._errors')

<table class="table table-hover" data-resource="course">
    <thead>
        <tr>
            <th>Title</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>
        @foreach($courses as $course)
            <tr>
                <td><a href="{{ route('admin.courses.show', ['id' => $course->id]) }}" data-toggle="modal" data-target="#course" class="course">{{ $course->name }}</a></td>
                <td><a href="{{ route('admin.courses.edit', ['id' => $course->id]) }}">Edit</a> | <a href="{{ route('admin.courses.destroy', ['id' => $course->id]) }}" class="delete">Delete</a></td>
            </tr>
        @endforeach
    </tbody>
</table>

@include('layouts.admin.partials._course-modal')
@include('layouts.admin.partials._delete-modal')

@stop