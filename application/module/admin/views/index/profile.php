 <?php 
	$infoItem = SESSION::get('user');


 	
 	//inputName


 	$inputUserName 		= Helper::cmsInput('text', 'form[username]', 'username', $infoItem['info']['username'], 'inputbox required', 40);
 	$inputEmail			= Helper::cmsInput('text', 'form[email]', 'email', $infoItem['info']['email'], 'inputbox', 40);

 	$inputID			= Helper::cmsInput('text', 'form[id]'		, 'id'	,$infoItem['info']['id'],  'inputbox readonly', 40);


 	
	//rowname
 	$rowUserName		= Helper::cmsRows('Username', $inputUserName);
 	$rowEmail		= Helper::cmsRows('Email', $inputEmail);

 	$rowID				= Helper::cmsRows('ID', $inputID);
 	
 	
 	
	$error 		= isset($this->error) ? $this->error : '';
	$errorHTML 	= Helper::cmsError($error);

	//THÔNG BÁO
    $message    = SESSION::get('message');
    SESSION::delete('message');
    $alert      = Helper::cmsMessage($message);  

  ?>   
    <div id="content-box">
        <?php include_once(MODULE_PATH.'admin/views/toolbar.php'); ?>
        
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
						<legend>My Profile</legend>
						<ul class="adminformlist">
							<?php echo $rowUserName.$rowEmail.$rowID?>

							

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
       