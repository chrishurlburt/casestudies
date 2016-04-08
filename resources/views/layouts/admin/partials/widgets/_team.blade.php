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