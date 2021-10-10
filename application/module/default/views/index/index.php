<?php 


    if(!empty($this->result)){
        
        $imgPath = FILES_URL.'book'.DS; 

        //BOOK SPECIAL
        $book = '';
        foreach ($this->result['book_special'] as $value) {
            $id_book = $value['id'];
            $nameCate = URL::filterURL($value['category_name']);
            $nameBook = URL::filterURL($value['name']);;
            $cateId   = $value['category_id'];
            $linkBook = URL::LinkCateAndBook($nameCate, $nameBook, $cateId, $id_book);

            // $linkBook = URL::creatLink('default', 'book', 'detail', array('id'=>$id));
            $description = substr($value['description'], 0, 150).'...';
            $book .= Helper::cmsBook($linkBook,$imgPath.$value['picture'], $value['name'], $description);
        }
        //BOOK NEW
        $book_new = '';
        foreach ($this->result['book_new'] as $value) {
            $id = $value['id'];
            $linkBook = URL::creatLink('default', 'book', 'detail', array('id'=>$id));
      
            $book_new .= '<div class="new_prod_box" style="width: 200px; height: 200px">
                        <a style="margin: 0; padding: 0; text-align: left;"  href="'.$linkBook.'">'.substr($value['name'], 1, 40).'</a>
                        <div class="new_prod_bg">
                        <span class="new_icon"><img src="'.$imageURL.'/new_icon.gif" alt="" title="" /></span>
                        <a href="'.$linkBook.'"><img src="'.$imgPath.$value['picture'].'" class="thumb" border="0" /></a>
                        </div>           
                    </div>';
        }        
    }

 ?>

        <div class="left_content">
          
            <div class="title"><span class="title_icon"><img src="<?php echo $imageURL; ?>/bullet1.gif" alt="" title="" /></span>Sách nổi bật</div>
        
  
            
            
            <?php echo $book;  ?>   
            
            
            
           <div class="title"><span class="title_icon"><img src="<?php echo $imageURL; ?>/bullet2.gif" alt="" title="" /></span>New books</div> 
           
           <div class="new_products">
           

                    <?php echo $book_new; ?>
        
            
            </div> 
          
            
        <div class="clear"></div>
        </div>