 <?php 


    $model = new Model();
    $query = "SELECT `id`, `name` FROM `category` WHERE `status` = 1 ORDER BY `ordering` ASC ";
    $listItem = $model->listRecord($query);


    $cateId     = isset($this->result['category']['id']) ? $this->result['category']['id'] : '';
    $book_id    = isset($this->result['book_detail']['category_id']) ? $this->result['book_detail']['category_id'] : '';
    $category = '';
    if(!empty($listItem)){
        foreach ($listItem as $value) {
            $linkBook = URL::URLBook($value['id'], $value['name']);
            // $linkBook = URL::creatLink('default', 'book', 'list', array('id'=>$value['id']));
            if($cateId == $value['id'] || $book_id == $value['id']){
                $category .= '<li><a style="color: red;" href="'.$linkBook.'" class="active">'.$value['name'].'</a></li>' ;
            }else{
                $category .= '<li><a href="'.$linkBook.'">'.$value['name'].'</a></li>' ;
            }
            
            
        }
    }
  ?>


 <div class="right_box">
 
  <div class="title"><span class="title_icon"><img src="<?php echo $imageURL; ?>/bullet5.gif" alt="" title="" /></span>Chuyên mục</div> 
    
        <ul class="list">
            <?php echo $category; ?>                                              
        </ul>


 
 </div> 
