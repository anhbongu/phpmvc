 <?php 
    $model = new Model();
    $query = "SELECT `b`.`id`, `b`.`name`,`b`.`picture`, `b`.`description`,`b`.`category_id`,`c`.`name` AS `category_name` FROM `book` AS `b` LEFT JOIN `category` AS `c` ON `b`.`category_id`=`c`.`id` WHERE `b`.`status` = 1 ORDER BY `b`.`sale_off` DESC LIMIT 0,3 ";
    $listItem = $model->listRecord($query);
            // echo '<pre>';
            // echo print_r($listItem);
            // echo '<pre>';
   

    $book_sale = '';
    $imgPath = FILES_URL.'book'.DS; 
    if(!empty($listItem)){
        foreach ($listItem as $value) {
            $id_book = $value['id'];
            $nameCate = URL::filterURL($value['category_name']);
            $nameBook = URL::filterURL($value['name']);;
            $cateId   = $value['category_id'];
            $linkBook = URL::LinkCateAndBook($nameCate, $nameBook, $cateId, $id_book);



            // $linkBook = URL::creatLink('default', 'book', 'detail', array('id'=>$value['id']));
            // $book_sale .= '<li><a href="'.$linkBook.'">'.$value['name'].'</a></li>' ;
            $book_sale .= '<div class="new_prod_box">
                            <a href="'.$linkBook.'">'.$value['name'].'</a>
                            <div class="new_prod_bg">
                            <span class="new_icon"><img src="'.$imageURL.'/promo_icon.gif" alt="" title="" /></span>
                            <a href="'.$linkBook.'"><img src="'.$imgPath.$value['picture'].'"  class="thumb" border="0" /></a>
                            </div>           
                        </div>' ;
            
            
        }
    }
  ?>

 <div class="right_box">
 
  <div class="title"><span class="title_icon"><img src="<?php echo $imageURL; ?>/bullet4.gif" alt="" title="" />Đang giảm giá</span></div> 
        
        
        <?php echo $book_sale; ?>             
 
 </div>

   
