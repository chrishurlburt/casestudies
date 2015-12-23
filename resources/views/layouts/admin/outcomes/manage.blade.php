@extends('admin-base')

@section('content')

@include('layouts.admin.partials._heading', ['heading' => 'Manage Learning Outcomes'])


{!! Breadcrumbs::render('manage-outcomes') !!}

@include('layouts.admin.partials._success')
@include('layouts.admin.partials._errors')

<table class="table table-hover" data-resource="outcome">
    <thead>
        <tr>
            <th>Title</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>
        @foreach($outcomes as $outcome)
            <tr>
                <td><a href="{{ route('admin.outcomes.show', ['id' => $outcome->id]) }}" data-toggle="modal" data-target="#outcome" class="outcome">{{ $outcome->name }}</a></td>
                <td><a href="{{ route('admin.outcomes.edit', ['id' => $outcome->id]) }}">Edit</a> | <a href="{{ route('admin.outcomes.destroy', ['id' => $outcome->id]) }}" class="delete">Delete</a></td>
            </tr>
        @endforeach
    </tbody>
</table>


@include('layouts.admin.partials._delete-modal')
@include('layouts.admin.partials._outcome-modal')

@stop