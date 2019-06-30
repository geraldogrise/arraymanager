
<?php
  include("connection.php");
 
   class genericDao{
    private $type;
	private $connect;
   	public function openConnect(){
	        $con = new Connection();
		    $this->setConnect($con->getConexao());	
			$array_connection = $con->getConexao();
			//array("host"=>$host,"login"=>$login,"password"=>$password,"database"=>$database,"type"=>$type);
     		$username_config =$array_connection["login"];
            $password_config = $array_connection["password"];
            $database_config = $array_connection["database"];
            $hostname_config = $array_connection["host"];
            $this->setType($array_connection["type"]);  			
            if($this->getType() == "mysql"){
  		       $conn = mysqli_connect("$hostname_config", "$username_config", "$password_config","$database_config") or die("Error " . mysqli_error($conn));
			}
           
		    return $conn;
	 }   
     public function closeConnect($conn){
	    if($this->getType() == "mysql"){
		   $conn->close();
		}
	 }

     public function commit($conn){
	    if($this->getType() == "mysql"){
		   $conn->commit();
		}
	  }
	   
	 public function autocommit($conn,$flag){
	    if($this->getType() == "mysql"){
		   $conn->autocommit(FALSE);
		}
	 }
	 public function rollback($conn){
	    if($this->getType() == "mysql"){
		   $conn->rollback();
		}
	 }	  	   
	   
     public function getType(){
		return $this->type;
    }
     public function setType($type){
	    $this->type  = $type;
  	 }	 	

     public function getConnect(){
	    return $this->connect;
	}
     public function setConnect($connect){
	    $this->connect  = $connect;
  	 }	 	 	 

     public function executeQuery($conn,$query){
	    if($this->getType() == "mysql"){	     
		     $result = $conn->query($query);
		}
		return $result;
	 }
	 
	  public function insert($object){
		    try{		 
            	 $this->setKeys($object);
				 $this->setGenerateKeys($object);
				 $query = $object->buildInsert($object);
				 $conn = $this->openConnect();
				 $this->autocommit($conn,false);
				 $result = $this->executeQuery($conn,$query);
				 $result =  mysqli_insert_id($conn);
				 $this->commit($conn);
				 return $result;
			  } 
			  catch (Exception $e) {
			     throw new Exception($e->getMessage());
			  }
		
		}
		public function insertBatch($objectBatch){
		  
		  try{		 
              foreach ($objectBatch as $object) {
					 $this->setKeys($object);
					 $this->setGenerateKeys($object);
					 $query = $object->buildInsert($object);
   				     $conn = $this->openConnect();
					 $this->autocommit($conn,false);
					 $result = $this->executeQuery($conn,$query);
					 if (!empty($object->getKeyGenerator())){
						$resultset = $this->executeQuery($conn,$object->buildMaxId($object, $object->getKeyGenerator()[0]));
						while ($row = $resultset->fetch_array()){
						   $result = $row[0]; 
						}
					 }
					 $this->commit($conn);
				 }
				 return $result;
			  } 
			  catch (Exception $e) {
			     throw new Exception($e->getMessage());
			  }
		
		}
		
		public function update($object,$accept="key"){
		    try{
				 $this->setKeys($object);
				 $query = $object->buildUpdate($object);
				 $conn = $this->openConnect();
				 $this->autocommit($conn,false);
				 $result = $this->executeQuery($conn,$query);
				 $this->commit($conn);
				 return $result;
			  } 
			 catch (Exception $e) {
			     throw new Exception($e->getMessage());
			  }
		
		}
		public function updateBatch($objectBatch,$accept="all"){
		     try{
				  foreach ($objectBatch as $object) {
					 $this->setKeys($object);
					 $query = $object->buildUpdate($object,$accept);
					 $conn = $this->openConnect();
					 $this->autocommit($conn,false);
					 $result = $this->executeQuery($conn,$query);
					 $this->commit($conn);
			      }
				  return $result;
			  } 
			 catch (Exception $e) {
			     throw new Exception($e->getMessage());
			  }
		}
		
		public function delete($object,$accept="key"){
	        try{			
				 $this->setKeys($object);
				 $query = $object->buildDelete($object);
				 $conn = $this->openConnect();
				 $this->autocommit($conn,false);
				 $result = $this->executeQuery($conn,$query);
				 $this->commit($conn);
				 return $result;
			 } 
			 catch (Exception $e) {
			     throw new Exception($e->getMessage());
			  }
		}
		public function deleteBatch($objectBatch,$accept="all"){
		     try{	
				 foreach ($objectBatch as $object) {		   
					 $this->setKeys($object);
					 $query = $object->buildDelete($object,$accept);
					 $conn = $this->openConnect();
					 $this->autocommit($conn,false);
					 $result = $this->executeQuery($conn,$query);
					 $this->commit($conn);
					 
				 }
			     return $result;
			 } 
			 catch (Exception $e) {
			     throw new Exception($e->getMessage());
			  }
		
		}
		
		public function getAll($object,$accept="all"){
		  	try{
			     $this->setKeys($object);
				 $query = $object->buildSelect($object,$accept);
				 $conn = $this->openConnect();
				 $this->autocommit($conn,false);
				 $result = $this->executeQuery($conn,$query);
				 $lista = $object->fillList($result,$object);
				 $this->commit($conn);
				return $lista;
			 } 
			  catch (Exception $e) {
			     throw new Exception($e->getMessage());
			  }
		}
		
		public function get($object,$accept="all"){
		    try{			
				 $this->setKeys($object);
				 $query = $object->buildSelect($object,$accept);
				 $conn = $this->openConnect();
				 $this->autocommit($conn,false);
				 $result = $this->executeQuery($conn,$query);
				 $lista = $object->fillList($result,$object);
				 $this->commit($conn);
			     return $lista;
		      } 
			 catch (Exception $e) {
			     throw new Exception($e->getMessage());
			  }
		}
		
		public function getById($object,$accept="key"){
		    try{
				 $this->setKeys($object);
				 $query = $object->buildSelect($object);
				 $conn = $this->openConnect();
				 $this->autocommit($conn,false);
				 $result = $this->executeQuery($conn,$query);
				 $lista = $object->fillList($result,$object);
				 $this->commit($conn);
			     return $lista;
			 } 
			catch (Exception $e) {
			     throw new Exception($e->getMessage());
			  }
		
		}
		public function executeQueryByString($query,$object){
	        try{
				 $this->setKeys($object);
				 $conn = $this->openConnect();
				 $this->autocommit($conn,false);
				 $result = $this->executeQuery($conn,$query);
				 $this->commit($conn);
				 $lista = $object->fillList($result,$object);
				 return $lista;
			 } 
			catch (Exception $e) {
			     throw new Exception($e->getMessage());
			  }
	 }
	 public function ConvertToArray($list,$obj){
	     return $obj->fillArray($list,$obj);
	 }
	 public function setKeys($object){
	     $class_name = strtolower(get_class($object));
		 $array_set = array();
		 if(!$this->startsWith($class_name, 'gridview')){
			 $query = "SHOW KEYS FROM {$class_name} WHERE Key_name = 'PRIMARY'";
			 $conn = $this->openConnect();
			 $this->autocommit($conn,false);
			 $result = $this->executeQuery($conn,$query);
			 $this->commit($conn);
			 while($row = $result->fetch_array()){
			   array_push($array_set,$row['Column_name']);
			 }
		     $object->setKeyArray($array_set);
		 }
		
		 
	 }
	  public function setGenerateKeys($object){
	     $con = new Connection();
		 $schema = $con->getConexao()["database"];
		 $class_name = strtolower(get_class($object));
		 $array_set = array();
		 $query = "SELECT column_name FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '{$class_name}' AND extra = 'auto_increment' and table_schema = '{$schema}'";
		 $conn = $this->openConnect();
		 $this->autocommit($conn,false);
		 $result = $this->executeQuery($conn,$query);
		 $this->commit($conn);
		 while($row = $result->fetch_array()){
		   array_push($array_set,$row['column_name']);
		 }
		 $object->setKeyGenerator($array_set);
	 }
	 function startsWith($class_name,$query){
	    return substr($class_name, 0, strlen($query)) === $query;
	 }

}

?>