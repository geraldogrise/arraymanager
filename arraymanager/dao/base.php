<?php
  
class base{

	
	private $keyArray  = array();
	private $keyGenerator  = array();
	private $paginator = "";
	private $orderby = "";

	public function getKeyArray(){
	   return $this->keyArray;
	}
    public function setKeyArray($keyArray){
		$this->keyArray = $keyArray;
	}
	
	public function getKeyGenerator(){
	   return $this->keyGenerator;
	}
	public function setKeyGenerator($keyGenerator){
	   $this->keyGenerator = $keyGenerator;
    }
	public function getPaginator(){
	    $this->paginator;
	}
	public function setPaginator($inicio,$total){
	    $this->paginator = $inicio.",".$total;
	}
	public function getOrderby(){
	    $this->orderby;
	}
	public function setOrderby($orderby){
       $this->orderby = $orderby;;
	}
	
	 public function buildSelect($object,$accept="key"){
	   $separator="";
	   $class_name = get_class($object);
	   $ref_class = new ReflectionClass($class_name);
	   $fields = "";
	   $query ="";
	   $order = $this->getOrderby();
	   if($this->paginator == ""){
	      $this->paginator="0,100000";
	   }
	   foreach($ref_class->getProperties() as $propriedade)
	   {
		   $fields .= $separator."". $propriedade->getName();
		   $separator=",";
	   }
	   $class_name = strtolower($class_name);
	   $criteria = $this->getCriteria($object,$accept);
	   $query = "SELECT {$fields} FROM {$class_name} WHERE 1 = 1 {$criteria} limit {$this->paginator} {$order}" ;
	   return $query;
	}
	
	public function buildDelete($object,$accept="key"){
	   $separator="";
	   $class_name = get_class($object);
	   $ref_class = new ReflectionClass($class_name);
	   $fields = "";
	   $query ="";
	   $criteria = $this->getCriteria($object,$accept);
	   $class_name = strtolower($class_name);
	   $query = "DELETE FROM  {$class_name} WHERE 1 = 1 {$criteria}";
	   return $query;
	}
	
	public function buildInsert($object){
	   $separator="";
	   $class_name = strtolower(get_class($object));
	   $ref_class = new ReflectionClass($class_name);
	   $fields = "";
	   $values = "";
	   $query ="";
       $myObject = new $class_name();
	  foreach($ref_class->getProperties() as $propriedade){
	      if($this->is_key($propriedade->getName()) && $this->is_keyGenerator($propriedade->getName())){
			    $values .=$separator. "null";
		  }
		   else{
		    $values .= $separator."". $this->getObjectValue($object,$propriedade);	
		  }
		  $fields .= $separator."".$propriedade->getName();
		  $separator=",";
	  }
	  $query = "INSERT INTO {$class_name} ({$fields}) VALUES ({$values});";
	  return $query;
	}

	
	public function buildUpdate($object,$accept="key"){
	   $separator="";
	   $class_name = get_class($object);
	   $ref_class = new ReflectionClass($class_name);
	   $fields = "";
	   $query ="";
	  $class_name = strtolower($class_name);
	   foreach($ref_class->getProperties() as $propriedade)
	   {
		  if($this->checkProperty($object,$propriedade) && !$this->is_key($propriedade->getName())){
			   $fields .= "{$separator}{$propriedade->getName()} = {$this->getObjectValue($object,$propriedade)}";
			   $separator=",";
		   }
	   }
	  
	   $criteria = $this->getCriteria($object,$accept);
	   $query = "UPDATE {$class_name} SET {$fields} WHERE 1 = 1 {$criteria}" ;
	   return $query;
	}
	
	function buildMaxId($object,$prop){
	    
		 $class_name = get_class($object);
		 $class_name = strtolower($class_name);
	      $query = "SELECT MAX({$prop}) from {$class_name}" ;
		  return $query;
	}
	
	/*function getValue($object,$prop){
	
	    $class_name = get_class($object);
		$value = "null";
		$reflectionClass = new ReflectionClass($class_name);
		$reflectionProperty = $reflectionClass->getProperty($prop);
		$reflectionProperty->setAccessible(true);
		if(!is_null($reflectionProperty->getValue($object))){
		    $value = $reflectionProperty->getValue($object);
			// $value = $this->setString($value);
		}
		return $value;
	}*/
	function getCriteria($object,$accept){
	   $criteria ="";
	   $class_name = get_class($object);
	   $ref_class = new ReflectionClass($class_name);
	   $separator = "and";
	   foreach($ref_class->getProperties() as $propriedade)
	   {
		    if($accept == "key"){
			   if($this->checkProperty($object,$propriedade) && $this->is_key($propriedade->getName())){
				     $value = $this->getObjectValue($object,$propriedade);
					 $criteria .= " {$separator} {$propriedade->getName()} = {$value}";
					 $separator="and";
			   }
		   }
		   else if($accept == "all"){
		       if($this->checkProperty($object,$propriedade) ){
				   $value = $this->getObjectValue($object,$propriedade);
				   $criteria .= " {$separator} {$propriedade->getName()} = {$value}";
				   $separator="and";
			   }
		   }
	   }
	   return $criteria;
	
	}
	public function checkProperty($object,$prop){
	    $value = $this->getObjectValue($object,$prop);
		
		if($value == "null"){
		   return 0;
		}
		else{
		  return 1;
		}
	}
	function setString($value){
	    if(is_numeric($value)){
		   $value = "{$value}";
		}
	  	 else if(is_string($value) && $value !="null"){
		    $value = "'{$value}'";
		 } 
		 return $value;
	}
	
	function is_key($prop){
	    $array_set = $this->getKeyArray();
		if(in_array(strtolower($prop), $array_set)){
		   return 1;
		}
		else{
		  return 0;
		}
	}
	
	function is_keyGenerator($prop){
	   	$array_set = $this->getKeyGenerator();
		if(in_array(strtolower($prop), $array_set)){
		   return 1;
		}
		else{
		  return 0;
		}
	}
	function formatarData($data){
	    $amd = explode("/",$data);
		if( strpos($data,"/")>0){
		    $ano = $amd[2];
			$mes = $amd[1];
			$dia = $amd[0];
		    $data = $ano."-".$mes."-".$dia;
		}
	    return $data;
	}
	function fillList($list,$obj){
	    $class_name = get_class($obj);
		$ref_class = new ReflectionClass($class_name);
	    $myReturnList = array();
		while($row = $list->fetch_array()){
	           $myObject = new $class_name();
			   foreach($ref_class->getProperties() as $propriedade)
	           {
			       $value = $row[$propriedade->getName()];
				   $fieldSet = "set" .ucfirst($propriedade->getName());
				   $reflectionMethod = new ReflectionMethod($class_name, $fieldSet);
				   $reflectionMethod->invokeArgs( $myObject ,[$value] );
			    }
				 array_push($myReturnList,$myObject);
		   }
	     return $myReturnList;
	}
	function fillArray($list,$obj){
	    $class_name = get_class($obj);
		$ref_class = new ReflectionClass($class_name);
	    $myReturnList = array();
		foreach($list as $row){
	           $myInternalArray = array();
			   foreach($ref_class->getProperties() as $propriedade)
	           {
			       $fieldSet = "get" .ucfirst($propriedade->getName());
				   $reflectionMethod = new ReflectionMethod($class_name, $fieldSet);
				   $value = $reflectionMethod->invokeArgs( $row ,[] );
				   $myInternalArray[$propriedade->getName()] = $value;
			    }
				 array_push($myReturnList,$myInternalArray);
		   }
	     return $myReturnList;
	}
	function getObjectValue($myObject,$propriedade){
	    $class_name = strtolower(get_class($myObject));
		$getMethod = "get" .ucfirst($propriedade->getName());
		$reflectionMethod = new ReflectionMethod($class_name, $getMethod);
		$value =  $reflectionMethod->invokeArgs( $myObject , array() );
		$value = $value == null?"null":$this->setString($value);
		return $value ;
	}
	
	

	
	
	
}

?>




