<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li>
            <a href="{{ route('admin') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>

        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#studies"><i class="fa fa-fw fa-area-chart"></i> Case Studies <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="studies" class="collapse in">
                @if(Sentinel::findById(Auth::user()->id)->hasAccess(['publish']))
                <li>
                    <a href="{{ route('admin.cases.index') }}">Manage Case Studies</a>
                </li>
                @endif
                <li>
                    <a href="{{ route('admin.cases.create') }}">New Case Study</a>
                </li>
                <li>
                    <a href="{{ route('admin.cases.drafts') }}">Manage Drafts</a>
                </li>
                <li>
                    <a href="{{ route('admin.cases.trash') }}">Trashed Studies</a>
                </li>
            </ul>
        </li>

        @if(Sentinel::findById(Auth::user()->id)->hasAccess(['admin.outcomes.index']))
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#outcomes"><i class="fa fa-fw fa-cube"></i> Learning Outcomes <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="outcomes" class="collapse in">
                <li>
                    <a href="{{ route('admin.outcomes.index') }}">Manage Outcomes</a>
                </li>
                <li>
                    <a href="{{ route('admin.outcomes.create') }}">New Outcome</a>
                </li>
            </ul>
        </li>
        @endif

        @if(Sentinel::findById(Auth::user()->id)->hasAccess(['admin.courses.index']))
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#classes"><i class="fa fa-fw fa-university"></i> Courses <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="classes" class="collapse in">
                <li>
                    <a href="{{ route('admin.courses.index') }}">Manage Courses</a>
                </li>
                <li>
                    <a href="{{ route('admin.courses.create') }}">New Course</a>
                </li>
            </ul>
        </li>
        @endif

        @if(Sentinel::findById(Auth::user()->id)->hasAccess(['admin.users.index']))
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#users"><i class="fa fa-fw fa-users"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="users" class="collapse in">
                <li>
                    <a href="{{ route('admin.users.index') }}">Manage Users</a>
                </li>
                <li>
                    <a href="{{ route('admin.users.create') }}">New User</a>
                </li>
            </ul>
        </li>
        @endif

        @if(Sentinel::findById(Auth::user()->id)->hasAccess(['admin.users.index']))
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#settings"><i class="fa fa-cog"></i> Settings <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="settings" class="collapse in">
                <li>
                    <a href="{{ route('admin.settings.studies') }}">Case Studies</a>
                </li>
            </ul>
        </li>
        @endif

    </ul>
</div>