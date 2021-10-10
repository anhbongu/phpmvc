<?php 
	class BookModel extends Model{

		public function __construct(){
			parent::__construct();
			$this->setTable('book');

		}
		public function ListItem($arrParam){

			$query[] = "SELECT `b`.`id`, `b`.`name`, `b`.`description`, `b`.`price`, `b`.`special`, `b`.`sale_off`, `b`.`picture`,`b`.`status`, `b`.`ordering`, `b`.`created_by`,`b`.`created`, `b`.`modified`, `b`.`modified_by`, `c`.`name` AS `category_name`";
			$query[] = 'FROM  `'.$this->table.'` AS `b` LEFT JOIN `category` AS `c` ON `b`.`category_id`=`c`.`id`';
			$query[] = "WHERE `b`.`id` > 0";

			//SORT
			if(!empty($arrParam['filter_search'])){
				$key = $arrParam['filter_search'] ;
				$query[] = "AND (`b`.name LIKE '%$key%')";
			}
			//SORT SELECTBOX STATUS
			if(isset($arrParam['filter_state']) && $arrParam['filter_state'] != 2 ){
				$query[] = 'AND `b`.status = '.$arrParam['filter_state'].'';

			}

			//SORT SELECTBOX CATEGORY
			if(isset($arrParam['filter_category_id']) && $arrParam['filter_category_id'] != 'default' ){
				$query[] = 'AND `b`.category_id = '.$arrParam['filter_category_id'].'';

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
				$query[] = "AND (name LIKE '%$key%' )";
		
			}
			//SORT SELECTBOX STATUS
			if(isset($arrParam['filter_state']) && $arrParam['filter_state'] != 2 ){
				$query[] = 'AND status = '.$arrParam['filter_state'].'';

			}

			//SORT SELECTBOX CATEGORY
			if(isset($arrParam['filter_category_id']) && $arrParam['filter_category_id'] != 'default' ){
				$query[] = 'AND category_id = '.$arrParam['filter_category_id'].'';

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
				return array($id, $status, URL::creatLink('admin', 'book','ajaxStatus', array('id'=>$id, 'status'=>$status),'js'));				
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
		public function saveBook($arrParam){
			if(!empty($arrParam['form'])){
				$username = $_SESSION['user']['info']['username'];//tên hiển thị khi dc chỉnh sữa				
				unset($arrParam['form']['token']);
	


				//save image
				require_once(EXTENDS_PATH.'upload.php');
				$upload = new upload();
				$arrParam['form']['picture'] = $upload->uploadFile($arrParam['form']['picture'], 'book');
		
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
				//image remove
				$imageRemove = $arrParam['form']['picture_hidden'];

				unset($arrParam['form']['token']);
				unset($arrParam['form']['picture_hidden']);

				$username = $_SESSION['user']['info']['username'];//tên hiển thị khi dc chỉnh sữa
				if($arrParam['form']['picture']['name']==null){

					unset($arrParam['form']['picture']);
				}else{
					require_once(EXTENDS_PATH.'upload.php');
					$upload = new upload();
					$arrParam['form']['picture'] = $upload->uploadFile($arrParam['form']['picture'], 'book');
					$upload->removeFile('book',$imageRemove);

				}



				$arrParam['form']['modified'] = date('Y-m-d', time());
				$arrParam['form']['modified_by'] = $username;	 

				$query = 'UPDATE `'.$this->table.'` SET ';
				$query .= $this->creatUpdateSQL($arrParam['form']);	
				$query .= 'WHERE id='.$arrParam['id'].'';
		
				$this->query($query);
				SESSION::set('message', array('class'=>'success', 'content'=>'Cập nhật thành công !' ) );			
			}else{
				SESSION::set('message', array('class'=>'error', 'content'=>'Vui lòng chọn thành phần!' ) );
			}

		}	


		public function categorySelectbox($arrParam){
			$query = 'SELECT `id`, `name` FROM category';
			$listItem = $this->fetchPairs($query);
			$listItem['default'] = '-Select category-';
			ksort($listItem); //đảo ngươc chuỗi
			return $listItem;
		}


		public function infoItem($id){
			$query = 'SELECT * FROM `'.$this->table.'` WHERE id='.$id.'';
			return $listItem = $this->singleRecord($query);
		}

	}
 ?>