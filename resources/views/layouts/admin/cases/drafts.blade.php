@extends('admin-base')

@section('bodyclass', 'manage_case_studies')

@section('content')

@include('layouts.admin.partials._heading', ['heading' => 'Manage Drafts'])

{!! Breadcrumbs::render('drafts') !!}

@include('layouts.admin.partials._success')
@include('layouts.admin.partials._errors')

@if($drafts->isEmpty())
    <h3>There are no drafts to show.</h3>
@else
<table class="table table-hover" data-resource="draft">
    <thead>
        <tr>
            <th>Title</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>

        @foreach($drafts as $draft)
            <tr>
                <td><a href="{{ route('admin.cases.show', ['slug' => $draft->slug]) }}" data-toggle="modal" data-target="#study" class="case-study">{{ $draft->title }}</a></td>
                <td><a href="{{ route('admin.cases.edit', ['slug' => $draft->slug]) }}">Review</a> | <a href="{{ route('admin.cases.destroy', ['slug' => $draft->slug]) }}" class="delete">Delete</a></td>
            </tr>
        @endforeach


    </tbody>
</table>
@endif

@include('layouts.admin.partials._study-modal')
@include('layouts.admin.partials._delete-modal')

@stop