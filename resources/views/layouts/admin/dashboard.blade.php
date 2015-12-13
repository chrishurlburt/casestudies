@extends('admin-base')

@section('content')
 <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

            @if($errors->any())
                <ul class="alert alert-danger">
                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach
                </ul>
            @endif

                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                .col-lg-12
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                .col-lg-6
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                .col-lg-6
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-4 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                .col-lg-4
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                .col-lg-4
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                .col-lg-4
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-3 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                .col-lg-3
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                .col-lg-3
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                .col-lg-3
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                .col-lg-3
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-2 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                .col-lg-2
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                .col-lg-2
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                .col-lg-2
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                .col-lg-2
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                .col-lg-2
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                .col-lg-2
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-1 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                .col-lg-1
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                .col-lg-1
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                .col-lg-1
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                .col-lg-1
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                .col-lg-1
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                .col-lg-1
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                .col-lg-1
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                .col-lg-1
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                .col-lg-1
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                .col-lg-1
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                .col-lg-1
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                .col-lg-1
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-8 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                .col-lg-8
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                .col-lg-4
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-3 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                .col-lg-3
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                .col-lg-6
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                .col-lg-3
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->


@stop