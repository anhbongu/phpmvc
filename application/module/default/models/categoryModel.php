<?php 
	class CategoryModel extends Model{
		public function __construct(){
			parent::__construct();
			$this->setTable('category');
		}


		//add user
		public function listCategory($arrParam, $option = null){
			//status > o thi mới public ra ngoài, sắp xếp theo ordering để có thể dễ dàng thay đổi thư tự
			$query = "SELECT * FROM $this->table WHERE `status` > 0 ORDER BY `ordering` ASC ";
			return $result = $this->listRecord($query);			

		}
	}
 ?>