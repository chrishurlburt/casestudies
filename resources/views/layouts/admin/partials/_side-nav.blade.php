<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li>
            <a href="/admin"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>

        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#studies"><i class="fa fa-fw fa-area-chart"></i> Case Studies <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="studies" class="collapse">
                <li>
                    <a href="{{ route('admin.studies') }}">Manage Case Studies</a>
                </li>
                <li>
                    <a href="{{ route('admin.studies.create') }}">New Case Study</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#outcomes"><i class="fa fa-fw fa-cube"></i> Learning Outcomes <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="outcomes" class="collapse">
                <li>
                    <a href="{{ route('admin.outcomes') }}">Manage Outcomes</a>
                </li>
                <li>
                    <a href="{{ route('admin.outcomes.create') }}">New Outcome</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#classes"><i class="fa fa-fw fa-university"></i> Classes <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="classes" class="collapse">
                <li>
                    <a href="{{ route('admin.courses') }}">Manage Classes</a>
                </li>
                <li>
                    <a href="{{ route('admin.courses.create') }}">New Class</a>
                </li>
            </ul>
        </li>

    </ul>
</div>