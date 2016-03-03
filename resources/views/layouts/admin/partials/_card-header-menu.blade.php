<div class="dropdown card-options">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Options <i class="fa fa-caret-down"></i></a>

    <ul class="dropdown-menu pull-left">
        @if($menu == 'manage' || $menu == 'drafts')
        <li><a href="#" class="trash">Move To Trash</a></li>
        @elseif($menu == 'trash')
        <li><a href="#" class="restore">Move To Drafts</a></li>
        <li><a href="#" class="trash forcedelete">Permanently Delete</a></li>
        @elseif($menu == 'outcomes' || $menu == 'courses')
        <li><a href="#" class="trash">Delete</a></li>
        @elseif($menu == 'users')
        <li><a href="#" class="deactivate trash">Deactivate</a></li>
        @elseif($menu == 'deactivated-users')
        <li><a href="#" class="reactivate restore">Reactivate</a></li>
        @endif
    </ul>
</div>
