<?php 
	include 'dbConfig.php'; 
	
	$Email=$_REQUEST['Email'];
	$query = "SELECT * from adminUser where Email='".$Email."'"; 
	$result = mysqli_query($conn, $query) or die ( mysqli_error());
	$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | General Form Elements</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/ionicons.min.css">
  <link rel="stylesheet" href="css/AdminLTE.min.css">
  <link rel="stylesheet" href="css/_all-skins.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
      </ul>
    </section>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        ARC Member
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Member</h3>
            </div>
            <!-- /.box-header -->
			
			
			<?php
				$status = "";
				if(isset($_POST['new']) && $_POST['new']==1)
				{
				$firstName =$_REQUEST['firstName'];
				$lastName =$_REQUEST['lastName'];
				$password =$_REQUEST['password'];
				$IDNumber =$_REQUEST['IDNumber'];
				$Email =$_REQUEST['Email'];
				$Mobile =$_REQUEST['Mobile'];
				$oldEmail =$_REQUEST['oldEmail'];
				
				$submittedby = $_SESSION["Email"];
				
				$update="update adminUser set firstName='".$firstName."',
						lastName='".$lastName."', password='".$password."',
						IDNumber='".$IDNumber."', Email='".$Email."',
						Mobile='".$Mobile."' where Email='".$oldEmail."'";
				mysqli_query($conn, $update) or die(mysqli_error());
				
				$status = "Record Updated Successfully.";
				echo '<h1>'.$status.'</h1>';
				?>
				<a href="dashboard.php">Click Here Back</a>
				<?php 
				}else {
			?>
            <!-- form start -->
            <form class="form-horizontal" action = "" method="post">
              <div class="box-body">
				<input type="hidden" name="new" value="1" />
				<input type="hidden" name="oldEmail" value="<?php echo $row['Email'];?>" />
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">First Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="firstName" value="<?php echo $row['firstName'];?>">
					</div>
				</div>
				
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Last Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="lastName" value="<?php echo $row['lastName'];?>">
					</div>
				</div>
				
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Password</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="password" value="<?php echo $row['password'];?>">
					</div>
				</div>
				
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">ID Number</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="IDNumber" value="<?php echo $row['IDNumber'];?>">
					</div>
				</div>
			  
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Email</label>				  
                  <div class="col-sm-10">
                    <input type="email" class="form-control" name="Email" value="<?php echo $row['Email'];?>">
                  </div>
                </div>
				
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Mobile No</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="Mobile" value="<?php echo $row['Mobile'];?>">
					</div>
				</div>
				
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right">Edit</button>
              </div>
            </form>
			<?php } ?>
          </div>


              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<footer class="main-footer">
	<div class="pull-right hidden-xs">
	  <b>Thabo Chiloane</b>
	</div>
	<strong>Copyright &copy; 2018 All rights reserved.
</footer>

  <div class="control-sidebar-bg"></div>


<!-- jQuery 3 -->
<script src="js/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="js/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="js/demo.js"></script>
</body>
</html>
