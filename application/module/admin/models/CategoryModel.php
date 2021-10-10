<?php 
	class CategoryModel extends Model{

		public function __construct(){
			parent::__construct();
			$this->setTable('category');

		}
		public function ListItem($arrParam){


			$query[] = "SELECT * FROM `$this->table`";
			$query[] = "WHERE `id` > 0";

			//SORT
			if(!empty($arrParam['filter_search'])){
				$key = $arrParam['filter_search'] ;
				$query[] = "AND (name LIKE '%$key%')";
			}
			//SORT SELECTBOX STATUS
			if(isset($arrParam['filter_state']) && $arrParam['filter_state'] != 2 ){
				$query[] = 'AND status = '.$arrParam['filter_state'].'';

			}
			//SORT SELECTBOX GROUP
			if(isset($arrParam['filter_group_id']) && $arrParam['filter_group_id'] != 'default' ){
				$query[] = 'AND group_id = '.$arrParam['filter_group_id'].'';

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
				$query[] = "AND (name LIKE '%$key%')";
		
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
				return array($id, $status, URL::creatLink('admin', 'category','ajaxStatus', array('id'=>$id, 'status'=>$status),'js'));				
			}


			
			if($task == 'change_status'){
				$status = $arrParam['type'];
				if(!empty($arrParam['cid'])){
					$ids = '';
					foreach ($arrParam['cid'] as $value) {
							$ids .= "'".$value."',";
						}
					$newid = $ids.'0';
					$query = 'UPDATE `'.$this->table.'` SET status = '.$status.' WHERE id IN ('.$newid.')';	
					$this->query($query);
					SESSION::set('message', array('class'=>'success', 'content'=>'Cập nhật thành công '.$this->affectedRows().' phần tử!' ) );					
				}else{
					SESSION::set('message', array('class'=>'error', 'content'=>'Vui lòng chọn thành phần!' ) );
				}


			}
			




		}

		public function DeleteItem($arrParam){
			if(!empty($arrParam['cid'])){
				//delete image
				$id = $this->creatWhereDeleteSQL($arrParam['cid']);
				$query = 'SELECT `id`, `picture` AS `name` FROM `'.$this->table.'` WHERE `id` IN ('.$id.')';
				$result = $this->fetchPairs($query);

				require_once(EXTENDS_PATH.'upload.php');
				$remove = new Upload();	
				foreach ($result as  $value) {
					$remove->removeFile($this->table, $value);	
				}
					
				
				// delete database
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

		//add Category
		public function saveCategory($arrParam){
			if(!empty($arrParam['form'])){
				//xử lý ảnh
				require_once(EXTENDS_PATH.'upload.php');
				$upload = new Upload();

				$arrParam['form']['picture'] = $upload->uploadFile($arrParam['form']['picture'], 'category');

	

				$username = $_SESSION['user']['info']['username'];//tên hiển thị khi dc add				
				unset($arrParam['form']['token']);
		

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


			// echo '<pre>';
			// echo print_r($arrParam);
			// echo '<pre>'; die();
			if(!empty($arrParam['form'])){
				$fileRemove = $arrParam['form']['picture_hidden'];
				unset($arrParam['form']['picture_hidden']); // xóa file annhr hidden nếu ko sẽ báo lỗi cơ sở dữ liệu
				unset($arrParam['form']['token']);

				$username = $_SESSION['user']['info']['username'];//tên hiển thị khi dc chỉnh sữa
				//update image
				if($arrParam['form']['picture']['name'] == null){
					
					unset($arrParam['form']['picture']);
				}else{

					//xử lý ảnh mới
					require_once(EXTENDS_PATH.'upload.php');
					$upload = new Upload();

					$arrParam['form']['picture'] = $upload->uploadFile($arrParam['form']['picture'], 'category');
					//delete ảnh củ 
					$upload->removeFile($this->table, $fileRemove);						
				}



				$arrParam['form']['modified'] = date('Y-m-d', time());
				$arrParam['form']['modified_by'] = $username;	//tam thời là 1 khi hoc tới login sẽ thay đổi

				$query = 'UPDATE `'.$this->table.'` SET ';
				$query .= $this->creatUpdateSQL($arrParam['form']);	
				$query .= 'WHERE id='.$arrParam['id'].'';
				$query;
		
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