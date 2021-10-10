<?php 
	class BookController extends Controller{
		public function __construct(){
			parent::__construct();
		}
		public function ListAction(){
		
			$this->Template();
			$_title = 'Book';
			$this->_view->setTitle($_title);

			//get name category 
			$result['category'] = $this->_model->infoItem($this->_arrParam, 'category_name');

			//get thông tin của category có những sách nào
			$result['book'] = $this->_model->listItem($this->_arrParam,'book');




			$this->_view->result = $result;


		





			$this->_view->render('book/index', true);


			

		}

		public function DetailAction(){
			$this->Template();
			$_title = 'Chi tiết';
			$this->_view->setTitle($_title);



			$result['book_detail'] = $this->_model->infoItem($this->_arrParam, 'book_detail');
			$result['book_relate'] = $this->_model->listItem($this->_arrParam, 'book_relate');
			$this->_view->result = $result;
			$this->_view->render('book/detail', true);		
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