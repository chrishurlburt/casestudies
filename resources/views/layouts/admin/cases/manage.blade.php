@extends('admin-base')

@section('bodyclass', 'manage_case_studies')

@section('content')

<main id="manage-cases">
    <section id="heading">
        @include('layouts.admin.partials._heading', ['heading' => 'Manage Case Studies'])
        {!! Breadcrumbs::render('manage') !!}
    </section>

    @include('layouts.admin.partials._success')
    @include('layouts.admin.partials._errors')

    @if($studies->isEmpty())
        <h3>There are no published studies to show.</h3>
    @else
    <section id="published-cases" class="card">
        <div class="card-header">
            <a href="{{ route('admin.cases.create') }}"><button class="btn btn-primary">New Case Study</button></a>
            <a href="{{ route('admin.cases.drafts') }}"><button class="btn btn-secondary">Manage Drafts</button></a>
            <div class="left">
                <span class="checked-count"></span>
                <a href="#" class="trash"><i class="fa fa-trash"></i></a>
            </div>
        </div>
        <table class="table table-hover table-responsive" data-resource="case study">
            <thead>
                <tr>
                    <th></th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Created</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($studies as $study)
                    <tr>
                        <td><input name="studies[]" type="checkbox" value="{{ $study->id }}" class="checkbox-custom" id="c{{ $study->id }}"><label class="checkbox-custom-label" for="c{{ $study->id }}"></label></td>
                        <td><a href="{{ route('admin.cases.show', ['slug' => $study->slug]) }}" data-toggle="modal" data-target="#study" class="case-study">{{ $study->title }}</a></td>
                        <td>{{ $study->user->first_name.' '.$study->user->last_name }}
                        <td>{{ date('F d, Y', strtotime($study->created_at)) }}</td>
                        <td><a href="{{ route('admin.cases.edit', ['slug' => $study->slug]) }}"><i class="fa fa-pencil"></i></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-wrap">
            {!! $studies->render() !!}
        </div>

        {!! Form::open(['method' => 'DELETE', 'id' => 'form-delete']) !!}
        {!! Form::close() !!}

    </section>
    @endif

    @include('layouts.admin.partials._study-modal')
    @include('layouts.admin.partials._delete-modal')
</main>

@stop