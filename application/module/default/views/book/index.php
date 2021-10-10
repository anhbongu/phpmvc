<?php 
            // echo '<pre>';
            // echo print_r($this);
            // echo '<pre>';
    $category_name = Helper::cmsTitle($this->result['category']['name'] )  ;
    $category_id   = $this->result['category']['id'];
    $book = '';
    $imgPath = FILES_URL.'book'.DS;  
    if(!empty($this->result['book'])){
        foreach ($this->result['book'] as $value) {
            $id = $value['id'];
            
            $replaceCate = URL::filterURL($this->result['category']['name']);
            $replaceBook = URL::filterURL($value['name']);
            $linkBook = $replaceCate."/".$replaceBook.'-'.$category_id.'-'.$value['id'].'.html';

            // $linkBook = URL::creatLink('default', 'book', 'detail', array('category_id'=>$category_id,'id'=>$id));
            $description = substr($value['description'], 0, 150).'...';
            $book .= Helper::cmsBook($linkBook,$imgPath.$value['picture'], $value['name'], $description);
        }        
    }else{
        $book = '<div class="feat_prod_box">Nội dung đang cập nhật!</div>';
    }

   

 ?>

       	<div class="left_content">
            <?php echo $category_name; ?>

           <?php echo  $book; ?>
        

            
            

            
            
  	
            
          
            
            <div class="pagination">
            <span class="disabled"><<</span><span class="current">1</span><a href="#?page=2">2</a><a href="#?page=3">3</a>…<a href="#?page=199">10</a><a href="#?page=200">11</a><a href="#?page=2">>></a>
            </div>   
                     
            
        <div class="clear"></div>
        </div><!--end of left content-->