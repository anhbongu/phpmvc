<?php 
	class Controller{
		public $_view;			//neeus _view la protected hoac private co the viet ham getview de lay no
		protected $_model;
		protected $_templateObj;
		protected $_arrParam;


		public function __construct(){
			

		}



		public function loadmodel($moduleName, $modelName){
			$modelName = ucfirst($modelName).'Model';
			$modelPath = MODULE_PATH.$moduleName.'/models/'.$modelName.'.php';
			
			if(file_exists($modelPath)){
				require_once($modelPath);
				$this->_model = new $modelName();

			}
				
				
					
		}	


		//set view
		public function setView($moduleName){
			$this->_view = new View($moduleName);
		}

		//set template
		public function setTemplate(){
			$this->_templateObj = new Template($this);

		}

		public function setParams($param){
			$this->_arrParam = $param;
		}
		



	}
 ?>