<?php 

	$imgUrl  = TEMPLATE_URL.'admin/main/'.$this->_dirImg;

	$arrMenu = array(
					array('link'=>URL::creatLink('admin','book','add'), 'image'=>'icon-48-article-add', 'name'=>'Add New Book'),
					array('link'=>URL::creatLink('admin','book','index'), 'image'=>'icon-48-article'	, 'name'=>'Book Manager'),
					array('link'=>URL::creatLink('admin','category','index'), 'image'=>'icon-48-category'	, 'name'=>'Category Manager'),
					array('link'=>URL::creatLink('admin','group','index'), 'image'=>'icon-48-groups'	, 'name'=>'Group Manager'),
					array('link'=>URL::creatLink('admin','user','index'), 'image'=>'icon-48-user', 'name'=>'User Manager')


				);

	$xhtml = '';
	foreach ($arrMenu as $key => $value) {
		
		$image = $imgUrl.'/header/'.$value['image'].'.png';
		$xhtml .= '<div class="icon-wrapper">
					<div class="icon">
						<a href="'.$value['link'].'">
							<img src="'.$image.'" alt="">
							<span>'.$value['name'].'</span>
						</a>
					</div>
				</div>';



			
	}	
	//THÔNG BÁO
    $message    = SESSION::get('message');
    SESSION::delete('message');
    $alert      = Helper::cmsMessage($message); 
 ?>

  <div id="system-message-container">
    <dl id="system-message">
        <?php echo $alert; ?>
    </dl>
</div> 
   <div id="content-box">
        <div id="element-box">
			<div id="system-message-container"></div>
			<div class="m">
				<div class="adminform">
					<div class="cpanel-left">
						<div class="cpanel">
							<?php echo $xhtml; ?>

						</div>
					</div>
					
				</div>
				<div class="clr"></div>
			</div>
		</div>
    </div>