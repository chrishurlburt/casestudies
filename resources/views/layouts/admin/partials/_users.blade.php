
@if($deactivated)
<table id="users-table-deactivated" class="table table-hover" data-resource="user">
@else
<table id="users-table" class="table table-hover" data-resource="user">
@endif
    <thead>
        <tr>
            @if($deactivated)
            <th><input name="master-check" type="checkbox" value="" class="checkbox-custom master-check" id="master-check-users-deactivated" data-name="deactivated_users[]"><label class="checkbox-custom-label" for="master-check-users-deactivated"></label></th>
            @else
            <th><input name="master-check" type="checkbox" value="" class="checkbox-custom master-check" id="master-check-users" data-name="users[]"><label class="checkbox-custom-label" for="master-check-users"></label></th>
            @endif
            <th>User</th>
            <th>Email</th>
            <th>Role</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                @if($deactivated)
                    <td><input name="deactivated_users[]" type="checkbox" value="{{ $user->id }}" class="checkbox-custom" id="c{{ $user->id }}"><label class="checkbox-custom-label" for="c{{ $user->id }}"></label></td>
                    <td>{{ $user->first_name.' '.$user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ \Sentinel::findById($user->id)->roles()->first()->name }}</td>
                    <td></td>
                @else
                    <td><input name="users[]" type="checkbox" value="{{ $user->id }}" class="checkbox-custom" id="d{{ $user->id }}"><label class="checkbox-custom-label" for="d{{ $user->id }}"></label></td>
                    <td><a href="{{ route('admin.users.edit', ['id' => $user->id]) }}" class="user">{{ $user->first_name.' '.$user->last_name }}</a></td>
                    <td>{{ $user->email }}</td>
                    <td>{{ \Sentinel::findById($user->id)->roles()->first()->name }}</td>
                    <td><a href="{{ route('admin.users.edit', ['id' => $user->id]) }}"><i class="fa fa-pencil"></i></a></td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>