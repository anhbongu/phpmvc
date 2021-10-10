<?php 
	class CategoryController extends Controller{
		public function __construct(){
			parent::__construct();
		}
		public function IndexAction(){

			$this->Template();
			$_title = 'category';
			$this->_view->setTitle($_title);



			$listItem = $this->_model->listCategory($this->_arrParam);
			$this->_view->listItem = $listItem;
			// $this->_view->appendlink(array('user/css/user.css'), 'css');//chèn file css riêng
			$this->_view->render('category/index', true);


			

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