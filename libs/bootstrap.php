<?php 
	class Bootstrap{
		private $_params;
		private $_objectController;
		public function __construct(){
			$this->setParam();

			
			//neeus url ko truyen cac parms
			if(!array_key_exists('controller', $this->_params)){
				$this->_params['controller'] = DEFAULT_CONTROLLER;
				$this->_params['module'] = DEFAULT_MODULE;
				$this->_params['action'] = DEFAULT_ACTION;
			}

			$controlerName = $this->_params['controller'].'Controller';
			$filePath = MODULE_PATH.$this->_params['module'].DS.'controllers'.DS.$controlerName .'.php';


			if(file_exists($filePath)){
				$this->loadExistingController($filePath, $controlerName);
				$this->CallMethod();

			}else{
				$this->loadDefaultController();
			}

		}

		//call method
		private function CallMethod(){
			$actionName = $this->_params['action'].'Action';
			if(method_exists($this->_objectController, $actionName)==true){

				$module 	= $this->_params['module'];
				$controller = $this->_params['controller'];
				$action 	= $this->_params['action'];

				$userInfo 	= SESSION::get('user');
				//kiểm tra đã đăng nhập chưa và thời gian đăng nhập còn tại hay không
				if(empty($userInfo)){
					$logged = false; //lúc chưa đăng nhâp thì session sẽ chưa có thông tin
				}else{
					$logged 	= ($userInfo['login']==true && ($userInfo['time'] + 3600) >= time()); 
				}

				
				$pageLogin	= ($controller=='index') && ($action=='login');
				
				//login admin
				if($module=='admin'){
					//khi đăng nhâp thành công
					if($logged==true){
						$userInfo['group_acp'];
						if($userInfo['group_acp']==1){
							if($pageLogin==true) URL::redirect('admin', 'index', 'index');
							if($pageLogin==false) $this->_objectController->$actionName();
						}else{
							SESSION::set('error', 'Bạn không có quyền truy cập Admin vào lúc này!');
							SESSION::delete('user');

							URL::redirect('admin', 'index', 'login');
						}						
					}else{
						SESSION::delete('user');
						if($pageLogin==true) $this->_objectController->$actionName();	
						if($pageLogin==false) URL::redirect('admin', 'index', 'login');
					}

					//login default
				}else if($module=='default'){
					if($logged==true){
							if($pageLogin==true) URL::redirect('default', 'index', 'index');
							if($pageLogin==false) $this->_objectController->$actionName();
					}else{
						SESSION::delete('user');
						if($controller=='user'){
							URL::redirect('default', 'index', 'login');
						}
						$this->_objectController->$actionName();					
					}
					




				}

				
			}else{
				$this->_error();
			}
		}

		//params
		private function setParam(){
			$this->_params 	= array_merge($_GET, $_POST);
		}

		//LOAD DEFAULT CONTROLLER: LOAD PHUWONG THUC MAC DINH
		private function loadDefaultController(){
			//===============load controller
			$controllerName = ucfirst(DEFAULT_CONTROLLER).'Controller';
			$actionName 	= ucfirst(DEFAULT_ACTION).'Action';
			$filePath = MODULE_PATH.DEFAULT_MODULE.DS.'controllers'.DS.$controllerName.'.php';
			if(file_exists($filePath)){
				require_once($filePath);
				$this->_objectController = new $controllerName;
				$this->_objectController->setView('default');
				$this->_objectController->$actionName();
			}
		
				
		}

		//LOAD EXISTING CONTROLLER: LOAD CONTROLLER TON TAI
		private function loadExistingController($filePath, $controllerName){
				require_once($filePath);
				$this->_objectController = new $controllerName($this->_params);
				$this->_objectController->loadmodel($this->_params['module'], $this->_params['controller']);
				$this->_objectController->setView($this->_params['module']);
				// $this->_objectController->setTemplate($this->_objectController);
				$this->_objectController->setTemplate();

				$this->_objectController->setParams($this->_params);
		}






		public function _error(){
			$filePath = MODULE_PATH.'default'.DS.'controllers'.DS.'ErrorController' .'.php';
			require_once($filePath);
			$this->_objectController = new ErrorController();
			$this->_objectController->setView('default');
			$this->_objectController->IndexAction();
		}
	}

 ?>


