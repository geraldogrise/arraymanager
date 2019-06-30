<?php 

 $dire = getcwd();
 $include_path =str_replace(basename(__DIR__),"",$dire);
 $include_path =str_replace("\\","/",$include_path);

 if(strpos($include_path,"views")>0){
   $include_path = explode("/views",$include_path)[0];
  $include_path =  $include_path."/";
 }



?>

