 <?php 


 	$valueName 			= isset($this->result['name']) ? $this->result['name'] : '';
 	$valueOrdering 		= isset($this->result['ordering']) ? $this->result['ordering'] : '';
 	$valueStatus		= isset($this->result['status']) ? $this->result['status'] : 'default';
 	$valueGroupacp		= isset($this->result['group_acp']) ? $this->result['group_acp'] : 'default';
 	//inputName


 	$inputName 		= Helper::cmsInput('text', 'form[name]', 'name', $valueName, 'inputbox required', 40);
 	$inputOrdering	= Helper::cmsInput('text', 'form[ordering]', 'ordering', $valueOrdering , 'inputbox', 40);
 	$inputStatus 	= Helper::cmsSelectBox('form[status]', array( 'default'=>'-SeLect status-',1=>'Publish', 0=>'Unpublish'), $valueStatus);
 	$inputGroup_acp = Helper::cmsSelectBox('form[group_acp]', array( 'default'=>'-SeLect Group_acp-',1=>'Yes', 0=>'No'), $valueGroupacp);
	//rowname
 	$rowName		= Helper::cmsRows('Name', $inputName, true);
 	$rowOrdering	= Helper::cmsRows('Ordering', $inputOrdering);
 	$rowStatus		= Helper::cmsRows('Status', $inputStatus);
 	$rowGroup_acp	= Helper::cmsRows('Group ACP', $inputGroup_acp);

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
 
		<?php echo $errorHTML; ?>
		<div class="m">
			<form action="#" method="post" name="adminForm" id="adminForm" class="form-validate">
				<!-- FORM LEFT -->
				<div class="width-100 fltlft">
					<fieldset class="adminform">
						<legend>ADD</legend>
						<ul class="adminformlist">
							<?php echo $rowName.$rowOrdering.$rowStatus.$rowGroup_acp?>

							

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
       