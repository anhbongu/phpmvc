 <?php 


 	$valueUserName 		= isset($this->result['username']) ? $this->result['username'] : '';
 	$valueEmail			= isset($this->result['email']) ? $this->result['email'] : '';
 	$valueFullName		= isset($this->result['fullname']) ? $this->result['fullname'] : '';
 	$valuePassWord		= isset($this->result['password']) ? $this->result['password'] : '';
 	$valueOrdering 		= isset($this->result['ordering']) ? $this->result['ordering'] : '';
 	$valueStatus		= isset($this->result['status']) ? $this->result['status'] : 'default';
 	$valueGroup_id		= isset($this->result['group_id']) ? $this->result['group_id'] : 'default';
 	
 	//inputName


 	$inputUserName 		= Helper::cmsInput('text', 'form[username]', 'username', $valueUserName, 'inputbox required', 40);
 	$inputEmail			= Helper::cmsInput('text', 'form[email]', 'email', $valueEmail, 'inputbox', 40);
 	$inputFullName		= Helper::cmsInput('text', 'form[fullname]', 'fullname', $valueFullName, 'inputbox', 40);
 	$inputPassWord		= Helper::cmsInput('text', 'form[password]', 'password', $valuePassWord, 'inputbox', 40);
 	$inputOrdering		= Helper::cmsInput('text', 'form[ordering]', 'ordering', $valueOrdering , 'inputbox', 40);
 	$inputStatus 		= Helper::cmsSelectBox('form[status]', array( 'default'=>'-SeLect status-',1=>'Publish', 0=>'Unpublish'), $valueStatus);

    //select group

    $arrGroup      = $this->ỉtemselectbox;
    $groupSlectbox = Helper::cmsSelectBox('form[group_id]', $arrGroup, $valueGroup_id); 	


 	
	//rowname
 	$rowUserName	= Helper::cmsRows('Username', $inputUserName, true);
 	$rowEmail		= Helper::cmsRows('Email', $inputEmail);
 	$rowFullName	= Helper::cmsRows('Fullname', $inputFullName);
 	$rowPassWord	= Helper::cmsRows('Password', $inputPassWord);
 	$rowOrdering	= Helper::cmsRows('Ordering', $inputOrdering);
 	$rowStatus		= Helper::cmsRows('Status', $inputStatus);
 	$rowGroup		= Helper::cmsRows('Group', $groupSlectbox);
 	
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
			<form action="#" method="post" name="adminForm" id="adminForm" class="form-validate">
				<!-- FORM LEFT -->
				<div class="width-100 fltlft">
					<fieldset class="adminform">
						<legend>ADD USER</legend>
						<ul class="adminformlist">
							<?php echo $rowUserName.$rowEmail.$rowFullName.$rowPassWord.$rowOrdering.$rowStatus.$rowGroup?>

							

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
       