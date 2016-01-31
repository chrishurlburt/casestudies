<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
    <ul class="dropdown-menu message-dropdown">

        @foreach($notifications as $notification)
            <li class="message-preview">
                <a href="{{ route('admin.cases.edit', ['slug' => $notification->study->slug]) }}">
                    <div class="media">
                        <span class="pull-left">
                            <i class="fa fa-pencil-square-o fa-3x"></i>
                        </span>
                        <div class="media-body">
                            <h5 class="media-heading"><strong>{{ $notification->notification }}</strong></h5>
                            <p class="small text-muted"><i class="fa fa-clock-o"></i> {{ date('F d, Y - h:i A', strtotime($notification->created_at)) }}</p>
                            <p class="small text-muted"><i class="fa fa-user"></i> {{ $notification->study->user->withTrashed()->first_name.' '.$notification->study->user->withTrashed()->last_name }}</p>
                            <p>{{ $notification->study->title }}</p>
                        </div>
                    </div>
                </a>
            </li>
        @endforeach

        <li class="message-footer">
            @if(!$notifications->isEmpty())
                <a href="{{ route('admin.notifications') }}">View All Notifications</a>
            @else
                <p>No notifications to show.</p>
            @endif
        </li>

    </ul>
</li>