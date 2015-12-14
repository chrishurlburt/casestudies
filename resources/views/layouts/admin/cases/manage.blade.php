@extends('admin-base')


@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1>Manage Case Studies</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i> <a href="/admin">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-wrench"></i> Manage Case Studies
            </li>
        </ol>
    </div>
</div>

@include('layouts.admin.partials._success')

<table class="table table-hover">
    <thead>
        <tr>
            <th>Title</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>
        @foreach($studies as $study)
            <tr>
                <td><a href="{{ route('admin.cases.edit', ['slug' => $study->slug]) }}">{{ $study->title }}</a></td>
                <td><a href="#">Edit</a> | <a href="#">Delete</a></td>
            </tr>
        @endforeach
    </tbody>
</table>

@stop