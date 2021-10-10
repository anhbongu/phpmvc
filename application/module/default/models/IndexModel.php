<?php 
	class IndexModel extends Model{
		public function __construct(){
			parent::__construct();
			$this->setTable('user');
		}


		//add user
		public function saveItem($arrParam, $option = null){
			if(!empty($arrParam['form'])){
				unset($arrParam['form']['token']);
				unset($arrParam['form']['submit']);

				$arrParam['form']['register_date']	= date("d-m-Y h:m:s", time());
				$arrParam['form']['register_ip'] 	= $_SERVER['REMOTE_ADDR'];
				$arrParam['form']['status'] 		= 0; //khi người dùng vừa đki sẽ chưa đc active tk nên status là 0;
				$arrParam['form']['password'] = md5($arrParam['form']['password']);

				$this->insert($arrParam['form']);	
				
			}


		}	

		public function infoItem($arrParam){
			$username 	= $arrParam['form']['username'];		
			$password 	= md5($arrParam['form']['password']);		
			$query[]  	= "SELECT `u`.`id`,`u`.`username`, `u`.`email`, `u`.`fullname`, `u`.`group_id`, `g`.`group_acp` ";
			$query[]	= "FROM `user` AS `u` LEFT JOIN `group` AS g ON `u`.`group_id` = `g`.`id`";
			$query[]	= "WHERE `username` = '$username'  AND `password` = '$password'";

			$query	= implode(' ', $query);
			return $result = $this->singleRecord($query);

		}	


		public function listBook($arrParam, $task = null){
			if($task=='special'){
				$query[] = "SELECT `b`.`id`, `b`.`name`,`b`.`picture`, `b`.`description`,`b`.`category_id`,`c`.`name` AS `category_name` ";
				$query[] = "FROM `book` AS `b` LEFT JOIN `category` AS `c` ON `b`.`category_id`=`c`.`id`";
				$query[] = "WHERE `b`.`status`=1 AND `b`.`special`=1";
				$query[] = "ORDER BY `b`.`ordering` ASC";
				$query	= implode(' ', $query);
				return $result = $this->listRecord($query);				
			}
			if($task=='new'){
				$query[] = "SELECT *";
				$query[] = "FROM `book`";
				$query[] = "WHERE `status`=1";
				$query[] = "ORDER BY `id` DESC LIMIT 0,6";
				$query	= implode(' ', $query);
				return $result = $this->listRecord($query);				
			}


		}		
	}

 ?>