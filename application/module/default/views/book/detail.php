<?php 
    $imgPath = FILES_URL.'book'.DS; 
    //details
    $result = $this->result['book_detail'];
    if($result['sale_off'] > 0){

        $price  = ' <span class="red-through" style="color: red;
                    text-decoration: line-through;
                    display: inline-block;
                    text-align: left;font-weight: 400;
                    font-size: 14px;
                    margin-left: 10px;">'.number_format($result['price']).'</span>'; //giá gốc

        $price_sale = ($result['sale_off']*$result['price'] ) / 100;
        $price_book = $result['price'] - $price_sale;  // giá đã đươcj giảm     
        $price  .= ' <span class="red">'.number_format($price_book).'</span>';// giá đã đươcj giảm  
    }else{
        $price  = '<span class="red">'.$result['price'].' vnđ</span>';
        $price_book = $result['price'];
    }


    $detail = substr($result['description'], 0, 300);
    $linkOrder = URL::creatLink('default', 'user', 'order', array('book_id'=>$result['id'], 'price'=>$price_book));


    //book relate
    $arrBook_relate = $this->result['book_relate'];
    $book_relate = '';
    if(!empty($arrBook_relate)){

        foreach ($arrBook_relate as $value) {
            $linkBook = URL::creatLink('default', 'book', 'detail', array('id'=>$value['id']));

            $book_relate .= '<div class="new_prod_box">
                            <a href="'.$linkBook.'">'.$value['name'].'</a>
                            <div class="new_prod_bg">
                            <a href="'.$linkBook.'"><img src="'.$imgPath.$value['picture'].'" alt="" title="" class="thumb" border="0" /></a>
                            </div>           
                        </div>';            # code...
        }
    }else{
        $book_relate = 'Dữ liệu đang cập nhật!';
    }


    $titleName = Helper::cmsTitle($result['name']);
 ?>

   	<div class="left_content">

        <?php echo $titleName ; ?>
    
    	<div class="feat_prod_box_details">
        
        	<div class="prod_img"><a href="details.html"><img src="<?php echo $imgPath.$result['picture'] ?>" alt="" title="" border="0" /></a>
            <br /><br />
            <a href="images/big_pic.jpg" rel="lightbox"><img src="<?php echo $imageURL; ?>/zoom.gif" alt="" title="" border="0" /></a>
            </div>
            
            <div class="prod_det_box">
            	<div class="box_top"></div>
                <div class="box_center">
                <div class="prod_title">Chi tiết</div>
                <p class="details"><?php echo $detail; ?></p>
                <div class="price"><strong>PRICE:</strong> <span class="red"><?php echo $price; ?></div>

                <a href="<?php echo $linkOrder; ?>" class="more"><img src="<?php echo $imageURL; ?>/order_now.gif" alt="" title="" border="0" /></a>
                <div class="clear"></div>
                </div>
                
                <div class="box_bottom"></div>
            </div>    
        <div class="clear"></div>
        </div>	
        
        
        <div id="demo" class="demolayout">

            <ul id="demo-nav" class="demolayout">
            <li><a class="tab1 active" href="#">Thông tin chi tiết</a></li>
            <li><a class="tab2" href="#">Sách liên quan</a></li>
            </ul>

        <div class="tabs-container">
        
                <div style="display: block;" class="tab" id="tab1">
                    <p class="more_details"><?php echo $result['description']; ?></p>                         
                </div>	
                
                <div style="display: none;" class="tab" id="tab2">
                <?php echo $book_relate; ?>


               
                <div class="clear"></div>
                        </div>	
        
        </div>


		</div>
        

        
    <div class="clear"></div>
    </div><!--end of left content-->