<?php 
	class IndexController extends Controller{
		public function __construct(){
			parent::__construct();

		}
		public function IndexAction(){

			$this->Template();
			$_title = 'Trang chủ';
			$this->_view->setTitle($_title);

			$result['book_special'] = $this->_model->listBook($this->_arrParam, 'special');	
			$result['book_new'] 	= $this->_model->listBook($this->_arrParam, 'new');	




			$this->_view->result = $result;











			// $this->_view->appendlink(array('user/css/user.css'), 'css');//chèn file css riêng
			$this->_view->render('index/index', true);


			

		}
		public function registerAction(){
			$userInfo 	= SESSION::get('user');
			if(!empty($userInfo)){
				if(($userInfo['login']==true && ($userInfo['time'] + 3600) >= time())){
					URL::redirect('default', 'index','index');
				}				
			}

			$this->Template();
			$_title = 'ĐĂNG KÝ';
			$this->_view->setTitle($_title);
			// $this->_view->_titleName = $_title;
			//nếu người dùng refed trang sẽ có giá tro token được lưu gửi lên trước đêm đi so sánh
			if(isset($this->_arrParam['form']['submit'])){
				URL::checkRefreshPage($this->_arrParam['form']['token'], 'default', 'user', 'register');


			

				$validate = new Validate($this->_arrParam['form']);
			
		
				$username = $this->_arrParam['form']['username'];
				$email = $this->_arrParam['form']['email'];
				$validate->addRule('username', 'string',array('min'=>3, 'max'=>255))
						 ->addRule('email', 'email')
						 ->addRule('password', 'password', array('action'=>'add'))
						 ->addRule('fullname', 'string',array('min'=>5, 'max'=>100))// không bắt buôc phải có

						 ->addRule('username','existRecord', array('database'=>$this->_model, 'query'=>"SELECT * FROM `user` WHERE username = '$username'"))
						 ->addRule('email','existRecord', array('database'=>$this->_model, 'query'=>"SELECT * FROM `user` WHERE email = '$email'"));

				$validate->run();	

				if($validate->isValid()==false){
					//ĐĂNG KÝ GĂP LỖI
					$this->_view->error = $validate->showErrors();
					$result = $validate->getResult();
					$this->_view->result = $result;					
			

					
				}else{		
					//ĐĂNG KÝ THÀNH CÔNG
					$this->_model->saveItem($this->_arrParam);
					URL::redirect('default', 'user', 'index');
					exit();
			
				}							
			}		
			$this->_view->render('index/register', true);


		}

		//login
		public function LoginAction(){
			$this->Template();
			$this->_view->appendlink(array('index/css/login.css'), 'css');//chèn file css riêng
			if(isset($this->_arrParam['form']['token'])){
				$username = $this->_arrParam['form']['username'];				
				$password = md5($this->_arrParam['form']['password']);	

				$validate = new Validate($this->_arrParam['form']);	
				$validate->addRule('username', 'string', array('min'=>3, 'max'=>50))	
						 ->addRule('password', 'password', array('action'=>'add'));

				$validate->run();	
				
				if($validate->isValid()==false){
					$this->_view->error = $validate->showErrors();
				}else{
					$model = $this->_model;
					echo $query = "SELECT * FROM `user` WHERE `username`='$username' AND `password`='$password'";
					if($validate->validateLogin($model, $query)==false){
						$this->_view->error = $validate->showErrors();
					}else{
						$infoUser = $this->_model->infoItem($this->_arrParam);

						$arrSesion = array(
											'login'=>true,
											'info'=>$infoUser,
											'time'=>time(),
											'group_acp'=>$infoUser['group_acp']
										);

						SESSION::set('user', $arrSesion);						
						header('location:index.html');
						exit();
					}
				}
			}




			$this->_view->render('index/login', true);


		}



		//logout
		public function LogOutAction(){
			SESSION::delete('user');		
			SESSION::delete('cart');		
			header('location:index.html');
			exit();


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