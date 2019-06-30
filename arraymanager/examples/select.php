
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
  $searchList = $manager->select($userList,"name,email");
?>

   <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Select</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			 <div class="row">
                
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            User List
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
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
												 <tr>
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
                   
                    <!-- /.panel -->
                </div>
				</div>
                 <div class="row">
						<script type="syntaxhighlighter" class="brush: php;">
							<![CDATA[
								   $manager = new ArrayManager();
                                   $searchList = $manager->select($userList,"name,email");
							]]>
						</script>   
				</div>	
				<div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Select List
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                         <tr>
                                              
											  <th>Name</th>
	                                          <th>Email</th>
	 
                                        </tr>
                                    </thead>
                                    <tbody>
                                               <?php 
												  foreach($searchList as $value){
												?>
												 <tr>
													   <td><?=$value->getName()?></td>
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
                <!-- /.col-lg-6 -->
            </div>
<script>
  $(function(){
	  changePage('lvl4');
  })
</script>
            <!-- /.row -->
          <?php include("../footer.php");?>
           

