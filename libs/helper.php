<?php 
	class Helper{

		//creat Button
		public static function cmsButton($id, $link, $icon, $title, $type = 'new'){
			$xhtml =  '<li class="button" id="t'.$id.'">';
			if($type == 'new'){
				$xhtml .= '<a class="" href="'.$link.'"><span class="'.$icon.'"></span>'.$title.'</a>';
			}else if($type == 'submit'){
				$xhtml .= '<a class="" href="#" onclick="javascript:submitForm(\''.$link.'\')"><span class="'.$icon.'"></span>'.$title.'</a>';
			}
            
            $xhtml .= '</li>';
            return $xhtml;
		}

		//Fomat date
		public static function fomatDate($date_created){
            if($date_created == '0000-00-00'){
                $date = 'NULL';
            }else{
                $date = date('d-m-Y', strtotime($date_created));
            }
            return $date;
		}

		//creat status
		public static function cmsStatus($status, $link, $id){
            $classStatus = ($status==1) ? 'state publish' : 'state unpublish';
            return $status = '<a class="jgrid hasTip" id="status-'.$id.'" href="javascript:changeStatus(\''.$link.'\');"><span class="'.$classStatus.'"></span></a>';

            //javascript:changeStatus(\''.$link.'\'): GIÁ TRỊ TRUYỀN VÀO LÀ 1 CHUỖI CẦN TRUYỀN VÀO DẤU NHÁY ĐƠN, TRONG TRƯỜNG HỢP NÀY ĐÃ CÓ DẤU NÁY ĐƠN NÊN TA SỬ DỤNG \'   \';
		}


		//creat status
		public static function cmsGroupACP($groupACP, $link, $id){
            $classGroupACP = ($groupACP==1) ? 'state publish' : 'state unpublish';
            return $status = '<a class="jgrid hasTip" id="groupACP-'.$id.'" href="javascript:changeGroupACP(\''.$link.'\');"><span class="'.$classGroupACP.'"></span></a>';

            //javascript:changeStatus(\''.$link.'\'): GIÁ TRỊ TRUYỀN VÀO LÀ 1 CHUỖI CẦN TRUYỀN VÀO DẤU NHÁY ĐƠN, TRONG TRƯỜNG HỢP NÀY ĐÃ CÓ DẤU NÁY ĐƠN NÊN TA SỬ DỤNG \'   \';
		}
		
		// Create Title sort
		//$name:				Tên cột đc in ra trên menu
		//$column:				Tên cột dc sắp xếp

		public static function cmsLinkSort($name, $column, $columnPost, $orderPost){
			$img	= '';
			$order	= ($orderPost == 'asc') ? 'desc' : 'asc';
			if($column == $columnPost){
				$img	= '<img src="'.TEMPLATE_URL.'admin/main/images/admin/sort_'.$orderPost.'.png" alt="">';
			}
			$xhtml = '<a href="#" onclick="javascript:sortList(\''.$column.'\',\''.$order.'\')">'.$name.$img.'</a>';
			return $xhtml;
		}

		public static function cmsSelectBox($name, $arrValue, $checked='default'){
			$xhtml = '';
			$xhtml .= '<select name="'.$name.'" class="inputbox" >';
			foreach ($arrValue as $key => $value) {
				if($checked == $key){
					$xhtml .= '<option selected="selected" value="'.$key.'">'.$value.'</option>';
				}else{
					$xhtml .= '<option value="'.$key.'">'.$value.'</option>';
				}
				
			}
		    
            $xhtml .='</select>';
			return $xhtml;
		}

		//MESSAGE
		public static function cmsMessage($message){
       
	        $alert = '';
	        if(!empty($message)){
	        	if($message['class']=='success'){
		        	$alert = ' <div class="alert alert-primary '.$message['class'].' message " role="alert">
								  '.$message['content'].'
								</div> ';	        		
				}else{
		        	$alert = ' <div class="alert alert-warning '.$message['class'].' message " role="alert">
								  '.$message['content'].'
								</div> ';					
				}



	        }
	        return $alert;
		}

		//cmsInput
		//<input type="text" name="form[name]" id="name" value="" class="inputbox required" size="40">
		public static function cmsInput($type, $name, $id, $value, $class, $size=null){
			$xhtml = "<input type='$type' name='$name' id='$id' value='$value'  class='$class' size='$size'>";
			return $xhtml;
		}

		//cmsRow ---ADMIN

		public static function cmsRows($name, $input, $check = false){
			$required = '';
			
			if($check==true){
				$required = '<span class="star">&nbsp;*</span>'; 
			}

			$xhtml = '<li><label>'.$name.$required.'</label>'.$input.'</li>';
			return $xhtml;
		}

		//cmsRow ---PUBLIC

		public static function cmsRowsDefault($name, $input, $submit=false){
			if($submit==false){
				$xhtml = '<div class="form_row"><label class="contact"><strong>'.$name.':</strong></label>'.$input.'</div>';
			}else{
				$xhtml = '<div class="form_row">'.$input.'</div>';
			}
			
			return $xhtml;
		}




  		public static function cmsError($error){
  			if(!empty($error)){  			 
  				return $xhtml = '<div class="alert alert-warning" role="alert">
									  '.$error.'
									</div>';  				
  			}


  		}


  		//listitem category
  		public static function cmsItemCategory($name, $link, $img){
  			$xhtml = '<div class="new_prod_box">
		                    <a href="'.$link.'">'.$name.'</a>
		                    <div class="new_prod_bg">
		                    <a href="'.$link.'"><img src="'.$img.'" alt=""  class="thumb" border="0"></a>
		                    </div>           
		                </div>';
		    return $xhtml;

  		}

  		//cmss book

  		//listitem category
  		public static function cmsBook( $link, $img, $name, $detail){
  			$xhtml = '<div class="feat_prod_box">
		            
		            	<div class="prod_img"><a href="'.$link.'"><img src="'.$img.'" alt="" title="" border="0" /></a></div>
		                
		                <div class="prod_det_box">
		    
		                	<div class="box_top"></div>
		                    <div class="box_center">
		                    <div class="prod_title">'.$name.'</div>
		                    <p class="details">'.$detail.'</p>
		                    <a href="'.$link.'" class="more">- more details -</a>
		                    <div class="clear"></div>
		                    </div>
		                    
		                    <div class="box_bottom"></div>
		                </div>    
		            <div class="clear"></div>
		            </div>	';
		    return $xhtml;

  		} 	




  		//cms title
  		public static function cmsTitle($name){
  			return $xhmtl = '<div class="title"><span class="title_icon"></span>'.$name.'</div>';
  		}	


	}

 ?>