<?php
  require_once('path.php');
  include_once($include_path.'/dao/base.php');
  class Department extends base{
     private $id_department;
	 private $name;
	 private $employeeName;
	 private $salary;
	 private $age;
	 public function getId_department(){
	    return $this->id_department;
	 }
	 public function setId_department($id_department){
	   	$this->id_department = intval($id_department);
	 }
	 public function getName(){
	    return $this->name;
	 }
	 public function setName($name){
	     $this->name = $name;
	 }
	 public function getEmployeeName(){
	    return $this->employeeName;
	 }
	 public function setEmployeeName($employeeName){
	     $this->employeeName = utf8_encode($employeeName);
	 }
	 public function getSalary(){
	    return $this->salary;
	 }
	 public function setSalary($salary){
	   	 $this->salary = $salary;
	 }
	  public function getAge(){
	    return $this->age;
	 }
	 public function setAge($age){
	   	 $this->age = intval($age);
	 }
	 public static function Equals($department1,$department2){
	    if ($department1->getId_department() === $department2->getId_department()) return 0;
        return ($department1->getId_department() > $department2->getId_department())? 1:-1;
	 }
	 function __toString()
     {
        return $this->name;
     }
}
?>