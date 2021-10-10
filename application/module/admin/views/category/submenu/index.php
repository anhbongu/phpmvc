<?php 
    $linkCategory = URL::creatLink('admin', 'category', 'index');
    $linkBook = URL::creatLink('admin', 'book', 'index');

 ?>

<div id="submenu-box">
    <div class="m">
        <ul id="submenu">
            <li><a class="active" href="<?php echo $linkCategory; ?>">Category</a></li>
            <li><a href="<?php echo $linkBook; ?>">Book</a></li>
        </ul>
        <div class="clr"></div>
    </div>
</div>