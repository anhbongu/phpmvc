<?php 	
	class UserController extends Controller{
		public function __construct(){
			parent::__construct();

		}		

		//hiển thị danh sách các group

		public function IndexAction(){
			// echo '<pre>';
			// echo print_r($this);
			// echo '<pre>';
			$this->_templateObj->setFileTemplate('index.php');
			$this->_templateObj->setFileConfig('template.ini');
			$this->_templateObj->setFolderTemplate('admin/main');
			$this->_templateObj->load();
			// $this->_view->appendlink(array('group/js/custom.js'), 'js');//chèn file js riêng
			$_title = 'USER MANAGER: USER';
			$this->_view->setTitle($_title);
			$this->_view->_titleName = $_title;

			//tổng số record
			//tổng số record
			//tổng số record
			$totalItem = $this->_model->countItem($this->_arrParam);
			$this->_arrParam['totalItem'] = $totalItem;



			//selectbox group
			$ỉtemselectbox = $this->_model->itemInSelectbox($this->_arrParam);

			$this->_view->ỉtemselectbox = $ỉtemselectbox;

            $this->_arrParam['totalItemPerpage'] = 5;

            $this->_arrParam['pageRange'] = 3; // 

            $this->_arrParam['curentPage'] = isset($this->_arrParam['filter_page']) ? $this->_arrParam['filter_page'] : 1;

            $this->_arrParam['position']   = ( $this->_arrParam['curentPage']-1)*$this->_arrParam['totalItemPerpage'];



            $pagination     = new Pagination($totalItem, $this->_arrParam['totalItemPerpage'], $this->_arrParam['curentPage'], $this->_arrParam['pageRange']);

			$this->_view->pagination = $pagination;

			//DANH SÁCH LIST
			//DANH SÁCH LIST

			$list = $this->_model->ListItem($this->_arrParam);
			$this->_view->list = $list;
			$this->_view->arrParam = $this->_arrParam;


			$this->_view->render('user/index', true);

		}

		//AĐD

		public function AddAction(){


			$this->_templateObj->setFileTemplate('index.php');
			$this->_templateObj->setFileConfig('template.ini');
			$this->_templateObj->setFolderTemplate('admin/main');

			$this->_templateObj->load();
			// $this->_view->appendlink(array('group/js/custom.js'), 'js');//chèn file js riêng


            
			$_title = 'USER MANAGER: ADD USER';
			$this->_view->setTitle($_title);
			$this->_view->_titleName = $_title;

			//selectbox group
			$ỉtemselectbox = $this->_model->itemInSelectbox($this->_arrParam);

			$this->_view->ỉtemselectbox = $ỉtemselectbox;
	
			//save
			if(!empty($this->_arrParam['form']['token'])){
			// echo '<pre>';
			// echo print_r($this->_arrParam['form']);
			// echo '<pre>';
				$validate = new Validate($this->_arrParam['form']);
			
		
				$username = $this->_arrParam['form']['username'];
				$email = $this->_arrParam['form']['email'];
				$validate->addRule('username', 'string',array('min'=>3, 'max'=>255))
						 ->addRule('email', 'email')
						 ->addRule('password', 'password', array('action'=>'add'))
						 ->addRule('fullname', 'string',array('min'=>5, 'max'=>100))// không bắt buôc phải có

						 

						 ->addRule('ordering', 'int',array('min'=>1, 'max'=>100))

						 ->addRule('status', 'status',array('deny'=>array('default')))	/// nếu giá trị nhâp vào thuôc mảng deny thì báo lỗi
						 ->addRule('group_id', 'status',array('deny'=>array('default')))
						 ->addRule('username','existRecord', array('database'=>$this->_model, 'query'=>"SELECT * FROM `user` WHERE username = '$username'"))
						 ->addRule('email','existRecord', array('database'=>$this->_model, 'query'=>"SELECT * FROM `user` WHERE email = '$email'"));

				$validate->run();
				
				if($validate->isValid()==false){
					$this->_view->error = $validate->showErrors();
					$result = $validate->getResult();
					$this->_view->result = $result;					

				}else{
					if($this->_arrParam['type']=='save'){
						$this->_model->saveGroup($this->_arrParam);
						$result = $this->_arrParam['form'];
						$this->_view->result = $result;

					}else if($this->_arrParam['type']=='saveclose'){
						$this->_model->saveGroup($this->_arrParam);
						URL::redirect('admin','user', 'index');
					}else if($this->_arrParam['type']=='savenew'){
						$this->_model->saveGroup($this->_arrParam);
						URL::redirect('admin','user', 'add');
					}			
				}



			}

			$this->_view->arrParam = $this->_arrParam;
			$this->_view->render('user/add', true);

		}

		//ajaxstatus

		public function AjaxStatusAction(){
			$result = $this->_model->ChangStatus($this->_arrParam, $task = 'status');
			echo json_encode($result);
		}




		//publish status unplish status
		public function StatusAction(){
			$this->_model->ChangStatus($this->_arrParam, $task = 'change_status');
			URL::redirect('admin', 'user', 'index');
			
		}

		//delete trash
		public function TrashAction(){
			$this->_model->DeleteItem($this->_arrParam);
			
			URL::redirect('admin', 'user', 'index');

			
		}


		//orrdering
		public function OrderingAction(){
			if(!empty($this->_arrParam['order'])){
				$this->_model->UpdateOrdering($this->_arrParam);
			}
			
			URL::redirect('admin', 'user', 'index');
			
		}

		//edit
		public function EditAction(){

			$this->_templateObj->setFileTemplate('index.php');
			$this->_templateObj->setFileConfig('template.ini');
			$this->_templateObj->setFolderTemplate('admin/main');

			$this->_templateObj->load();
			// $this->_view->appendlink(array('group/js/custom.js'), 'js');//chèn file js riêng


            
			$_title = 'USER MANAGER: EDIT';
			$this->_view->setTitle($_title);
			$this->_view->_titleName = $_title;


			//selectbox group
			$ỉtemselectbox = $this->_model->itemInSelectbox($this->_arrParam);

			$this->_view->ỉtemselectbox = $ỉtemselectbox;					

			//nhân kết quả từ dữ liệu trả về _view;
			$result = $this->_model->getSingleRecord($this->_arrParam['id']);
			$this->_view->result = $result[0];

			if(!empty($this->_arrParam['form']['token'])){
				$validate = new Validate($this->_arrParam['form']);

				$username = $this->_arrParam['form']['username'];
				$email = $this->_arrParam['form']['email'];
				$id 	  = $this->_arrParam['id'];
				$validate->addRule('username', 'string',array('min'=>3, 'max'=>255))
						 ->addRule('email', 'email')
					
						 ->addRule('fullname', 'string',array('min'=>5, 'max'=>100))// không bắt buôc phải có

						 

						 ->addRule('ordering', 'int',array('min'=>1, 'max'=>100))

						 ->addRule('status', 'status',array('deny'=>array('default')))	/// nếu giá trị nhâp vào thuôc mảng deny thì báo lỗi
						 ->addRule('group_id', 'status',array('deny'=>array('default')))
						 ->addRule('username','existRecord', array('database'=>$this->_model, 'query'=>"SELECT * FROM `user` WHERE username = '$username' AND id!=$id "))
						 ->addRule('email','existRecord', array('database'=>$this->_model, 'query'=>"SELECT * FROM `user` WHERE email = '$email' AND id!=$id "));
				$validate->run();	

				if($validate->isValid()==false){
					$this->_view->error = $validate->showErrors();
				}else{
					$this->_model->updateItem($this->_arrParam);
					URL::redirect('admin', 'user', 'index');
					exit();		
				}
							

			}
			$this->_view->arrParam = $this->_arrParam;
			$this->_view->render('user/edit');		
		}





	}

 ?>