<?php
include_once('include/db-connect.php');
include_once("functions.php");
admin_logincheck();
$admin=$_SESSION['uname'];
$mobile=$_SESSION['mobile'];
if(isset($_REQUEST['Id']))
{
$admin_no=$_REQUEST['Id'];
$db->setFetchMode(DB_FETCHMODE_ORDERED);
$sql='select * from students where ad_no = ?';
$exe_query=& $db->query($sql, $admin_no);
$row=$exe_query->numRows();
if($row==1)
{
$data=& $exe_query->fetchRow();
}
else
{
header('Location:index.php');
}
}
else
{
header('Location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <!-- Title and other stuffs -->
  <title>College - Admin Panel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">


  <!-- Stylesheets -->
  <link href="style/bootstrap.css" rel="stylesheet">
  <!-- Font awesome icon -->
  <link rel="stylesheet" href="style/font-awesome.css"> 
  <!-- jQuery UI -->
  <link rel="stylesheet" href="style/jquery-ui-1.9.2.custom.min.css"> 
  <!-- Calendar -->
  <link rel="stylesheet" href="style/fullcalendar.css">
  <!-- prettyPhoto -->
  <link rel="stylesheet" href="style/prettyPhoto.css">  
  <!-- Star rating -->
  <link rel="stylesheet" href="style/rateit.css">
  <!-- Date picker -->
  <link rel="stylesheet" href="style/bootstrap-datetimepicker.min.css">
  <!-- CLEditor -->
  <link rel="stylesheet" href="style/jquery.cleditor.css"> 
  <!-- Uniform -->
  <link rel="stylesheet" href="style/uniform.default.html"> 
  <!-- Uniform -->
  <link rel="stylesheet" href="style/daterangepicker-bs3.css" />
  <!-- Bootstrap toggle -->
  <link rel="stylesheet" href="style/bootstrap-switch.css">
  <!-- Main stylesheet -->
  <link href="style/style.css" rel="stylesheet">
  <!-- Widgets stylesheet -->
  <link href="style/widgets.css" rel="stylesheet">   
    <!-- Gritter Notifications stylesheet -->
  <link href="style/jquery.gritter.css" rel="stylesheet">   
  
  <!-- HTML5 Support for IE -->
  <!--[if lt IE 9]>
  <script src="js/html5shim.js"></script>
  <![endif]-->

<!------Date Picker---------->
	
	<link href="css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet">
	<script src="date_js/jquery-1.9.1.js"></script>
	<script src="date_js/jquery-ui-1.10.3.custom.js"></script>
	
	<script>
	$(function() {
    $( ".datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });
  });
	</script>

</head>

<body>
<header>
<div class="navbar navbar-fixed-top bs-docs-nav" role="banner">
  
    <div class="container">
      <!-- Menu button for smallar screens -->
      <div class="navbar-header">
		  <button class="navbar-toggle btn-navbar" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse"><span>Menu</span></button>
      <a href="#" class="pull-left menubutton hidden-xs"><i class="fa fa-bars"></i></a>
		  <!-- Site name for smallar screens -->
		  <a href="index.php" class="navbar-brand">Admin<span class="bold">Panel</span></a>
		</div>

      <!-- Navigation starts -->
      <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">         
        
        <!-- Links -->
        <ul class="nav navbar-nav pull-right">
          <li class="dropdown pull-right user-data">            
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <?php echo $admin; ?><b class="caret"></b>              
            </a>
            
            <!-- Dropdown menu -->
            <ul class="dropdown-menu">
			<li><a href="change-phone.php"><i class="fa fa-phone"></i>Change Phone</a></li>
			<li><a href="change-pass.php"><i class="fa fa-cogs"></i>Change Password</a></li>
              <li><a href="logout.php"><i class="fa fa-key"></i> Logout</a></li>
            </ul>
          </li>
            
        </ul>
      </nav>

    </div>
  </div>
</header>
<!-- Main content starts -->

<div class="content">

<?php
include_once('header.php');
?>

  	<!-- Main bar -->
  	<div class="mainbar">
      
	    <!-- Page heading -->
	    <div class="page-head">
	      <h2 class="pull-left">Student Details</h2>

        <div class="clearfix"></div>
        <!-- Breadcrumb -->
        
        <div class="clearfix"></div>

	    </div>
	    <!-- Page heading ends -->



	    <!-- Matter -->

	    <div class="matter">
        <div class="container">


            <div class="col-md-8">


              <div class="widget">
                
                <div class="widget-head">
                  <div class="pull-left">Student Details</div>
                  <div class="clearfix"></div>
                </div>

                <div class="widget-content">
                  <div class="padd">

                    <!-- Form starts.  -->
                     <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" >
                              
                                <div class="form-group">
                                  <label class="col-lg-4 control-label">Admission Number</label>
                                  <div class="col-lg-8">
                                   <input type="text" class="form-control" name="adno" id="adno" value="<?php echo $data[1];?>" readonly >
								  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-4 control-label">Student Name</label>
                                  <div class="col-lg-8">
                                    <input type="text" class="form-control" name="sname" id="sname" value="<?php echo $data[3];?>" readonly>
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-4 control-label">Father Name</label>
                                  <div class="col-lg-8">
                                    <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $data[4];?>" readonly>
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-4 control-label">Mother Name</label>
                                  <div class="col-lg-8">
                                    <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $data[14];?>" readonly>
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-4 control-label">Date Of Birth</label>
                                  <div class="col-lg-8">
                                    <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $data[15];?>" readonly>
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-4 control-label">Caste</label>
                                  <div class="col-lg-8">
                                    <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $data[16];?>" readonly>
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-4 control-label">Sub Caste</label>
                                  <div class="col-lg-8">
                                    <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $data[17];?>" readonly>
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-4 control-label">Aadhar Card No</label>
                                  <div class="col-lg-8">
                                    <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $data[18];?>" readonly>
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-4 control-label">Education Level</label>
                                  <div class="col-lg-8">
                                    <input type="text" class="form-control" value="<?php echo $data[5];?>" readonly>
                                  </div>
                                </div> 
								
								<div class="form-group">
                                  <label class="col-lg-4 control-label">Branch</label>
                                  <div class="col-lg-8">
									<input type="text" class="form-control" value="<?php echo $data[7];?>" readonly>
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-4 control-label">Duration/Batch</label>
                                  <div class="col-lg-8">
                                    <input type="text" class="form-control" value="<?php echo $data[6];?>" readonly>
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-4 control-label">Phone Number 1</label>
                                  <div class="col-lg-8">
                                    <input type="text" class="form-control" name="phone1" id="phone1" value="<?php echo $data[8];?>" readonly>
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-4 control-label">Phone Number 2(Optional)</label>
                                  <div class="col-lg-8">
                                    <input type="text" class="form-control" name="phone2" id="phone2" value="<?php echo $data[9];?>" readonly>
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                  <label class="col-lg-4 control-label">Address</label>
                                  <div class="col-lg-8">
                                    <textarea class="form-control" rows="3" name="address" id="address" readonly><?php echo $data[10];?></textarea>
                                  </div>
                                </div>

								<div class="form-group">
                                  <label class="col-lg-4 control-label">Photo</label>
                                  <div class="col-lg-8">
                                    <!-- <input type="file" class="form-control" name="photo" id="photo"> -->
									<div class="user-pic">

									<img src="<?php echo $data[11];?>" width="150" height="150" alt="" />
									</div>
                                  </div>
                                </div>								

                                <div class="form-group">
                                  <div class="col-lg-offset-6 col-lg-9">
                                    <?php
									echo "<a href='student-edit.php?Id=$admin_no'><input type='button' class='btn btn-info' value='Edit Details'></a>";
									?>
								  </div>
                                </div>
                              </form>
                  </div>
                </div>
              </div>  

            </div>


        </div>
		  </div>

		<!-- Matter ends -->

    </div>

   <!-- Mainbar ends -->
   <div class="clearfix"></div>

</div>
<!-- Content ends -->

<!-- Footer starts -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
            <!-- Copyright info -->
            <p class="copy">Copyright &copy; 2014 | <a href="#">IT GEEK HUB</a> </p>
      </div>
    </div>
  </div>
</footer> 	

<!-- Footer ends -->

<!-- Scroll to top -->
<span class="totop"><a href="#"><i class="fa fa-chevron-up"></i></a></span> 

<!-- JS -->
<script src="js/jquery.js"></script> <!-- jQuery -->
<script src="js/bootstrap.js"></script> <!-- Bootstrap -->
<script src="js/jquery-ui-1.9.2.custom.min.js"></script> <!-- jQuery UI -->
<script src="js/fullcalendar.min.js"></script> <!-- Full Google Calendar - Calendar -->
<script src="js/jquery.rateit.min.js"></script> <!-- RateIt - Star rating -->
<script src="js/jquery.prettyPhoto.js"></script> <!-- prettyPhoto -->

<!-- Morris JS -->
<script src="js/raphael-min.js"></script>
<script src="js/morris.min.js"></script>

<!-- jQuery Flot -->
<script src="js/excanvas.min.js"></script>
<script src="js/jquery.flot.js"></script>
<script src="js/jquery.flot.resize.js"></script>
<script src="js/jquery.flot.pie.js"></script>
<script src="js/jquery.flot.stack.js"></script>

<!-- jQuery Notification - Noty -->
<script src="js/jquery.noty.js"></script> <!-- jQuery Notify -->
<script src="js/themes/default.js"></script> <!-- jQuery Notify -->
<script src="js/layouts/bottom.js"></script> <!-- jQuery Notify -->
<script src="js/layouts/topRight.js"></script> <!-- jQuery Notify -->
<script src="js/layouts/top.js"></script> <!-- jQuery Notify -->
<!-- jQuery Notification ends -->

<!-- Daterangepicker -->
<script src="js/moment.min.js"></script>
<script src="js/daterangepicker.js"></script>

<script src="js/sparklines.js"></script> <!-- Sparklines -->
<!--  <script src="js/jquery.gritter.min.js"></script> jQuery Gritter -->
<script src="js/jquery.cleditor.min.js"></script> <!-- CLEditor -->
<script src="js/bootstrap-datetimepicker.min.js"></script> <!-- Date picker -->
<script src="js/jquery.uniform.min.html"></script> <!-- jQuery Uniform -->
<script src="js/jquery.slimscroll.min.js"></script> <!-- jQuery SlimScroll -->
<script src="js/bootstrap-switch.min.js"></script> <!-- Bootstrap Toggle -->
<script src="js/filter.js"></script> <!-- Filter for support page -->
<script src="js/custom.js"></script> <!-- Custom codes -->
<script src="js/charts.js"></script> <!-- Charts & Graphs -->

<script src="js/index.js"></script> <!-- Index Javascripts -->
</body>
</html>