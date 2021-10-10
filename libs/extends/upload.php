<?php 
	class upload{
		public function uploadFile($fileUpload, $folderupload, $option=null){
			if($option==null){

				if(!empty($fileUpload['tmp_name'])){
					$uploadDir = FILES_PATH.$folderupload.DS;
					$extension = '.'.pathinfo($fileUpload['name'], PATHINFO_EXTENSION);
					$newFileName 	= rand();
					//upload file 

					copy($fileUpload['tmp_name'], $uploadDir.$newFileName.$extension);
					return $newFileName.$extension;
				}
			}
		}


		public function removeFile($folderupload, $fileName){
			$filename = FILES_PATH.$folderupload.DS.$fileName;
			unlink($filename);
		}


	}
	
 ?>