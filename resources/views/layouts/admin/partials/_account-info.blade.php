<section id="account-info" class="card">
    <div class="card-header">
        <h3>Profile Info</h3>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <h3>Email</h3>
            <p>{{ $user->email }}</p>
        </div>
        <div class="col-lg-4">
            <h3>Role</h3>
            <p>{{ \Sentinel::findById($user->id)->roles()->first()->name }}</p>
        </div>
        <div class="col-lg-4">
            <h3>Published Studies</h3>
            <p>{{ count($studies) }}</p>
        </div>
    </div>

    @if($auth_user)
        <div class="card-footer">
            <a href="{{ route('admin.profile.password') }}"><button type="button" class="btn btn-primary">Change Password</button></a>
        </div>
    @endif

</section>