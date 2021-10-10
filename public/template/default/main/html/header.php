<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<?php echo $this->_title; ?>
	<?php echo $this->_metaHTTP; ?>
	<?php echo $this->_metaName; ?>
	<?php echo $this->_js; ?>
	<?php echo $this->_css; ?>

    <?php 
        $homeURL        = URL::creatURL('index.html');
        $registerURL    = URL::creatURL('register.html') ;
        $loginURL       = URL::creatURL('login.html') ;        
        $categoryURL    = URL::creatURL('category.html') ;
        $myaccoutURL    = URL::creatURL('myacout.html') ;
        $logOutURL      = URL::creatLink('default','index', 'logout');


        $userInfo = SESSION::get('user');
       
        $arrMenu = array();
        $arrMenu[] = array('class'=>'index-index'   , 'link'=>$homeURL    , 'name'=>'home');
        $arrMenu[] = array('class'=>'category-index', 'link'=>$categoryURL, 'name'=>'Categories');
        //nếu đã đăng nhậps
        if(!empty($userInfo)){
            $showName = $userInfo['info']['username'];
            $arrMenu[] = array('class'=>'user-myacout user-cart user-history' , 'link'=>$myaccoutURL, 'name'=>'my accout');
            $arrMenu[] = array('class'=>'index-logout' , 'link'=>$logOutURL  , 'name'=>'Đăng xuất');
            $arrMenu[] = array('class'=>''              , 'link'=>'#'  , 'name'=>'Hi! '.$showName.'');
        }else{
            $arrMenu[] = array('class'=>'index-register' , 'link'=>$registerURL  , 'name'=>'register');
            $arrMenu[] = array('class'=>'index-login'    , 'link'=>$loginURL     , 'name'=>'Login');            
        }


        $menu = '';
        foreach ($arrMenu as $value) {
            $menu .= '<li class="'.$value['class'].'"><a href="'.$value['link'].'">'.$value['name'].'</a></li>';
        }

     ?>
    
<?php 
    $imageURL = TEMPLATE_URL.'default/main/'.$this->_dirImg;

 ?>

</head>
<body>
<div id="wrap">

       <div class="header">
          <div class="logo"><a href="index.html"><img src="<?php echo $imageURL; ?>/logo.gif" alt="" title="" border="0" /></a></div>            
        <div id="menu">
            <ul>                                                                       
                <?php echo $menu; ?>
            </ul>
        </div>     
    
            
            
       </div> 
<?php 
    $controller         = $this->arrParam['controller'];
    $action             = $this->arrParam['action'];
 ?>
<script>
    var controller  = '<?php echo $controller;  ?>';
    var action      = '<?php echo $action;  ?>';
    var classSelect = controller + '-' + action;
    
    $('#menu ul li.' + classSelect).addClass('selected');    

</script>