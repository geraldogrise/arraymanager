<?php



  class Connection{
 
 
    private $conexao = array("host"=>"localhost","login"=>"root","password"=>"","database"=>"test","type"=>"mysql");
	
	/*public connect(){
	   $connection = array("host"=>"localhost","login"=>"root","password"=>"","database"=>"grisecorp","type"=>"mysql");
	}*/
	public function getConexao(){
	
	   return $this->conexao;
	
	}
	public function setConexao($conexao){
	
	   $this->conexao = $conexao;
	
	}
	
	
	
 
 }

  
?>