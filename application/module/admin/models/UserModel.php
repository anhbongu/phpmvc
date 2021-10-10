<?php 
	class UserModel extends Model{

		public function __construct(){
			parent::__construct();
			$this->setTable('user');

		}
		public function ListItem($arrParam){


			$query[] = "SELECT `u`.`id`, `u`.`username`, `u`.`email`, `u`.`status`, `u`.`fullname`, `u`.`ordering`, `u`.`created`, `u`.`created_by`, `u`.`modified`, `u`.`modified_by`, `g`.`name` AS `group_name`";
			$query[] = 'FROM  `'.$this->table.'` AS `u` LEFT JOIN `group` AS `g` ON `u`.`group_id`=`g`.`id`';
			$query[] = "WHERE `u`.`id` > 0";

			//SORT
			if(!empty($arrParam['filter_search'])){
				$key = $arrParam['filter_search'] ;
				$query[] = "AND (username LIKE '%$key%' OR email LIKE '%$key%')";
			}
			//SORT SELECTBOX STATUS
			if(isset($arrParam['filter_state']) && $arrParam['filter_state'] != 2 ){
				$query[] = 'AND `u`.status = '.$arrParam['filter_state'].'';

			}
			//SORT SELECTBOX GROUP
			if(isset($arrParam['filter_group_id']) && $arrParam['filter_group_id'] != 'default' ){
				$query[] = 'AND `u`.group_id = '.$arrParam['filter_group_id'].'';

			}



			if(!empty($arrParam['filter_column']) && !empty($arrParam['filter_column_dir'])){
				$column = $arrParam['filter_column']; 
				$columnDir = $arrParam['filter_column_dir']; 				
				$query[] = 'ORDER BY `'.$column.'` '.$columnDir.'';
			}else{
				$query[] = 'ORDER BY `id` DESC';
			}	

			//PAGINATION
			//PAGINATION
			//PAGINATION

            $totalItemPerpage = $arrParam['totalItemPerpage'];

			$position   = ($arrParam['curentPage']-1)*$arrParam['totalItemPerpage'];
			$query[] = "LIMIT $position,$totalItemPerpage";
			$query = implode(' ', $query);
			return $listItem = $this->listRecord($query);
		}

		//total Items
		public function countItem($arrParam){

			$query[] = "SELECT COUNT('id') AS totalItem"; 
			$query[] = 'FROM  `'.$this->table.'`';
			$query[] = "WHERE `id` > 0 ";
			//SORT

			if(!empty($arrParam['filter_search'])){
				$key = $arrParam['filter_search'] ;
				$query[] = "AND (username LIKE '%$key%' OR email LIKE '%$key%')";
		
			}
			//SORT SELECTBOX STATUS
			if(isset($arrParam['filter_state']) && $arrParam['filter_state'] != 2 ){
				$query[] = 'AND status = '.$arrParam['filter_state'].'';

			}

			//SORT SELECTBOX GROUP
			if(isset($arrParam['filter_group_id']) && $arrParam['filter_group_id'] != 'default' ){
				$query[] = 'AND group_id = '.$arrParam['filter_group_id'].'';

			}
			
			$query = implode(' ', $query);
			return $listItem = $this->TotalItem($query);						
		}

		public function ChangStatus($arrParam, $task){

			if($task == 'status'){
				$id = $arrParam['id'];
				$status = ($arrParam['status']==1) ? 0 : 1;
				$query = 'UPDATE `'.$this->table.'` SET `status`='.$status.' WHERE `id`= '.$id.' ';
				$this->query($query);

				//trả về 1 array để dùng json_encode xử lý
				return array($id, $status, URL::creatLink('admin', 'user','ajaxStatus', array('id'=>$id, 'status'=>$status),'js'));				
			}


			
			if($task == 'change_status'){
				$status = $arrParam['type'];
				if(!empty($arrParam['cid'])){
					$ids = '';
					foreach ($arrParam['cid'] as $value) {
							$ids .= "'".$value."',";
						}
					$newid = $ids.'0';
					$query = 'UPDATE `user` SET status = '.$status.' WHERE id IN ('.$newid.')';	
					$this->query($query);
					SESSION::set('message', array('class'=>'success', 'content'=>'Cập nhật thành công '.$this->affectedRows().' phần tử!' ) );					
				}else{
					SESSION::set('message', array('class'=>'error', 'content'=>'Vui lòng chọn thành phần!' ) );
				}


			}
			




		}

		public function DeleteItem($arrParam){
			if(!empty($arrParam['cid'])){
				$this->delete($arrParam['cid']);
				SESSION::set('message', array('class'=>'success', 'content'=>'Xóa thành công '.$this->affectedRows().' phần tử!' ) );	
			}else{
				SESSION::set('message', array('class'=>'error', 'content'=>'Vui lòng chọn thành phần!' ) );

			}
			
		}

		public function UpdateOrdering($arrParam){
			$order = '';
			$id = '';
			foreach ($arrParam['order'] as $key => $value) {
				echo $query = 'UPDATE `'.$this->table.'` SET ordering = '.$value.' WHERE id = '.$key.'';
				$this->query($query);
			}

			
		}

		//add group
		public function saveGroup($arrParam){
			if(!empty($arrParam['form'])){

				$username = $_SESSION['user']['info']['username'];//tên hiển thị khi dc chỉnh sữa
				
				unset($arrParam['form']['token']);
				$arrParam['form']['password'] = md5($arrParam['form']['password']);
				$arrParam['form']['created'] = date('Y-m-d', time());
				$arrParam['form']['created_by'] = $username;	//tam thời là 1 khi hoc tới login sẽ thay đổi

				$this->insert($arrParam['form']);	
				SESSION::set('message', array('class'=>'success', 'content'=>'Thêm thành công '.$this->affectedRows().' phần tử!' ) );			
			}


		}

		///
		//EDIT

		public function getSingleRecord($id){
			$query = 'SELECT * FROM `'.$this->table.'` WHERE id='.$id.'';
			return $listItem = $this->listRecord($query);

		}


		public function updateItem($arrParam){
			if(!empty($arrParam['form'])){
				unset($arrParam['form']['token']);
				$username = $_SESSION['user']['info']['username'];//tên hiển thị khi dc chỉnh sữa
				$arrParam['form']['password'] = md5($arrParam['form']['password']);
				$arrParam['form']['modified'] = date('Y-m-d', time());
				$arrParam['form']['modified_by'] = $username;	//tam thời là 1 khi hoc tới login sẽ thay đổi

				$query = 'UPDATE `'.$this->table.'` SET ';
				$query .= $this->creatUpdateSQL($arrParam['form']);	
				$query .= 'WHERE id='.$arrParam['id'].'';
				$this->query($query);
				SESSION::set('message', array('class'=>'success', 'content'=>'Cập nhật thành công !' ) );			
			}else{
				SESSION::set('message', array('class'=>'error', 'content'=>'Vui lòng chọn thành phần!' ) );
			}

		}	


		public function itemInSelectbox($arrParam){
			$query = 'SELECT `id`, `name` FROM `group`';
			$listItem = $this->fetchPairs($query);
			$listItem['default'] = '-Select group-';
			ksort($listItem); //đảo ngươc chuỗi
			return $listItem;
		}


		public function infoItem($id){
			$query = 'SELECT * FROM `'.$this->table.'` WHERE id='.$id.'';
			return $listItem = $this->singleRecord($query);
		}

	}
 ?>