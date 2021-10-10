<?php 
    $valueUserName  = isset($this->result['username']) ? $this->result['username'] : '';
    $valueFullName  = isset($this->result['fullname']) ? $this->result['fullname'] : '';
    $valuePassWord  = isset($this->result['password']) ? $this->result['password'] : '';
    $valueEmail     = isset($this->result['email']) ? $this->result['email'] : '';

    //FORM
    $inputUserName  = Helper::cmsInput('text', 'form[username]', 'username', $valueUserName, 'contact_input', '');
    $inputFullName  = Helper::cmsInput('text', 'form[fullname]', 'fullname', $valueFullName, 'contact_input', '');
    $inputPassWord  = Helper::cmsInput('text', 'form[password]', 'password', $valuePassWord, 'contact_input', '');
    $inputEmail     = Helper::cmsInput('text', 'form[email]', 'email', $valueEmail, 'contact_input', '');
    $inputSubmit    = Helper::cmsInput('submit', 'form[submit]', '','register', 'register');
    $inputToken    = Helper::cmsInput('hidden', 'form[token]', 'token',time(), ''); //input token

    $rowUserName    = Helper::cmsRowsDefault('Username',$inputUserName);
    $rowFullName    = Helper::cmsRowsDefault('FullName',$inputFullName);
    $rowPassWord    = Helper::cmsRowsDefault('Password',$inputPassWord);
    $rowEmail       = Helper::cmsRowsDefault('Email ',$inputEmail);
    $rowSubmit      = Helper::cmsRowsDefault('Submit ',$inputToken.$inputSubmit, true);

    $action = URL::creatLink('default', 'user', 'register');

    //đăng ký thành công
    $message        = SESSION::get('message');
    SESSION::delete('message');
    $alert          = Helper::cmsMessage($message);

    //đăng ký báo lôi
    $error      = isset($this->error) ? $this->error : '';
    $errorHTML  = Helper::cmsError($error);   

 ?>
    
        <div id="system-message-container">
            <dl id="system-message">
                <?php echo $alert; ?>
            </dl>
        </div>

    <!-- THÔNG BÁO LỖI NẾU ĐK KHÔNG THÀNH CÔNG! -->
      <?php echo $errorHTML; ?>


       	<div class="left_content">
            <div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>Register</div>
        
        	<div class="feat_prod_box_details">

            
              	<div class="contact_form">
                <div class="form_subtitle">create new account</div>
                 <form name="adminform" action="<?php echo $action; ?>" method="post">          
                    <?php echo $rowUserName.$rowFullName.$rowPassWord.$rowEmail.$rowSubmit; ?> 


                    
   
                  </form>     
                </div>  
            
          </div>	
            
              

            

            
        <div class="clear"></div>
        </div><!--end of left content-->
        