<?php 
	class IndexModel extends Model{

		public function __construct(){
			parent::__construct();
			$this->setTable('user');

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

		//update profile
		public function UpdateProfile($arrParam){
			if(!empty($arrParam['form'])){
				$username 	= $arrParam['form']['username'];
				$email 		= $arrParam['form']['email'];
				$id 		= $arrParam['id'];
				$query = "UPDATE $this->table SET `username`='$username', `email`='$email'  WHERE `id`='$id'";
				$this->query($query);
				SESSION::set('message', array('class'=>'success', 'content'=>'Cập nhật thành công !' ) );	
				//sau khi update thành công cần update lại các sesion để trả về thông tin ở file profile
				$_SESSION['user']['info']['username'] = $username;
				$_SESSION['user']['info']['email'] = $email;


			}


			
		}


	}
 ?>