<?php 
	class GroupController extends Controller{
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
			$_title = 'USER MANAGER: USER GROUP';
			$this->_view->setTitle($_title);
			$this->_view->_titleName = $_title;

			//tổng số record
			//tổng số record
			//tổng số record
			$totalItem = $this->_model->countItem($this->_arrParam);
			$this->_arrParam['totalItem'] = $totalItem;


            $this->_arrParam['totalItemPerpage'] =5;

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


			$this->_view->render('group/index', true);

		}

		//AĐD

		public function AddAction(){


			$this->_templateObj->setFileTemplate('index.php');
			$this->_templateObj->setFileConfig('template.ini');
			$this->_templateObj->setFolderTemplate('admin/main');

			$this->_templateObj->load();
			// $this->_view->appendlink(array('group/js/custom.js'), 'js');//chèn file js riêng


            
			$_title = 'USER MANAGER: ADD';
			$this->_view->setTitle($_title);
			$this->_view->_titleName = $_title;


	
			//save
			if(!empty($this->_arrParam['form']['token'])){

				$validate = new Validate($this->_arrParam['form']);
				$name = $this->_arrParam['form']['name'];
				$validate->addRule('name', 'string',array('min'=>3, 'max'=>255))
						 ->addRule('ordering', 'int',array('min'=>1, 'max'=>100))
						 ->addRule('status', 'status',array('deny'=>array('default')))
						 ->addRule('group_acp', 'status',array('deny'=>array('default')))
						 ->addRule('name','existRecord', array('database'=>$this->_model, 'query'=>"SELECT * FROM `group` WHERE name = '$name'"));
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
						URL::redirect('admin','group', 'index');
					}else if($this->_arrParam['type']=='savenew'){
						$this->_model->saveGroup($this->_arrParam);
						URL::redirect('admin','group', 'add');
					}			
				}



			}

			$this->_view->arrParam = $this->_arrParam;
			$this->_view->render('group/add', true);

		}

		//ajaxstatus

		public function AjaxStatusAction(){
			$result = $this->_model->ChangStatus($this->_arrParam, $task = 'status');
			echo json_encode($result);
		}


		//ajaxACP

		public function ajaxACPAction(){

			$result = $this->_model->ChangStatus($this->_arrParam, $task = 'group_acp');
			echo json_encode($result);
		}

		//publish status unplish status
		public function StatusAction(){
			$this->_model->ChangStatus($this->_arrParam, $task = 'change_status');
			URL::redirect('admin', 'group', 'index');
			
		}

		//delete trash
		public function TrashAction(){
			$this->_model->DeleteItem($this->_arrParam);
			
			URL::redirect('admin', 'group', 'index');

			
		}


		//orrdering
		public function OrderingAction(){
			if(!empty($this->_arrParam['order'])){
				$this->_model->UpdateOrdering($this->_arrParam);
			}
			
			URL::redirect('admin', 'group', 'index');
			
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


					

			//nhân kết quả từ dữ liệu trả về _view;
			$result = $this->_model->getSingleRecord($this->_arrParam['id']);
			$this->_view->result = $result[0];


			if(!empty($this->_arrParam['form']['token'])){
				$validate = new Validate($this->_arrParam['form']);
				$name = $this->_arrParam['form']['name'];
				$id = $this->_arrParam['id'];
				$validate->addRule('name', 'string',array('min'=>3, 'max'=>255))
						 ->addRule('ordering', 'int',array('min'=>1, 'max'=>100))
						 ->addRule('status', 'status',array('deny'=>array('default')))
						 ->addRule('group_acp', 'status',array('deny'=>array('default')))
						 ->addRule('name','existRecord', array('database'=>$this->_model, 'query'=>"SELECT * FROM `group` WHERE name = '$name' AND id!='$id' "));
				$validate->run();	

				if($validate->isValid()==false){
					$this->_view->error = $validate->showErrors();
				}else{
					$this->_model->updateItem($this->_arrParam);
					URL::redirect('admin', 'group', 'index');
					exit();		
				}
							

			}
			$this->_view->arrParam = $this->_arrParam;
			$this->_view->render('group/edit');		
		}





	}

 ?>