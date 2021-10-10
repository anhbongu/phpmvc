<?php 
    if(!empty($this->result)){
        $imgPath = FILES_URL.'book'.DS;
        $xhtml = "";
        $historyHeader = '<tr class="cart_title"><td>Ảnh</td><td>Tên sách</td><td>Gía</td><td>Số lượng</td><td>Tổng tiền</td> </tr>';
        foreach ($this->result as  $value) {
            $id = $value['id'];
            $date = Helper::fomatDate($value['date']);
            
            $arrBookid      = json_decode($value['books']);
            $arrPrice       = json_decode($value['prices']);
            $arrQuantity    = json_decode($value['quantities']);
            $arrPicture     = json_decode($value['pictures']);

            $arrName        = json_decode($value['names']);
            $status         = $value['status']==0 ? 'Đơn hàng đang được xác nhận' : 'Đã nhận hàng thành công';

            $content = '';
            $total_price = 0;
            foreach ($arrBookid as $keyb => $value) {
                //tổng tiên
                $total_price += ($arrPrice[$keyb])*($arrQuantity[$keyb]);
                $linkBook = URL::creatLink('default', 'book', 'detail', array('id'=>$value));
                $content   .=    '<tr>
                                    <td><a href="'.$linkBook.'"><img src="'.$imgPath.$arrPicture[$keyb].'" alt="" title="" border="0" class="cart_thumb"></a></td>
                                    <td>'.$arrName[$keyb].'</td>
                                    <td>'.number_format($arrPrice[$keyb]).'</td>
                                    <td>'.$arrQuantity[$keyb].'</td>
                                    <td>'.number_format(($arrPrice[$keyb])*($arrQuantity[$keyb])).'</td>               
                                </tr>';               
            }
                      

            $xhtml .= '<div class="history">
                        <p>Mã đơn hàng: '.$id.' - Ngày mua: '.$date.'</p>
                        <table class="cart_table">
                            <tbody>'.$historyHeader.$content.'
                                <tr>
                                <td colspan="4" class="cart_total"><span class="red ">Tổng tiền: '.number_format($total_price).'</span></td>
                                           
                                </tr> 
                            </tbody>
                        </table>                     
                    </div>
                    <p class="history-sussecc">'.$status.'<div class="clear"></div>';
        }
    }

 ?>
<div class="left_content">
            <div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title=""></span>Lịch sử mua hàng</div>
        
        	<div class="feat_prod_box_details">
                <?php echo $xhtml ?>



                




    
             
            
        </div>	
            
              

            

    
    <div class="clear"></div>
</div>

<style>
    .history-sussecc{
        color: red;
        float: right;
        margin-right: 10px;
        font-weight: bold;
    }
</style>