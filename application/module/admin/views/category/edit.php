 <?php 

 	$valueName 			= isset($this->result['name']) ? $this->result['name'] : '';
 	$valueOrdering 		= isset($this->result['ordering']) ? $this->result['ordering'] : '';
 	$valueStatus		= isset($this->result['status']) ? $this->result['status'] : 'default';

 	
 	//inputName


 	$inputName 		= Helper::cmsInput('text', 'form[name]', 'name', $valueName, 'inputbox required', 40);

 	$inputOrdering	= Helper::cmsInput('text', 'form[ordering]', 'ordering', $valueOrdering , 'inputbox', 40);
 	$inputStatus 	= Helper::cmsSelectBox('form[status]', array( 'default'=>'-SeLect status-',1=>'Publish', 0=>'Unpublish'), $valueStatus);
 	$inputFile		= Helper::cmsInput('file', 'picture', 'picture', '', 'inputbox', 40);
 	$inputImgHidden	= Helper::cmsInput('hidden', 'form[picture_hidden]', 'picture_hidden', $this->result['picture'], 'inputbox', 40);

 	
	//rowname
 	$rowName		= Helper::cmsRows('Username', $inputName, true);

 	$rowOrdering	= Helper::cmsRows('Ordering', $inputOrdering);
 	$rowStatus		= Helper::cmsRows('Status', $inputStatus);


 
 	$pathImg 	= FILES_URL.'category/'.$this->result['picture'];
	$image 		= "<li><img style='clear: both; margin-left: 150px;' src=".$pathImg." ></li>";
 	$rowFile	= Helper::cmsRows('Upload Image', $inputFile.$image.$inputImgHidden);


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
							<?php echo $rowName.$rowOrdering.$rowFile.$rowStatus?>

							

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
  
