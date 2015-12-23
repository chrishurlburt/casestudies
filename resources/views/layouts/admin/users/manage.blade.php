@extends('admin-base')

@section('content')

@include('layouts.admin.partials._heading', ['heading' => 'Manage Users'])

{!! Breadcrumbs::render('manage-users') !!}

@include('layouts.admin.partials._success')
@include('layouts.admin.partials._errors')

<table class="table table-hover" data-resource="case study">
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
                <td><a href="{{ route('admin.users.show', ['id' => $user->id]) }}" data-toggle="modal" data-target="#user" class="user">{{ $user->first_name.' '.$user->last_name }}</a></td>
                <td>{{ $user->email }}</td>
                <td>{{ \Sentinel::findById($user->id)->roles()->first()->name }}</td>
                <td><a href="{{ route('admin.users.edit', ['id' => $user->id]) }}">Edit</a> | <a href="{{ route('admin.users.destroy', ['id' => $user->id]) }}" class="delete">Delete</a></td>
            </tr>
        @endforeach
    </tbody>
</table>

@stop