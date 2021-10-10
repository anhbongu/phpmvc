<?php 
	class UserController extends Controller{
		public function __construct(){
			parent::__construct();		
		}
		public function MyAcoutAction(){
			$this->Template();
			$this->_view->render('user/myacout');
		}

		//order
		public function OrderAction(){

			$book_id 	= $this->_arrParam['book_id'];
			$price 		= (int)$this->_arrParam['price'];
			$cart = SESSION::get('cart');
			if(empty($cart)){
				$cart['quantity'][$book_id] = 1;
				$cart['price'][$book_id]	= $price;
			}else{
				//có 2 trường hợp
				//	+ người dùng đã mua và mua tiếp
				//	+ người dùng chưa mua
				if(key_exists($book_id, $cart['quantity'])){
					$cart['quantity'][$book_id] += 1;
					$cart['price'][$book_id] 	= $price * $cart['quantity'][$book_id];
				}else{
					$cart['quantity'][$book_id] = 1;
					$cart['price'][$book_id]	= $price;					
				}
			}
			SESSION::set('cart', $cart);
		
			
			URL::redirect('default', 'book', 'detail', array('id'=>$book_id));

		}

		//tính tiền
		public function CartAction(){
			$this->Template();
			$_title = 'Cart';
			$this->_view->setTitle($_title);

			$cart = SESSION::get('cart');
			$result = $this->_model->listItem($cart, 'cart-info');	
			$this->_view->result = $result;





			$this->_view->render('user/cart');			
		}



		public function BuyAction(){
			$this->_model->saveItem($this->_arrParam);	
			URL::redirect('default', 'index','index');		
		}

		public function HistoryAction(){
			$this->Template();
			$_title = 'History';
			$this->_view->setTitle($_title);
			$result = $this->_model->listItem($this->_arrParam, 'cart-history');
			$this->_view->result = $result;



			$this->_view->render('user/history');
		}











		public function Template(){
			$this->_templateObj->setFileTemplate('index.php');
			$this->_templateObj->setFileConfig('template.ini');
			$this->_templateObj->setFolderTemplate('default/main');
			$this->_templateObj->load();	
			$this->_view->arrParam = $this->_arrParam;		
		}







	}

 ?>