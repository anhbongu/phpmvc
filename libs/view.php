<?php 
	class View{
		public $moduleName;
		public $_templatePath;
		public $_title;
		public $_metaHTTP;
		public $_metaName;
		public $_js;
		public $_css;
		public $_fileView;

		public function __construct($moduleName){
			$this->moduleName = $moduleName;

		}

		

		public function render($name, $inlcudeFull = true){
			$path = MODULE_PATH.$this->moduleName.DS.'views'.DS.$name.'.php';
			if(file_exists($path)){
				if($inlcudeFull == true){
					$this->_fileView = $name;
					require_once($this->_templatePath);
				}else{
					require_once($path);
				}
			}else{
				echo 'error';
			}
				
	
				


		}

		public function setTemplatePath($path){
			$this->_templatePath = $path;
			// require_once($path);
		}

		//set title
		public function setTitle($title){
			$this->_title = '<title>'.$title .'</title>';
		}

	

		//set css js riêng cho từng file
		public function appendlink($arrayLink, $type = 'css'){

			if(!empty($arrayLink)){
				$file = MODULE_URL.$this->moduleName.DS.'views'.DS;
				foreach ($arrayLink as $value) {
					if($type == 'css'){
						$this->_css .= '<link rel="stylesheet" href="'.$file.$value.'">' ;
					}else if($type=='js'){

						$this->_js .= '<script src="'.$file.$value.'"></script>' ;
					}
				}
			}
		}

	}

 ?>