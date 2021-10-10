<?php 
    $linkControlPanel   = URL::creatLink('admin', 'index', 'index');
    $linkMyProfile      = URL::creatLink('admin', 'index', 'profile');
    $linkUser           = URL::creatLink('admin', 'user', 'index');
    $linkUserManager    = URL::creatLink('admin', 'user', 'index');
    $linkAddUser        = URL::creatLink('admin', 'user', 'add');
    $linkGroup          = URL::creatLink('admin', 'group', 'index');
    $linkAddGroup       = URL::creatLink('admin', 'group', 'add');

    $linkCategory       = URL::creatLink('admin', 'category','index');
    $linkBook           = URL::creatLink('admin', 'book','index');

    $linkLogOut         = URL::creatLink('admin', 'index', 'logout');

    $linkViewSite        = URL::creatLink('default', 'index', 'index');
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

	<?php echo $this->_title; ?>
	<?php echo $this->_metaHTTP; ?>
	<?php echo $this->_metaName; ?>
	<?php echo $this->_js; ?>
	<?php echo $this->_css; ?>
</head>
<body>
	<div id="border-top" class="h_blue">
		<span class="title"><a href="#">Administration</a></span>
	</div>
	
    <!-- HEADER -->
	<div id="header-box">
		<div id="module-status"> 
            <span class="viewsite"><a href="<?php echo $linkViewSite; ?>" target="_blank">ViewSite</a></span> 
            <span class="no-unread-messages"><a href="<?php echo $linkLogOut; ?>">Log out</a></span> 
		</div>
        <div id="module-menu">
        	<!-- MENU -->
            <ul id="menu" >
                <li class="node"><a href="#">Site</a>
                    <ul>
                        <li><a class="icon-16-cpanel" href="<?php echo $linkControlPanel; ?>">Control Panel</a></li>
                        <li class="separator"><span></span></li>
                        <li><a class="icon-16-profile" href="<?php echo $linkMyProfile; ?>">My Profile</a></li>

                    </ul>
                </li>
                <li class="separator"><span></span></li>

                <li class="node"><a href="<?php echo $linkUser; ?>">Users</a>
                    <ul>
                        <li class="node">
                            <a class="icon-16-user" href="<?php echo $linkUserManager; ?>">User Manager</a>
                            <ul id="menu-com-users-users" class="menu-component">
                                <li>
                                    <a class="icon-16-newarticle" href="<?php echo $linkAddUser; ?>">Add New User</a>
                                </li>
                            </ul>
                        </li>
                            
                        <li class="node">
                            <a class="icon-16-groups" href="<?php echo $linkGroup; ?>">Groups</a>
                            <ul id="menu-com-users-groups" class="menu-component">
                                <li>
                                    <a class="icon-16-newarticle" href="<?php echo $linkAddGroup; ?>">Add New Group</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="node"><a href="<?php echo $linkCategory; ?>">Category</a></li>
                <li class="node"><a href="<?php echo $linkBook; ?>">Book</a></li>
            </ul>
        </div>
    
		<div class="clr"></div>
	</div>