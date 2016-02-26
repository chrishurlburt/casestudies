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
        </div>
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
        <div class="pagination-wrap">
            {!! $studies->render() !!}
        </div>
    </section>
    @endif

    @include('layouts.admin.partials._study-modal')
    @include('layouts.admin.partials._delete-modal')
</main>

@stop