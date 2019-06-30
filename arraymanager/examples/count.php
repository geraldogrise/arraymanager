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
  $aggList = $manager->count($departmentList,"name","age,salary");
?>

   <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Count</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                
				
				<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Department List
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                              <th>code</th>
											  <th>Department</th>
	                                          <th>Employee Name</th>
											  <th>Age</th>
	                                          <th>Salary</th>
	 
   
   
                                        </tr>
                                    </thead>
                                    <tbody>
									           <?php 
												foreach($departmentList as $value){
												?>
												 <tr class="odd gradeX">
													  <td><?=$value->getId_department()?></td>
													  <td><?=$value->getName()?></td>
													  <td><?=$value->getEmployeename()?></td>
													  <td><?=$value->getAge()?></td>
													   <td><?=$value->getSalary()?></td>
												   
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
				   $manager = new ArrayManager();
                   $aggList = $manager->count($departmentList,"name","age,salary");
                ]]>
				</script> 
               
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Count List
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                             <th>Department</th>
											  <th>Count</th>
											 
                                        </tr>
                                    </thead>
                                    <tbody>
									           <?php 
												foreach($aggList as $value){
												?>
												 <tr class="odd gradeX">
													  <td><?=$value["name"]?></td>
													  <td><?=$value["count_age"]?></td>
											
												   
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
	  changePage('lvl6');
  })
</script>

<?php include("../footer.php");?>
