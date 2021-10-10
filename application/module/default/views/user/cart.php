<?php 
    $imgPath = FILES_URL.'book'.DS; 
    $cart   = SESSION::get('cart');
    $totalPrice = 0;
    if(!empty($cart)){
        $totalPrice = array_sum($cart['price']);
        $totalPrice = number_format($totalPrice);
    }
            // echo '<pre>';
            // echo print_r($this);
            // echo '<pre>';

    $xhtml = '';
    if(!empty($this->result)){
        foreach ($this->result as  $value) {
            //hidden info
            $inputId        = Helper::cmsInput('hidden', 'form[bookid][]', 'input_id'.$value['id'], $value['id'], '');  
            $inputPrice     = Helper::cmsInput('hidden', 'form[price][]', 'input_price'.$value['id'], $value['price'], '');  
            $inputQuantity  = Helper::cmsInput('hidden', 'form[quantity][]', 'input_quantity'.$value['id'], $value['quantity'], '');  
            $inputName      = Helper::cmsInput('hidden', 'form[name][]', 'input_name'.$value['id'], $value['name'], '');  
            $inputPicture   = Helper::cmsInput('hidden', 'form[picture][]', 'input_picture'.$value['id'], $value['picture'], '');  
            

            $linkBook = URL::creatLink('default', 'book', 'detail', array('id'=>$value['id']));

            $xhtml .= '<tr>
                        <td><a href="'.$linkBook.'"><img src="'.$imgPath.$value['picture'].'" alt="" title="" border="0" class="cart_thumb" /></a></td>
                        <td>'.$value['name'].'</td>
                        <td>'.number_format($value['price']).'</td>
                        <td>'.$value['quantity'].'</td>
                        <td>'.number_format($value['total_price']).'</td>               
                    </tr>  ';
            $xhtml .= $inputId.$inputPrice.$inputQuantity.$inputName.$inputPicture;


        }        
    }else{
        $xhtml = 'Chưa có đơn hàng nào!';
    }



    $linkSubmitForm = URL::creatLink('default', 'user', 'buy');


 ?>
       	<div class="left_content">
            <div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>My cart</div>
        
        	<div class="feat_prod_box_details">
            <form action="<?php echo $linkSubmitForm; ?>" method="POST" name="adminForm" id="adminForm" >
                <table class="cart_table">
                    <tr class="cart_title">
                        <td>Ảnh</td>
                        <td>Tên sách</td>
                        <td>Gía</td>
                        <td>Số lượng</td>
                        <td>Tổng tiền</td>               
                    </tr>
                    
                    <?php echo $xhtml; ?>          


 
                    
                           
                
                </table>                
           

            <a href="#" class="continue">&lt; continue</a>
            <a onclick="javascript:submitForm('buy.html');"  href="#" class="checkout">checkout &gt;</a>
          </form>   
             
            
        </div>	
            
              

            

            
        <div class="clear"></div>
        </div><!--end of left content-->

<script>
     function submitForm(url){

          $('#adminForm').attr('action', url);
          $('#adminForm').submit();  
    }

   

</script>