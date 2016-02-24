<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
    <ul class="dropdown-menu message-dropdown">
        @if($user->notifications->isEmpty())
            <p>There are no notifications to show.</p>
        @else
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
                <li class="message-preview">
                    <a href="{{ route('admin.cases.edit', ['slug' => $study->slug]) }}">
                        <div class="media">
                            <span class="pull-left">
                                <i class="fa fa-pencil-square-o fa-3x"></i>
                            </span>
                            <div class="media-body">
                                <h5 class="media-heading"><strong>{{ $notification->notification }}</strong></h5>
                                <p class="small text-muted"><i class="fa fa-clock-o"></i> {{ date('F d, Y - h:i A', strtotime($notification->created_at)) }}</p>
                                <p class="small text-muted"><i class="fa fa-user"></i> {{ $study_user->first_name.' '.$study_user->last_name }}</p>
                                <p>{{ $study->title }}</p>
                            </div>
                        </div>
                    </a>
                </li>
            @endforeach

            <li class="message-footer">
                <a href="{{ route('admin.notifications') }}">View All Notifications</a>
            </li>
        @endif
    </ul>
</li>