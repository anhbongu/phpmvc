<?php 

    if(!empty($this->listItem)){
        $categoryMenu = '';           
        $imgPath = FILES_URL.'category'.DS;        
        foreach ($this->listItem as $value) {
            // $nameURL = URL::filterURL($value['name']);
            // $linkURL = $nameURL.'-'.$id.'.html';
            // $linkBook = URL::creatLink('default', 'book', 'list', array('id'=>$id));
            $linkURL = URL::URLBook($value['id'], $value['name']);

            $categoryMenu .= Helper::cmsItemCategory($value['name'], $linkURL , $imgPath.$value['picture']);
            

        }        
    }
    $titleName = Helper::cmsTitle('Chuyên mục');

 ?>
<div class="left_content">
        <?php echo $titleName; ?>
           
       <div class="new_products">
       
                <?php echo  $categoryMenu; ?>
                

                   
                

            <div class="pagination">
            <span class="disabled">&lt;&lt;</span><span class="current">1</span><a href="#?page=2">2</a><a href="#?page=3">3</a>…<a href="#?page=199">10</a><a href="#?page=200">11</a><a href="#?page=2">&gt;&gt;</a>
            </div>  
        
        </div> 
          
            
        <div class="clear"></div>
</div>