<?php include("../header.php");?>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">ArrayManager</a>
            </div>
            <!-- /.navbar-header -->

       <?php include("../menu.php");?>

<?php
  require_once("../ArrayManager.php");
  require_once("../model/data.php");
  $manager = new ArrayManager();
?>

   <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                
				
				<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Tables
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                              <th>Código</th>
											  <th>Name</th>
	                                          <th>last Name</th>
	                                          <th>Email</th>
	 
   
   
                                        </tr>
                                    </thead>
                                    <tbody>
									           <?php 
												foreach($userList as $value){
												?>
												 <tr class="odd gradeX">
													  <td><?=$value->getId_user()?></td>
													  <td><?=$value->getName()?></td>
													  <td><?=$value->getLastname()?></td>
													  <td><?=$value->getEmail()?></td>
												   
												  </tr>

												<?php 
												}
												?>
                                       
                                      
                                 
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
<?php  $userList = $manager->Add($userList,$newUser);?>
   <div class="row">
               <script type="syntaxhighlighter" class="brush: php;">
				<![CDATA[
				   $user = new User();
				   $userList = $dao->getAll($user);
				   $newUser = new User();
				   $newUser->setId_user(10);
				   $newUser->setName("Geraldo");
				   $newUser->setLastname("Grise");
				   $newUser->setEmail("geraldogrise@hotmail.com");
				   $userList = $manager->Add($userList,$newUser);
                ]]>
				</script> 
               
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Tables
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                              <th>Código</th>
											  <th>Name</th>
	                                          <th>last Name</th>
	                                          <th>Email</th>
	 
   
   
                                        </tr>
                                    </thead>
                                    <tbody>
									           <?php 
												foreach($userList as $value){
												?>
												 <tr class="odd gradeX">
													  <td><?=$value->getId_user()?></td>
													  <td><?=$value->getName()?></td>
													  <td><?=$value->getLastname()?></td>
													  <td><?=$value->getEmail()?></td>
												   
												  </tr>

												<?php 
												}
												?>
                                       
                                      
                                 
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
</div>
<script>
  $(function(){
	  changePage('lvl2');
  })
</script>

<?php include("../footer.php");?>