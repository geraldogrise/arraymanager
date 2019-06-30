<?php 
  require_once('path.php');
  include_once($include_path.'/model/User.php"');
  include_once($include_path.'/model/Department.php"');
  include_once($include_path.'/dao/genericDao.php"');
  $userList = array();
  $departmentList = array();
  $dao = new genericDao();
  $user = new User();
  $userList = $dao->getAll($user);
  $newUser = new User();
  $newUser->setId_user(10);
  $newUser->setName("Geraldo");
  $newUser->setLastname("Grise");
  $newUser->setEmail("geraldogrise@hotmail.com");

  $searchUser = new User();
  $searchUser->setId_user(2);
  $searchUser->setName("Kelly");
  $searchUser->setLastname("Carter");
  $searchUser->setEmail("kellycarter@gmail.com");
  $department = new Department();
  $departmentList = $dao->getAll($department);
?>