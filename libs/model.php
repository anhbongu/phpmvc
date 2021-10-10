<?php 
	class Model{
		protected $connect;

		protected $database;
		protected $table;
		protected $resultquery;

	// CONNECT DATABASE
	public function __construct($params = null){
		if($params == null){
			$params['server']	= DB_HOST;
			$params['username']	= DB_USER;
			$params['password']	= DB_PASS;
			$params['database']	= DB_NAME;
			$params['table']	= DB_TABLE;
		}


		$conn = new mysqli($params['server'], $params['username'], $params['password'],$params['database']);
		$this->connect 	= $conn;
		$this->database = $params['database'];
		$this->table 	= $params['table'];
		$this->setDatabase();

		if ($conn->connect_error) {
		    die("Kết nối thất bại: " . $conn->connect_error);
		} 
		 

		 

		 

	}


		//set database
		public function setDatabase($database = null){
			if($database != null){
				$this->database = $database;
				mysqli_select_db($this->database, $this->connect);
			}
		}

		//set CONNECT
		public function setConnect($conn){
			$this->connect = $conn;
		}

		//set TABLE
		public function setTable($table){
			$this->table = $table;
		}




		//--------------------------------------------------------------------------INSERT
		//--------------------------------------------------------------------------INSERT
		//--------------------------------------------------------------------------INSERT
		public function insert($data, $type="single"){
			//insert 1 dòng dữ liệu
			if($type == 'single'){
				$newQuery = $this->creatInsertSQL($data);
				$query 	=	"INSERT INTO `$this->table` (".$newQuery['cols'].") 
     						VALUES (".$newQuery['vals'].")";
     	
     			// $this->query($query);
				// Thực hiện thêm record
				$this->query($query);
			}else{
				//insert nhiêu dòng dữ liệu
				foreach ($data as $value) {
					$newQuery = $this->creatInsertSQL($value);
					$query 	=	"INSERT INTO $this->table (".$newQuery['cols'].") 
	     						VALUES (".$newQuery['vals'].")";

	     			$this->query($query);
						
				}
			}
		}
		//câu lệnh insert SQL

		public function creatInsertSQL($data){
			$cols = '';
			$vals = '';
			$newQuery = array();
			if(!empty($data)){
				foreach ($data as $key => $value) {
					$cols .= ", `$key`";
					$vals .= ", '$value'";	

				}
			}

			$newQuery['cols'] = substr($cols, 2);
			$newQuery['vals'] = substr($vals, 2);

			return $newQuery;
		}





		//--------------------------------------------------------------------------UPDATE
		//--------------------------------------------------------------------------UPDATE
		//--------------------------------------------------------------------------UPDATE


		public function update($data, $where){
			$newSet = $this->creatUpdateSQL($data);
			$newWhere= $this->creatWhereUpdateSQL($where);
			echo $query 	=	"UPDATE $this->table SET $newSet WHERE $newWhere";
			$this->query($query);
			return $this->affectedRows();


		}
		//creat update
		public function creatUpdateSQL($data){
			$newSet = '';
			if(!empty($data)){
				foreach ($data as $key => $value) {
					$newSet .= ", `$key` = '$value'";
					

				}
			}

			return $newSet = substr($newSet, 2);
		}
		//where sql
		public function creatWhereUpdateSQL($where){
			$newWhere = array();
			if(!empty($where)){
				foreach ($where as $value) {
					$newWhere[] = "`$value[0]` = '$value[1]' ";
					$newWhere[] = " $value[2] ";

				}
				return $newWhere = implode("", $newWhere);
			}
			
			
		}

		//DELETE
		public function delete($data){
			$newid = $this->creatWhereDeleteSQL($data);
			echo $query = "DELETE FROM `$this->table` WHERE  id IN ($newid)";
			$this->query($query);
			return $this->affectedRows();
		}
		//creat delete
		public function creatWhereDeleteSQL($data){
			$newid = '';
			if(!empty($data)){
				// $this->print_z($data);
				foreach ($data as $id) {
					$newid .= "'".$id."',";
				}	
				$newid .= "'0'";
				return $newid;
			
			}

			
		}

		///-----------------------SELECT
		///-----------------------SELECT
		///-----------------------SELECT
		///-----------------------SELECT
		///-----------------------SELECT

		public function listRecord($query){
			$result = array();
			if(!empty($query)){
				$resultQuery = $this->query($query);
				if(mysqli_num_rows($resultQuery) > 0){
					while($row = mysqli_fetch_assoc($resultQuery)){
						$result[] = $row;
					}
					mysqli_free_result($resultQuery);
				}
			}
			return $result;
		}

		// SINGLE RECORD
		public function singleRecord($query){
			$result = array();
			if(!empty($query)){
				$resultQuery = $this->query($query);
				if(mysqli_num_rows($resultQuery) > 0){
					$result = mysqli_fetch_assoc($resultQuery);
				}
				mysqli_free_result($resultQuery);
			}
			return $result;
		}


		public function fetchPairs($query){
			$result = array();
			if(!empty($query)){
				$resultQuery = $this->query($query);
				if(mysqli_num_rows($resultQuery) > 0){
					while($row = mysqli_fetch_assoc($resultQuery)){
						$result[$row['id']] = $row['name'];
					}
					mysqli_free_result($resultQuery);
				}
			}
			return $result;
		}		

		//TỔNG SỐ DÒNG TRẢ VỀ
		public function TotalItem($query){

			if(!empty($query)){
				$resultQuery = $this->query($query);
				$total = mysqli_fetch_assoc($resultQuery);
				return $total['totalItem'];
			}
			// return $result;
		}




	
		// EXIST
		public function isExist($query){

			if($query != null) {
				$this->resultQuery = $this->query($query);
			}
			if(mysqli_num_rows($this->resultQuery ) > 0) return true;
			return false;
		}




















		//query
		public function query($query){
			return $this->resultquery = mysqli_query($this->connect, $query);
		}
		//affected row
		public function affectedRows(){
			return mysqli_affected_rows($this->connect);
		}

		public function lastId(){
			return mysqli_insert_id($this->connect);
		}

		public function print_z($data){
			echo '<pre>';
			echo print_r($data);
			echo '<pre>';
		}


	}
 ?>