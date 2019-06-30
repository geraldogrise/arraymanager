
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
                    <h1 class="page-header">Fill</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             User List
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
               <?php  $userList = $manager->fill($userList,5,6,$searchUser);?>
                <div class="row">
						<script type="syntaxhighlighter" class="brush: php;">
							<![CDATA[
								   $manager = new ArrayManager();
								   $searchUser = new User();
								   $searchUser->setId_user(2);
								   $searchUser->setName("Kelly");
								   $searchUser->setLastname("Carter");
								   $searchUser->setEmail("kellycarter@gmail.com");
								   $userList = $manager->fill($userList,5,6,$searchUser);
							]]>
						</script>   
				</div>	
   
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Fill List
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
	  changePage('lvl7');
  })
</script>
<?php include("../footer.php");?>
