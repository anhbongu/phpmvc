<?php 
	class Template{
		private $_fileConfig;		//dc cau hinh boi file nao? tempalte.ini
		private $_fileTemplate;	//template do nam trong file nao? index.php
		private $_foderTemplate;		//template do nam trong foder nao? main
		private $_controller;		//danh cho controller nao? controller object


		public function __construct($controller){
			$this->_controller = $controller;

		}
		public function load(){
			$fileConfig = $this->getFileConfig();
			$fileTemplate = $this->getFileTemplate();
			$foderTempate = $this->getFolderTemplate();

			$pathFileConfig = TEMPLATE_PATH.DS.$foderTempate.DS.$fileConfig;
			


			if(file_exists($pathFileConfig)){
				$arrConfig = parse_ini_file($pathFileConfig);


				$view = $this->_controller->_view;
				$view->_title 	 = $this->createTitle($arrConfig['title']);// do _view đã ở trạng thái pulic nên có thể gọi trực tiếp đến thuộc tính _view;
				$view->_metaHTTP = $this->createMetaHTTP($arrConfig['metaHTTP']);
				$view->_metaName = $this->createMetaName($arrConfig['metaName']);
				
				if(isset($arrConfig['dirJs'])){
					$view->_js 	 	 = $this->createJs($arrConfig['dirJs'],$arrConfig['fileJs']);
				}
				
				if(isset($arrConfig['dirCss'])){
					$view->_css 	 = $this->createCss($arrConfig['dirCss'],$arrConfig['fileCss']);
				}
				$view->_dirImg 		= $arrConfig['dirImg'];



				$view->setTemplatePath(TEMPLATE_PATH.$foderTempate.DS.$fileTemplate);//required_once file template
				
			}
		}

		//tao title
		public function createTitle($title){
			return '<title>'.$title .'</title>';
		}


		//tao metaHTTP
		public function createMetaHTTP($arrMetaHTTP){
			$xhtml = '';
			if(!empty($arrMetaHTTP)){

				foreach ($arrMetaHTTP as $value) {
					$temp = explode('|', $value);
					
					$xhtml .= '<meta http-equiv="'.$temp[0].'" content="'.$temp[1].'">';
					
				}
			}
			return $xhtml;
		}

		//tao metaName
		public function createMetaName($arrMetaName){
			$xhtml = '';
			if(!empty($arrMetaName)){

				foreach ($arrMetaName as $value) {
					$temp = explode('|', $value);
					$xhtml .= '<meta name="'.$temp[0].'" content="'.$temp[1].'">';
					
				}
			}
			return $xhtml;
		}

		//tao css
		public function createCss($cssPath,$arrCss){
			$pathCSS = TEMPLATE_URL.$this->_foderTemplate.DS.$cssPath.DS;
			$xhtml = '';
			foreach ($arrCss as $value) {
				$xhtml .= '<link rel="stylesheet" href="'.$pathCSS.$value.'">';
			}
			
			return $xhtml;
		}

		//tao js
		public function createJs($jsPath,$arrjs){
			$pathJS = TEMPLATE_URL.$this->_foderTemplate.DS.$jsPath.DS;
			$xhtml = '';
			foreach ($arrjs as $value) {
				$xhtml .= '<script src="'.$pathJS.$value.'"></script>';

			}
			
			return $xhtml;
		}

		public function setFileTemplate($value = 'index.php'){
			$this->_fileTemplate = $value;
		}

		public function getFileTemplate($value = 'index.php'){
			return $this->_fileTemplate;
		}



		public function setFileConfig($value = 'template.ini'){
			$this->_fileConfig = $value;
		}
		
		public function getFileConfig($value = 'index.php'){
			return $this->_fileConfig;
		}



		public function setFolderTemplate($value = 'default/main'){
			$this->_foderTemplate = $value;
		}
		public function getFolderTemplate($value = 'index.php'){
			return $this->_foderTemplate;
		}





	}

 ?>