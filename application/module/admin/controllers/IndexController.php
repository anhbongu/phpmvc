<?php 
	class IndexController extends Controller{
		public function __construct(){
			parent::__construct();

		}

		public function LoginAction(){
			$this->_templateObj->setFileTemplate('login.php');
			$this->_templateObj->setFileConfig('template.ini');
			$this->_templateObj->setFolderTemplate('admin/main');
			$this->_templateObj->load();

			$_title = 'Login';
			$this->_view->setTitle($_title);

			//login
			if(isset($this->_arrParam['form']['token'])){
				URL::checkRefreshPage($this->_arrParam['form']['token'], 'admin', 'index', 'login');

				$username = $this->_arrParam['form']['username'];
				$password = md5($this->_arrParam['form']['password']);

				$validate = new Validate($this->_arrParam['form']);	
				$validate->addRule('username', 'string',array('min'=>3, 'max'=>255))
						 
						 ->addRule('password', 'password', array('action'=>'add'));

				$validate->run();
				

				if($validate->isValid()==false){
					//lỗi khi đăng nhập
					$this->_view->error = $validate->showErrors();
					$result = $validate->getResult();
					$this->_view->result = $result;					
				}else{
					$model = $this->_model;
					$query = "SELECT * FROM `user` WHERE username = '$username'  AND password = '$password'";
					if($validate->validateLogin($model,$query)==false){ //username hoặc mk không đúng
						$this->_view->error = $validate->showErrors();
						$result = $validate->getResult();
						$this->_view->result = $result;	
					}else{
						$infoUser = $this->_model->infoItem($this->_arrParam);

						$arrSesion = array(
											'login'=>true,
											'info'=>$infoUser,
											'time'=>time(),
											'group_acp'=>$infoUser['group_acp']
										);

						SESSION::set('user', $arrSesion);
						URL::redirect('admin', 'index', 'index');
					}
			
				}
			}
			
			$this->_view->render('index/login', true);
		}
		public function IndexAction(){
			$this->_templateObj->setFileTemplate('index.php');
			$this->_templateObj->setFileConfig('template.ini');
			$this->_templateObj->setFolderTemplate('admin/main');
			$this->_templateObj->load();

			$_title = 'Index';
			$this->_view->setTitle($_title);


			
			$this->_view->render('index/index', true);
		}

		public function ProfileAction(){
			$this->_templateObj->setFileTemplate('index.php');
			$this->_templateObj->setFileConfig('template.ini');
			$this->_templateObj->setFolderTemplate('admin/main');
			$this->_templateObj->load();

			$_title = 'Profile';
			$this->_view->setTitle($_title);
			$this->_view->_titleName = $_title;
			$this->_view->arrParam = $this->_arrParam;


			if(!empty($this->_arrParam['form']['token'])){
				$validate = new Validate($this->_arrParam['form']);
				$username 	= $this->_arrParam['form']['username'];
				$email 		= $this->_arrParam['form']['email'];
				$id 		= $this->_arrParam['id'];
				$validate->addRule('username', 'string',array('min'=>3, 'max'=>255))
						 ->addRule('email', 'email')
						 ->addRule('username','existRecord', array('database'=>$this->_model, 'query'=>"SELECT * FROM `user` WHERE username = '$username' AND id!=$id "))
						 ->addRule('email','existRecord', array('database'=>$this->_model, 'query'=>"SELECT * FROM `user` WHERE email = '$email' AND id!=$id "));						 
				$validate->run();
				if($validate->isValid()==false){
					$this->_view->error = $validate->showErrors();
				}else{
					$this->_model->UpdateProfile($this->_arrParam);
					URL::redirect('admin', 'index','index');
				}
			}




			$this->_view->render('index/profile', true);
		}



		// //update profile
		// public function UpdateAction(){
		
		// 	$this->_model->UpdateProfile($this->_arrParam);
		// 	URL::redirect('admin', 'index','index');

		// }

		//logout
		public function LogoutAction(){


			SESSION::delete('user');
			
			URL::redirect('admin', 'index','login');
		}



	}

 ?>