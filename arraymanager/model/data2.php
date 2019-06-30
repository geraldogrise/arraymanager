<?php 
  require_once('path.php');
  include_once($include_path.'/model/User.php"');
  include_once($include_path.'/dao/genericDao.php"');
  $userList = array();
  $dao = new genericDao();
  $user = new User();
  $userList1 = $dao->executeQueryByString("select id_user,name,lastname,email from user where id_user < 5",$user);
  $userList2 = $dao->executeQueryByString("select id_user,name,lastname,email from user where id_user >= 5",$user);
  $userList3 = $dao->executeQueryByString("select id_user,name,lastname,email from user where id_user >= 3",$user);
 
?>