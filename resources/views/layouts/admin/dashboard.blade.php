@extends('admin-base')

@section('content')
 <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Dashboard <small>Welcome back, {{ Auth::user()->first_name.' '.Auth::user()->last_name }}!</small></h1>
                    </div>
                </div>
                <!-- /.row -->

@include('layouts.admin.partials._success')
@include('layouts.admin.partials._errors')

<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bell fa-fw"></i> Notifications</h3>
            </div>

            <div class="panel-body">
                <div class="list-group">
                    @foreach($notifications as $notification)
                    <a href="{{ route('admin.cases.edit', ['slug' => $notification->study->slug]) }}" class="list-group-item">
                        <span class="badge">{{ date('F d, Y - h:i A', strtotime($notification->created_at)) }}</span>
                            <i class="fa fa-fw fa-calendar"></i> {{ $notification->notification }}
                    </a>
                    @endforeach
                </div>

                <div class="text-right">
                    <a href="{{ route('admin.notifications') }}">View All Notifications <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

    </div>

    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-users fa-fw"></i> Our Team</h3>
            </div>

            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($team as $member)
                        <tr>
                            <td>{{ $member->first_name.' '.$member->last_name }}</td>
                            <td>{{ $member->email }}</td>
                        <tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


@stop