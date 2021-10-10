<?php 

	$action = URL::creatLink('admin','index','login');

	//thông báo lỗi không có quyền truy cập vào admin
	$errorAdmin = SESSION::get('error');
	SESSION::delete('error');
	//thông báo lỗi đăng nhâp
	$error 		= isset($this->error) ? $this->error : '';
	$errorHTML 	= Helper::cmsError($error.$errorAdmin);

	//trả dữ liệu đúng khi đăng nhập không thành công
	$valueUserName = isset($this->result['username']) ? $this->result['username'] : '';
 ?>

<div id="content-box">
	<div id="element-box" class="login">
		<div class="m wbg">
			<h1>Administration Login</h1>

			<?php echo $errorHTML; ?>		
            <div id="section-box">
				<div class="m">
					<form action="<?php echo $action; ?>" method="post" id="form-login">
						<fieldset class="loginform">
                            <label>User Name</label>
                            <input name="form[username]" id="mod-login-username" type="text" class="inputbox" size="15" value="<?php echo $valueUserName; ?>"/>
                            <label id="mod-login-password-lbl" for="mod-login-password">Password</label>
                            <input name="form[password]" id="mod-login-password" type="password" class="inputbox" size="15" />

                            <input name="form[token]"  type="hidden" class="inputbox" value="<?php echo time(); ?>"/>
                            <div class="button-holder">
                                <div class="button1">
                                    <div class="next">
                                        <a href="#" onclick="document.getElementById('form-login').submit();">Log in</a>
                                    </div>
                                </div>
                            </div>
							<div class="clr"></div>
                        </fieldset>
					</form>
					<div class="clr"></div>
				</div>
			</div>
	
        	
        	<p><a href="http://localhost/joomla/">Go to site home page.</a></p>
			<div id="lock"></div>
		</div>
	</div>
</div>
