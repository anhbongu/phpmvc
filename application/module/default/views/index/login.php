<?php 
    $action = URL::creatLink('default', 'index', 'login');
    //đăng nhập báo lôi
    $error      = isset($this->error) ? $this->error : '';
    $errorHTML  = Helper::cmsError($error);  
 ?>
     <!-- THÔNG BÁO LỖI NẾU DN KHÔNG THÀNH CÔNG! -->
      
        <div class="left_content">
            <div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>Đăng nhập:</div>
        
            <div class="feat_prod_box_details">

            
                <div class="contact_form">
                     <?php echo $errorHTML; ?>
                    <form action="<?php echo $action; ?>" method="post">


                      <div class="container">
                        <label for="uname"><b>Username</b></label>
                        <input type="text" placeholder="Enter Username" name="form[username]" required>

                        <label for="psw"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="form[password]" required>
                        <input type="hidden" name="form[token]" value="<?php echo time(); ?>">
                        <button type="submit">Login</button>
               
                        <button type="button" class="cancelbtn">Cancel</button>
                        <span class="psw">Forgot <a href="#">password?</a></span>
                      </div>

      
                    </form>    
                    
                </div>  
            
            </div>  
            
              

            

            
        <div class="clear"></div>
        </div><!--end of left content-->