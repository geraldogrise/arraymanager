<?php
  require_once('path.php');
  include_once($include_path.'/dao/base.php');
  class User extends base{
     private $id_user;
	 private $name;
	 private $lastname;
	 private $email;
	 public function getId_user(){
	    return $this->id_user;
	 }
	 public function setId_user($id_user){
	   	$this->id_user = intval($id_user);
	 }
	 public function getName(){
	    return $this->name;
	 }
	 public function setName($name){
	     $this->name = $name;
	 }
	 public function getLastname(){
	    return $this->lastname;
	 }
	 public function setLastname($lastname){
	     $this->lastname = utf8_encode($lastname);
	 }
	 public function getEmail(){
	    return $this->email;
	 }
	 public function setEmail($email){
	   	 $this->email = $email;
	 }
	 public static function Equals($user1,$user2){
	    if ($user1->getId_user() === $user2->getId_user()) return 0;
        return ($user1->getId_user() > $user2->getId_user())? 1:-1;
	 }
	 function __toString()
     {
        return $this->name;
     }
}
?>