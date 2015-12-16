@extends('admin-base')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1>Manage Drafts</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i> <a href="/admin">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-wrench"></i> Manage Drafts
            </li>
        </ol>
    </div>
</div>

@include('layouts.admin.partials._success')
@include('layouts.admin.partials._errors')

@if(empty($drafts))
    <h3>There are no drafts to show.</h3>
@else
<table class="table table-hover">
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