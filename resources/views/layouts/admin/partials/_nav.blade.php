<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ route('admin') }}">{{ $role->name }}</a>
    </div>

    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
            <ul class="dropdown-menu message-dropdown">

                @foreach($notifications as $notification)
                <li class="message-preview">
                    <a href="{{ route('admin.cases.edit', ['slug' => $notification->study->slug]) }}">
                        <div class="media">
                            <span class="pull-left">
                                <i class="fa fa-pencil-square-o fa-3x"></i>
                            </span>
                            <div class="media-body">
                                <h5 class="media-heading"><strong>{{ $notification->notification }}</strong></h5>
                                <p class="small text-muted"><i class="fa fa-clock-o"></i> {{ date('F d, Y - h:i A', strtotime($notification->created_at)) }}</p>
                                <p class="small text-muted"><i class="fa fa-user"></i> {{ $notification->study->user->first_name.' '.$notification->study->user->last_name }}</p>
                                <p>{{ $notification->study->title }}</p>
                            </div>
                        </div>
                    </a>
                </li>
                @endforeach

                <li class="message-footer">
                    <a href="{{ route('admin.notifications') }}">View All Notifications</a>
                </li>
            </ul>
        </li>

        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ Auth::user()->first_name }} <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="/auth/logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                </ul>
        </li>
    </ul>

    @include('layouts.admin.partials._side-nav')

</nav>