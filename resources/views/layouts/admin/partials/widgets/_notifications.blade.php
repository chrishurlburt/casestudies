<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-bell fa-fw"></i> Notifications</h3>
    </div>

    @if($user->notifications->isEmpty())
        <h3>No notifications to show.</h3>
    @else
        <div class="panel-body">

            <div class="list-group">
                @foreach($user->notifications as $notification)
                    <?php
                        // get the study the notification is related to.
                        // get user that owns that study, even if they've been deactivated.
                        // Unfortunately, withTrashed() cannot be chained when querying
                        // the relationship of a relationship.
                        // this is probably not a great way of doing this..
                        $study = $notification->study()->withTrashed()->first();
                        $study_user = $study->user()->first();
                    ?>

                    <a href="{{ route('admin.cases.edit', ['slug' => $study->slug]) }}" class="list-group-item">
                        <p><i class="fa fa-fw fa-calendar"></i> {{ $notification->notification }}</p>
                        <p class="small text-muted"><i class="fa fa-user"></i> {{ $study_user->first_name.' '.$study_user->last_name }} <i class="fa fa-clock-o"></i> {{ date('F d, Y - h:i A', strtotime($notification->created_at)) }}</p>
                    </a>
                @endforeach
            </div>

            <div class="text-right">
                <a href="{{ route('admin.notifications') }}">View All Notifications <i class="fa fa-arrow-circle-right"></i></a>
            </div>

        </div>
    @endif
</div>