<?php 
	$arrMenu = array(
					array('link'=>'#', 'name'=>'Chang password', 'image'=>'changepass.png'),
					array('link'=>'cart.html', 'name'=>'View cart'		, 'image'=>'cart.png'),
					array('link'=>'history.html', 'name'=>'History'		, 'image'=>'history.png'),
					array('link'=>URL::creatLink('default', 'index', 'logout'), 'name'=>'Logout'			, 'image'=>'logout.png')
				);
	$imgPath = FILES_URL.'book'.DS; 
	$xhtml = '';
	foreach ($arrMenu as $key => $value) {
		$xhtml .= '<div class="new_prod_box">
	                    <a href="'.$value['link'].'">'.$value['name'].'</a>
	                    <div class="new_prod_bg">
	                    <a href="'.$value['link'].'"><img src="'.$imageURL.DS.$value['image'].'" alt=""  class="thumb" border="0"></a>
	                    </div>           
	        		</div>';
	}

 ?>
<div class="left_content">
        <div class="title"><span class="title_icon"><img src="\bookstore\public\template\default/main/images/bullet1.gif" alt="" title=""></span>Cá nhân</div>
           
   <div class="new_products">
   		<?php echo $xhtml; ?>           

               
            

    
    </div> 
          
            
        <div class="clear"></div>
</div>  