<table class="table table-hover" data-resource="user">
    <thead>
        <tr>
            <th>User</th>
            <th>Email</th>
            <th>Role</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                @if($deactivated)
                    <td>{{ $user->first_name.' '.$user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ \Sentinel::findById($user->id)->roles()->first()->name }}</td>
                    <td><a href="{{ route('admin.users.activate', ['id' => $user->id]) }}">Reactivate</a></td>
                @else
                    <td><a href="{{ route('admin.users.edit', ['id' => $user->id]) }}" class="user">{{ $user->first_name.' '.$user->last_name }}</a></td>
                    <td>{{ $user->email }}</td>
                    <td>{{ \Sentinel::findById($user->id)->roles()->first()->name }}</td>
                    <td><a href="{{ route('admin.users.edit', ['id' => $user->id]) }}">Edit</a> | <a href="{{ route('admin.users.destroy', ['id' => $user->id]) }}" class="deactivate">Deactivate</a></td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>