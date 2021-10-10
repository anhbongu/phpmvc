<?php 
	class UserModel extends Model{
		public function __construct(){
			parent::__construct();
	

		}

		public function listItem($arrParam, $task = null){
			//danh sách book đã mua
			if($task == 'cart-info'){
				if(!empty($arrParam)){
					$newid = '';		
					foreach ($arrParam['quantity'] as $key => $value) {
						$newid .= "'".$key."',";
					}	
					$newid .= "'0'";
						
					
					$query = "SELECT `id`, `name`, `picture` FROM `book` WHERE  id IN ($newid)";
					$result = $this->listRecord($query);
					foreach ($result as $key => $value) {
			            $result[$key]['quantity'] 		= $arrParam['quantity'][$value['id']];
			            $result[$key]['total_price'] 	= $arrParam['price'][$value['id']];
			            $result[$key]['price'] 			= $result[$key]['total_price'] / $result[$key]['quantity'];
					}

					return $result;				
				}
			}

			//history đã mua
			if($task == 'cart-history'){
				if(!empty($arrParam)){
					$username 	= $_SESSION['user']['info']['username'];
					$query = "SELECT * FROM `cart` WHERE `username` = '$username' ORDER BY `date` DESC";
					return $result = $this->listRecord($query);
								
				}
			}


		}
				// Array
				// (
				//     [0] => Array
				//         (
				//             [id] => 20
				//             [name] => Programming c++
				//             [picture] => 2057870511.jpg
				//             [price] => 200000
				//             [quantity] => 1
				//             [total_price] => 200000
				//     [1] => Array
				//         (
				//             [id] => 24
				//             [name] => Programming Logics
				//             [picture] => 417279170.jpg
				//         )
				// 1
				// Array
				// (
				//     [quantity] => Array
				//         (
				//             [24] => 2
				//             [20] => 1
				//         )

				//     [price] => Array
				//         (
				//             [24] => 900000
				//             [20] => 354000

				            			
				// 			}
				// 		}
		public function saveItem($arrParam){
			if(!empty($arrParam['form']['bookid'])){

				$id 		= rand();
				$username 	= $_SESSION['user']['info']['username'];
				$bookid 	= json_encode($arrParam['form']['bookid']); 			
				$prices 	= json_encode($arrParam['form']['price']); 			
				$quantities = json_encode($arrParam['form']['quantity']); 			
				$names 		= json_encode($arrParam['form']['name']); 			
				$pictures 	= json_encode($arrParam['form']['picture']); 
				$status		= 0;
				$date		= date('Y-m-d h:i:s', time());

				$query = "INSERT INTO `cart` ( `id`, `username`, `books`, `prices`, `quantities`, `names`, `pictures`, `status`, `date`) VALUES('$id', '$username','$bookid','$prices', '$quantities', '$names', '$pictures', '$status', '$date') ";	
				$this->query($query);
				SESSION::delete('cart');
			}
		
		}

	}
 ?>