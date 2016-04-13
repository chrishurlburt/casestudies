<!-- Navigation -->
<nav id="nav" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
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

       @include('layouts.admin.partials._notifications-nav')


        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ Auth::user()->first_name }} <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('admin.profile') }}">Profile</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{ route('app.landing') }}"><i class="fa fa-fw fa-sign-out" aria-hidden="true"></i> Home</a>
                    </li>
                    <li>
                        <a href="/auth/logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                </ul>
        </li>
    </ul>

    @include('layouts.admin.partials._side-nav')

</nav>