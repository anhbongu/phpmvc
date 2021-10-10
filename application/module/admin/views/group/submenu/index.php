<?php 
    $linkGroup = URL::creatLink('admin', 'group', 'index');
    $linkUser = URL::creatLink('admin', 'user', 'index');

 ?>

<div id="submenu-box">
    <div class="m">
        <ul id="submenu">
            <li><a class="active" href="<?php echo $linkGroup; ?>">Group</a></li>
            <li><a href="<?php echo $linkUser; ?>">User</a></li>
        </ul>
        <div class="clr"></div>
    </div>
</div>