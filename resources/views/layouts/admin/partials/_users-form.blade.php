@if($edit)
<h3>Email</h3>
<p>{{ $user->email }}</p>
@endif

<div class="form-group">
    <h3>First Name</h3>
    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <h3>Last Name</h3>
    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
</div>

@if(!$edit)
    <div class="form-group">
        <h3>Email</h3>
        {!! Form::email('email', null, ['class' => 'form-control']) !!}
    </div>


    <div class="form-group">
        <h3>Password</h3>
        {!! Form::password('password', ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <h3>Confirm Password</h3>
        {!! Form::password('password_confirm', ['class' => 'form-control']) !!}
    </div>
@endif

<div class="form-group">
    <h3>Select a Role</h3>
    @foreach($roles as $role)
        {!! Form::label('role', $role->name) !!}
        @if(isset($user))
        {!! Form::radio('role', $role->id, in_array($role->id, \Sentinel::findById($user->id)->roles()->lists('role_id')->toArray())) !!}
        @else
        {!! Form::radio('role', $role->id) !!}
        @endif
    @endforeach
</div>

