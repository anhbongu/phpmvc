<?php 
	class BookModel extends Model{
		public function __construct(){
			parent::__construct();
			$this->setTable('book');
		}

		public function infoItem($arrParam, $task=null){
			if($task =='category_name'){
				$query = 'SELECT `id`, `name` FROM `category` WHERE id='.$arrParam['id'].'';
				return $listItem = $this->singleRecord($query);				
			}

			if($task =='book_detail'){
				$query = 'SELECT * FROM `'.$this->table.'` WHERE id='.$arrParam['id'].'';
				return $listItem = $this->singleRecord($query);					
			}



		}

		public function listItem($arrParam, $task=null){
			if($task =='book'){
				$query = 'SELECT * FROM  `'.$this->table.'` WHERE status=1 AND category_id='.$arrParam['id'].' ORDER BY ordering ASC ' ;
				return $listItem = $this->listRecord($query);			
			}
			if($task =='book_relate'){
				$query = 'SELECT `category_id` FROM `'.$this->table.'` WHERE id='.$arrParam['id'].'';
				$result = $this->singleRecord($query);
				$cateId = $result['category_id'];	

				$query = 'SELECT * FROM `'.$this->table.'` WHERE category_id='.$cateId.' AND id != '.$arrParam['id'].' ORDER BY `id` DESC';


				
				return $listItem = $this->listRecord($query);			
			}




			


		}


	}
 ?>