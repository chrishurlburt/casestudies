@if($edit)
<h3>Email</h3>
<p>{{ $user->email }}</p>
@endif


<div class="row">
    <div class="form-group col-lg-6">
        <label>First Name</label>
        {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group col-lg-6">
        <label>Last Name</label>
        {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
    </div>
</div>

@if(!$edit)
<div class="row">
    <div class="form-group col-lg-6">
        <label>Email</label>
        {!! Form::email('email', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-lg-6">
        <label>Password</label>
        {!! Form::password('password', ['class' => 'form-control']) !!}
    </div>

    <div class="form-group col-lg-6">
        <label>Confirm Password</label>
        {!! Form::password('password_confirm', ['class' => 'form-control']) !!}
    </div>
</div>
@endif

<div class="row">
    <div class="form-group col-lg-12">
        <label>Select a Role</label><br />
        @foreach($roles as $role)
            @if(isset($user))
            {!! Form::radio('role', $role->id, in_array($role->id, \Sentinel::findById($user->id)->roles()->lists('role_id')->toArray())) !!}
            @else
            {!! Form::radio('role', $role->id) !!}
            @endif
            {!! Form::label('role', $role->name) !!}
        @endforeach
    </div>
</div>

