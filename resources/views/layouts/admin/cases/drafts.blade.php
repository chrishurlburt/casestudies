@extends('admin-base')

@section('bodyclass', 'manage_case_studies')

@section('content')
<main id="manage-drafts">
    <section id="heading">
        @include('layouts.admin.partials._heading', ['heading' => 'Manage Drafts'])
        {!! Breadcrumbs::render('drafts') !!}
    </section>

    @include('layouts.admin.partials._success')
    @include('layouts.admin.partials._errors')

<section id="drafted-cases" class="card">
    @if($drafts->isEmpty())
        <h3>There are no drafts to show.</h3>
    @else

    <div class="card-header">
        <a href="{{ route('admin.cases.create') }}"><button class="btn btn-primary">New Case Study</button></a>
        <div class="left">
            <span class="checked-count"></span>
            @include('layouts.admin.partials._card-header-menu', ['menu' => 'drafts'])
        </div>
    </div>
    <table id="studies-table" class="table table-hover table-responsive" data-resource="case study">
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
        @foreach($drafts as $draft)
        <tr>
            <td><input name="studies[]" type="checkbox" value="{{ $draft->id }}" class="checkbox-custom" id="c{{ $draft->id }}"><label class="checkbox-custom-label" for="c{{ $draft->id }}"></label></td>
            <td><a href="{{ route('admin.cases.show', ['slug' => $draft->slug]) }}" data-toggle="modal" data-target="#study" class="case-study">{{ $draft->title }}</a></td>
            <td>{{ $draft->user->first_name.' '.$draft->user->last_name }}
            <td>{{ date('F d, Y', strtotime($draft->created_at)) }}</td>
            <td><a href="{{ route('admin.cases.edit', ['slug' => $draft->slug]) }}"><i class="fa fa-pencil"></i></a></td>
        </tr>
        @endforeach
        </tbody>
    </table>

    {!! Form::open(['method' => 'DELETE', 'id' => 'form-delete']) !!}
    {!! Form::close() !!}
    @endif
</section>

    @include('layouts.admin.partials._study-modal')
    @include('layouts.admin.partials._delete-modal')
</main>
@stop