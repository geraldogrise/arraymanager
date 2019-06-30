

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
  shuffle($userList);
  $orderList = $manager->orderBy($userList,"id_user,name");
  $inverseList = $manager->inverse($orderList);
?>

   <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Inverse</h1>
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
				<div class="row">
						<script type="syntaxhighlighter" class="brush: php;">
							<![CDATA[
								  $manager = new ArrayManager();
								  shuffle($userList);
								  $orderList = $manager->orderBy($userList,"id_user,name");
								  $inverseList = $manager->inverse($orderList);
							]]>
						</script>   
				</div>	
               <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Inverse List
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
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
												  foreach($inverseList as $value){
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
                    </div>
                    <!-- /.panel -->
                
            </div>
            <!-- /.row -->
      </div>
</div>
<script>
  $(function(){
	  changePage('lvl5');
  })
</script>
 <?php include("../footer.php");?>
           