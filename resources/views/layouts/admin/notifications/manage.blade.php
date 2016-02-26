@extends('admin-base')

@section('content')

<section id="heading">
    @include('layouts.admin.partials._heading', ['heading' => 'Notifications'])
    {!! Breadcrumbs::render('notifications') !!}
</section>

@include('layouts.admin.partials._success')
@include('layouts.admin.partials._errors')

{!! Form::open(['method' => 'DELETE', 'route' => 'admin.notifications.destroy']) !!}

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Notification</th>
                <th>Case Study</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @forelse($notifications as $notification)
                <tr>
                    <td><a href="#">{{ $notification->notification }}</a></td>
                    <td><a href="{{ route('admin.cases.show', ['slug' => $notification->study->slug]) }}" data-toggle="modal" data-target="#study" class="case-study"> {{ $notification->study->title }} </a></td>
                    <td>{!! Form::checkbox('notifications[]', $notification->id) !!}</td>
                </tr>
            @empty
            <p>No notifcations to show.</p>
            @endforelse
        </tbody>
    </table>

<button type="submit" class="btn btn-danger">Delete</button></a>
{!! Form::close() !!}

@include('layouts.admin.partials._study-modal')

@stop