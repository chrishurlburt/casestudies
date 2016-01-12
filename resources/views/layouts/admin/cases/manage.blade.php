@extends('admin-base')

@section('bodyclass', 'manage_case_studies')

@section('content')

@include('layouts.admin.partials._heading', ['heading' => 'Manage Case Studies'])

{!! Breadcrumbs::render('manage') !!}

@include('layouts.admin.partials._success')
@include('layouts.admin.partials._errors')

<table class="table table-hover" data-resource="case study">
    <thead>
        <tr>
            <th>Title</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>
        @foreach($studies as $study)
            <tr>
                <td><a href="{{ route('admin.cases.show', ['slug' => $study->slug]) }}" data-toggle="modal" data-target="#study" class="case-study">{{ $study->title }}</a></td>
                <td><a href="{{ route('admin.cases.edit', ['slug' => $study->slug]) }}">Edit</a> | <a href="{{ route('admin.cases.destroy', ['slug' => $study->slug]) }}" class="delete">Delete</a></td>
            </tr>
        @endforeach
    </tbody>
</table>

{!! $studies->render() !!}

@include('layouts.admin.partials._study-modal')
@include('layouts.admin.partials._delete-modal')

@stop