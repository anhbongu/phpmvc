 <?php 


 	$valueName 			= isset($this->result['name']) ? $this->result['name'] : '';
 	$valuePrice 		= isset($this->result['price']) ? $this->result['price'] : '';
 	$valueSale_off		= isset($this->result['sale_off']) ? $this->result['sale_off'].'%' : '';



 	$valueOrdering 		= isset($this->result['ordering']) ? $this->result['ordering'] : '';
 	$valueStatus		= isset($this->result['status']) ? $this->result['status'] : 'default';
 	$valueSpecial		= isset($this->result['special']) ? $this->result['special'] : 'default';
 	$valueCategory_id	= isset($this->result['category_id']) ? $this->result['category_id'] : 'default';
 	$valuePicture		= isset($this->result['picture']) ? $this->result['picture'] : 'default';
 	$valueDescription	= isset($this->result['description']) ? $this->result['description'] : '';
 	
 	//inputName


 	$inputName 			= Helper::cmsInput('text', 'form[name]', 'name', $valueName, 'inputbox required', 40);
 	$inputDescription 	= '<textarea  name="form[description]">'.$valueDescription.'</textarea>';
 	$inputPrice			= Helper::cmsInput('text', 'form[price]', 'price', $valuePrice, 'inputbox');

 	$inputSaleOff 		= Helper::cmsInput('text', 'form[sale_off]', 'sale_off',$valueSale_off, 'inputbox');



 	$inputOrdering		= Helper::cmsInput('text', 'form[ordering]', 'ordering', $valueOrdering , 'inputbox', 40);
 	$inputStatus 		= Helper::cmsSelectBox('form[status]', array( 'default'=>'-SeLect status-',1=>'Publish', 0=>'Unpublish'), $valueStatus);
 	$inputSpecial 		= Helper::cmsSelectBox('form[special]', array( 'default'=>'-SeLect special-',1=>'Yes', 0=>'No'), $valueSpecial);

    // select group

    $arrGroup      	= $this->ỉtemselectbox;
    $categorySlectbox = Helper::cmsSelectBox('form[category_id]', $arrGroup, $valueCategory_id); 	
    $picture 		= Helper::cmsInput('file', 'picture', 'picture','', 'inputbox');
    $picture_hidden = Helper::cmsInput('hidden', 'form[picture_hidden]', 'picture_hidden',$valuePicture, 'inputbox');//hidden


 	$pathImg 	= FILES_URL.'book/'.$this->result['picture'];
	$image 		= "<li><img style='clear: both; margin-left: 150px;' src=".$pathImg." ></li>";
 	
	//rowname
 	$rowName		= Helper::cmsRows('Name', $inputName, true);
 	$rowDescription	= Helper::cmsRows('Description', $inputDescription);
 	$rowPrice		= Helper::cmsRows('Price', $inputPrice);
 	// $rowSpecial		= Helper::cmsRows('Special', $inputSpecial);
 	$rowSaleOff		= Helper::cmsRows('Sale off', $inputSaleOff);



 	$rowOrdering	= Helper::cmsRows('Ordering', $inputOrdering);
 	$rowStatus		= Helper::cmsRows('Status', $inputStatus);
 	$rowSpecial		= Helper::cmsRows('Special', $inputSpecial);
 	$rowCategory	= Helper::cmsRows('Category', $categorySlectbox);
 	$rowPicture		= Helper::cmsRows('Picture', $picture.$image.$picture_hidden);


 	
	$error 		= isset($this->error) ? $this->error : '';
	$errorHTML 	= Helper::cmsError($error);

	//THÔNG BÁO
    $message    = SESSION::get('message');
    SESSION::delete('message');
    $alert      = Helper::cmsMessage($message);  

  ?>   
    <div id="content-box">
       	<?php include_once(MODULE_PATH.'admin/views/toolbar.php'); ?>
        <?php include_once('submenu/index.php'); ?>
        
         <div id="system-message-container">
            <dl id="system-message">
                <?php echo $alert; ?>
            </dl>
        </div>  
		<?php echo $errorHTML; ?>
		<div class="m">
			<form action="#" method="post" name="adminForm" id="adminForm" class="form-validate" enctype="multipart/form-data">
				<!-- FORM LEFT -->
				<div class="width-100 fltlft">
					<fieldset class="adminform">
						<legend>ADD USER</legend>
						<ul class="adminformlist">
							<?php echo $rowName.$rowDescription.$rowPrice.$rowSaleOff.$rowOrdering.$rowStatus.$rowSpecial.$rowCategory.$rowPicture?>

							

						</ul>
						<div class="clr"></div>
						<div>
							<input type="hidden" name="form[token]" value="1384158288">
						</div>
					</fieldset>
				</div>
				<div class="clr"></div>
				<div>
				</div>
			</form>
			<div class="clr"></div>
		</div>        

    </div>
       