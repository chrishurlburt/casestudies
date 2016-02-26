@extends('admin-base')

@section('bodyclass', 'dashboard')

@section('content')
<main id="dashboard">

 <!-- Page Heading -->
    <div id="heading" class="row">
        <div class="col-lg-12">
            <h2 class="page-title dashboard-heading">Dashboard <small>Welcome back, {{ Auth::user()->first_name.' '.Auth::user()->last_name }}!</small></h2>
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
                @if($user->notifications->isEmpty())
                    <p>No notifications to show.</p>
                @else
                <div class="panel-body">
                    <div class="list-group">
                        @foreach($user->notifications as $notification)
                            <?php
                                // get the study the notification is related to.
                                // get user that owns that study, even if they've been deactivated.
                                // Unfortunately, withTrashed() cannot be chained when querying
                                // the relationship of a relationship.
                                // this is probably not a great way of doing this..
                                $study = $notification->study()->withTrashed()->first();
                                $study_user = $study->user()->first();
                            ?>

                            <a href="{{ route('admin.cases.edit', ['slug' => $study->slug]) }}" class="list-group-item">
                                <p><i class="fa fa-fw fa-calendar"></i> {{ $notification->notification }}</p>
                                <p class="small text-muted"><i class="fa fa-user"></i> {{ $study_user->first_name.' '.$study_user->last_name }} <i class="fa fa-clock-o"></i> {{ date('F d, Y - h:i A', strtotime($notification->created_at)) }}</p>
                            </a>
                        @endforeach
                    </div>

                    <div class="text-right">
                        <a href="{{ route('admin.notifications') }}">View All Notifications <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                @endif
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
                                <td><a href="{{ route('admin.profile.user', ['id' => $member->id]) }}">{{ $member->first_name.' '.$member->last_name }}</a></td>
                                <td>{{ $member->email }}</td>
                            <tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</main>

@stop