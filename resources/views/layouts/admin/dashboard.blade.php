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
                    <a href="#" class="list-group-item">
                        <span class="badge">just now</span>
                            <i class="fa fa-fw fa-calendar"></i> Calendar updated
                    </a>
                    <a href="#" class="list-group-item">
                        <span class="badge">4 minutes ago</span>
                            <i class="fa fa-fw fa-comment"></i> Commented on a post
                    </a>
                    <a href="#" class="list-group-item">
                        <span class="badge">23 minutes ago</span>
                            <i class="fa fa-fw fa-truck"></i> Order 392 shipped
                    </a>
                    <a href="#" class="list-group-item">
                        <span class="badge">46 minutes ago</span>
                            <i class="fa fa-fw fa-money"></i> Invoice 653 has been paid
                    </a>
                    <a href="#" class="list-group-item">
                        <span class="badge">1 hour ago</span>
                            <i class="fa fa-fw fa-user"></i> A new user has been added
                    </a>
                    <a href="#" class="list-group-item">
                        <span class="badge">2 hours ago</span>
                            <i class="fa fa-fw fa-check"></i> Completed task: "pick up dry cleaning"
                    </a>
                    <a href="#" class="list-group-item">
                        <span class="badge">yesterday</span>
                            <i class="fa fa-fw fa-globe"></i> Saved the world
                    </a>
                    <a href="#" class="list-group-item">
                        <span class="badge">two days ago</span>
                            <i class="fa fa-fw fa-check"></i> Completed task: "fix error on sales page"
                    </a>
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
                <h3 class="panel-title"><i class="fa fa-bullhorn fa-fw"></i> Message</h3>
            </div>

            <div class="panel-body">
                <h4>New drafts need to be revised by the end of the month!</h4>
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
                        <tr>
                            <td>Chris Hurlburt</td>
                            <td>churlburt132@g.rwu.edu</td>
                        <tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


@stop