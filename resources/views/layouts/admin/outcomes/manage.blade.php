@extends('admin-base')
@section('bodyclass', 'manage_outcomes')

@section('content')

<section id="heading">
    @include('layouts.admin.partials._heading', ['heading' => 'Manage Learning Outcomes'])
    {!! Breadcrumbs::render('manage-outcomes') !!}
</section>

@include('layouts.admin.partials._success')
@include('layouts.admin.partials._errors')

<section id="outcomes" class="card">
    @if($outcomes->isEmpty())
        <h3>There are no outcomes to show.</h3>
    @else

    <div class="card-header">
        <a href="{{ route('admin.outcomes.create') }}"><button class="btn btn-primary">New Outcome</button></a>
        <div class="left">
            <span class="checked-count"></span>
            @include('layouts.admin.partials._card-header-menu', ['menu' => 'outcomes'])
        </div>
    </div>

    <table id="outcomes-table" class="table table-hover table-responsive" data-resource="outcome">
        <thead>
            <tr>
                <th></th>
                <th>Title</th>
                <th>Description</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($outcomes as $outcome)
                <tr>
                    <td><input name="outcomes[]" type="checkbox" value="{{ $outcome->id }}" class="checkbox-custom" id="c{{ $outcome->id }}"><label class="checkbox-custom-label" for="c{{ $outcome->id }}"></label></td>
                    <td><a href="{{ route('admin.outcomes.show', ['id' => $outcome->id]) }}" data-toggle="modal" data-target="#outcome" class="outcome">{{ $outcome->name }}</a></td>
                    <td><p>{{ $outcome->description }}</p></td>
                    <td><a href="{{ route('admin.outcomes.edit', ['id' => $outcome->id]) }}"><i class="fa fa-pencil"></i></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {!! Form::open(['method' => 'DELETE', 'id' => 'form-delete']) !!}
    {!! Form::close() !!}

    @include('layouts.admin.partials._delete-modal')
    @include('layouts.admin.partials._outcome-modal')

    @endif
</section>



@stop