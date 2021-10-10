<?php 
	class ErrorController extends Controller{


		public function indexAction(){

			$this->_view->error = 'This is an error';
			$this->_view->render('error/index');
		}




	}

 ?>