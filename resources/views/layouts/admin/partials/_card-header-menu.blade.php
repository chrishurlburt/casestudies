<div class="dropdown card-options">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Options <i class="fa fa-caret-down"></i></a>

    <ul class="dropdown-menu pull-left">
        @if($menu == 'manage' || $menu == 'drafts')
        <li><a href="#" class="trash">Move To Trash</a></li>
        @elseif($menu == 'trash')
        <li><a href="#" class="restore">Move To Drafts</a></li>
        <li><a href="#" class="trash forcedelete">Permanently Delete</a></li>
        @elseif($menu == 'outcomes')
        <li><a href="#" class="trash">Delete</a></li>
        @endif
    </ul>
</div>
