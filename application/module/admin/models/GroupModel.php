<?php 
	class GroupModel extends Model{

		public function __construct(){
			parent::__construct();
			$this->setTable('group');

		}
		public function ListItem($arrParam){


			$query[] = 'SELECT *';
			$query[] = 'FROM  `'.$this->table.'`';
			$query[] = "WHERE `id` > 0 ";

			//SORT
			if(!empty($arrParam['filter_search'])){
				$key = $arrParam['filter_search'] ;
				$query[] = "AND name LIKE '%$key%'";
			}
			//SORT SELECTBOX STATUS
			if(isset($arrParam['filter_state']) && $arrParam['filter_state'] != 2 ){
				$query[] = 'AND status = '.$arrParam['filter_state'].'';

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
				$query[] = "AND name LIKE '%$key%'";
		
			}
			//SORT SELECTBOX STATUS
			if(isset($arrParam['filter_state']) && $arrParam['filter_state'] != 2 ){
				$query[] = 'AND status = '.$arrParam['filter_state'].'';

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
				return array($id, $status, URL::creatLink('admin', 'group','ajaxStatus', array('id'=>$id, 'status'=>$status),'js'));				
			}

			if($task == 'group_acp'){
				$id = $arrParam['id'];
				$group_acp = ($arrParam['group_acp']==1) ? 0 : 1;
				$query = 'UPDATE `'.$this->table.'` SET `group_acp`='.$group_acp.' WHERE `id`= '.$id.' ';
				$this->query($query);

				//trả về 1 array để dùng json_encode xử lý
				return array($id, $group_acp, URL::creatLink('admin', 'group','ajaxACP', array('id'=>$id, 'group_acp'=>$group_acp),'js'));				
			}
			
			if($task == 'change_status'){
				$status = $arrParam['type'];
				if(!empty($arrParam['cid'])){
					$ids = '';
					foreach ($arrParam['cid'] as $value) {
							$ids .= "'".$value."',";
						}
					$newid = $ids.'0';
					$query = 'UPDATE `group` SET status = '.$status.' WHERE id IN ('.$newid.')';	
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
				$query = 'UPDATE `'.$this->table.'` SET ordering = '.$value.' WHERE id = '.$key.'';
				$this->query($query);
			}

			
		}

		//add group
		public function saveGroup($arrParam){
			if(!empty($arrParam['form'])){
				unset($arrParam['form']['token']);
				$username = $_SESSION['user']['info']['username'];
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



		public function infoItem($id){
			$query = 'SELECT * FROM `'.$this->table.'` WHERE id='.$id.'';
			return $listItem = $this->singleRecord($query);
		}

	}
 ?>