@extends('admin-base')
@section('bodyclass', 'notifications')
@section('sectionid', 'manage-notifications')

@section('content')
<section id="heading">
    <h3 class="page-title">Notifications</h3>
    {!! Breadcrumbs::render('notifications') !!}
</section>

@include('layouts.admin.partials._success')
@include('layouts.admin.partials._errors')

<section id="notifications" class="card">
    @if($notifications->isEmpty())
        <h3>No notifications to show.</h3>
    @else
    <div class="card-header">
        <a href="#"><button type="button" class="btn btn-danger delete">Delete</button></a>
        <span class="checked-count"></span>
    </div>

    <table class="table table-hover table-responsive" id="notifications-table">
        <thead>
            <tr>
                <th><input name="master-check" type="checkbox" value="" class="checkbox-custom master-check" id="master-check" data-name="notifications[]"><label class="checkbox-custom-label" for="master-check"></label></th>
                <th>Notification</th>
                <th>Case Study</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notifications as $notification)
                <tr>
                    <td><input name="notifications[]" type="checkbox" value="{{ $notification->id }}" class="checkbox-custom" id="c{{ $notification->id }}"><label class="checkbox-custom-label" for="c{{ $notification->id }}"></label></td>
                    <td>{{ $notification->notification }}</td>
                    <td><a href="{{ route('admin.cases.show', ['slug' => $notification->study->slug]) }}" data-toggle="modal" data-target="#study" class="case-study"> {{ $notification->study->title }} </a></td>
                    <td>{{ date('F d, Y - h:i A', strtotime($notification->created_at)) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {!! Form::open(['method' => 'DELETE', 'id' => 'form-delete']) !!}
    {!! Form::close() !!}
    @endif

    @include('layouts.admin.partials._study-modal')

</section>

@stop