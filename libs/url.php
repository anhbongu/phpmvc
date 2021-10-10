<?php 
	class URL{
		public static function creatLink($module, $controller, $action, $param = null, $type=""){
			if(!empty($param)){
				$link = '';
				foreach ($param as $key => $value) {
					$link .= '&'.$key.'='.$value;

				}
				if($type=='js'){
					$url ='index.php?module='.$module.'&controller='.$controller.'&action='.$action.$link;
				}else{
					$url = ROOT_URL.DS.'index.php?module='.$module.'&controller='.$controller.'&action='.$action.$link;
				}
				
			}else{
				if($type=='js'){
					$url ='index.php?module='.$module.'&controller='.$controller.'&action='.$action;
				}else{
					$url = ROOT_URL.DS.'index.php?module='.$module.'&controller='.$controller.'&action='.$action;
				}
				
			}

			
			
			
			
			return $url;
		}

		//TẠO LINK CÓ ROOT_PATH
		public static function creatURL($url){
			return $url = ROOT_URL.DS.$url;
		}

		public static function redirect($module, $controller, $action, $option = null){
			header('location:'.URL::creatLink($module, $controller,$action, $option));
			exit();
		}

		public static function checkRefreshPage($value, $module, $controller, $action){
			if(SESSION::get('token') == $value){
				SESSION::delete('token');
				URL::redirect($module, $controller, $action);
			}else{
				SESSION::set('token',$value);
			}
		}

		//loại bỏ khoảng trắng dư thừa
		private static function removeSpace($value){
			// $value = preg_replace('#(\s)+#', ' ', $value);
			$value = trim($value);
			return $value;
		}

		//nếu có nhiều - chuyển đổi nhiều -- thành 1 -
		private static function replaceSpace($value){
			$value = str_replace(' ', '-',$value); //chuyển đổi khoảng trắng thành -
			$value = preg_replace('#(-)+#', '-', $value);
			return $value;
		}



		//chuyển đổi từ tiếng việt sang.....
	    private static function convert_vi_to_en($str) {
		      $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", "a", $str);
		      $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", "e", $str);
		      $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", "i", $str);
		      $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", "o", $str);
		      $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", "u", $str);
		      $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", "y", $str);
		      $str = preg_replace("/(đ)/", "d", $str);
		      $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", "A", $str);
		      $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", "E", $str);
		      $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", "I", $str);
		      $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", "O", $str);
		      $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", "U", $str);
		      $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", "Y", $str);
		      $str = preg_replace("/(Đ)/", "D", $str);
		      //$str = str_replace(" ", "-", str_replace("&*#39;","",$str));
		      return $str;
		}
		//chuyển đôi url
		public static function filterURL($value){
			$value = URL::removeSpace($value);
			$value = URL::convert_vi_to_en($value);
			$value = URL::replaceSpace($value);
			$value = strtolower($value); //chuyển đổi chữ hoa sang thường
			
			return $value;
		}

		//change link
		public static function URLBook($id, $nameURL){
            $name = URL::filterURL($nameURL);
            return $linkURL = ROOT_URL.DS.$name.'-'.$id.'.html';			
		}

		//link category and book
		public static function LinkCateAndBook($nameCate, $nameBook, $idCate, $idBook){
			return $linkBook = ROOT_URL.DS."$nameCate/$nameBook-$idCate-$idBook.html";			
		}













	}

 ?>