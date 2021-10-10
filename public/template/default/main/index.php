<?php 
  include_once('html/header.php');
 ?>
       
    
<div class="center_content">
       <?php 
        require_once(MODULE_PATH.$this->moduleName.DS.'views'.DS.$this->_fileView.'.php');

       ?>  

      <div class="right_content">
	        <?php include_once(BLOCK_PATH.'language.php') ?>
	        <?php include_once(BLOCK_PATH.'cart.php') ?>
      </div>
     
      <?php include_once(BLOCK_PATH.'promotion.php') ?>
      <?php include_once(BLOCK_PATH.'category.php') ?>
     

     

</div><!--end of right content-->
        

<?php 
  include_once('html/footer.php');
 ?>
        
       
       
