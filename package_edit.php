<?php
include_once('include/db-connect.php');
include_once("functions.php");
admin_logincheck();
$admin=$_SESSION['uname'];
$mobile=$_SESSION['mobile'];
if(isset($_REQUEST['Id']))
{
$package_id=$_REQUEST['Id'];
$db->setFetchMode(DB_FETCHMODE_ORDERED);
$sql='select * from packages where sno = ?';
$exe_query=& $db->query($sql, $package_id);
$row=$exe_query->numRows();
if($row==1)
{
$data=& $exe_query->fetchRow();

}
else
{
header('Location:set-fee.php');
}
}
else
{
header('Location:set-fee.php');
}
if(isset($_POST['sub']) && $_POST['sub']=="Update")
{
$branch=mysql_real_escape_string(trim($_POST['branch']));
$year=mysql_real_escape_string(trim($_POST['year']));
$fee=mysql_real_escape_string(trim($_POST['fee']));
$tfee=mysql_real_escape_string(trim($_POST['tfee']));
if($branch=='' || $year=='' || $fee=='' || $tfee=='')
{
header('Location:index.php');
}
else
{
$update_query="update packages set branch='$branch', year='$year', fee='$fee', tfee='$tfee' where sno='{$package_id}'";
$exe_update_query=& $db->query($update_query);
if($exe_update_query)
{
echo '<script> alert("Fee Details updated Successfully") </script>';
echo '<script language="JavaScript"> window.location.href ="set-fee.php" </script>';
}
}
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

<script type="text/javascript">
function valid_details()
{
var con=/^\d+$/;
if(document.getElementById('branch').value==1)
{
alert("Please Select Branch");
return false;
}
if(document.getElementById('year').value==1)
{
alert("Please Select Year");
return false;
}
if(document.getElementById('fee').value=="")
{
alert("Please Enter Fee");
document.getElementById('fee').focus();
return false;
}
else if(!document.getElementById('fee').value.match(con))
{
alert("Please Enter Valid Fee. Only Numeric Values are allowed");
document.getElementById('fee').focus();
return false;
}
if(document.getElementById('tfee').value=="")
{
alert("Please Enter Tuition Fee");
document.getElementById('tfee').focus();
return false;
}
else if(!document.getElementById('tfee').value.match(con))
{
alert("Please Enter Valid Tuition Fee. Only Numeric Values are allowed");
document.getElementById('tfee').focus();
return false;
}
}
	function delfile()
	{
	var yes=confirm("Are you sure want to delete this package ?");
	if(!yes)
	{
	return false;
	}
	else
	{
	window.location='package_delete.php';
	return true;
	}
	}
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
	      <h2 class="pull-left">Updating Fee Details</h2>

        <div class="clearfix"></div>
        <!-- Breadcrumb -->

        
        <div class="clearfix"></div>

	    </div>
	    <!-- Page heading ends -->



	    <!-- Matter -->

	    <div class="matter">
        <div class="container">


        <div class="row">

            <div class="col-md-6">


              <div class="widget">
                
                <div class="widget-head">
                  <div class="pull-left">Updating Fee Details</div>
                  <div class="clearfix"></div>
                </div>

                <div class="widget-content">
                  <div class="padd">

                    <!-- Form starts.  -->
                    <form class="form-horizontal" role="form" method="post" action="" onsubmit="return valid_details();">
                              
								
								<div class="form-group">
                                  <label class="col-lg-4 control-label">Branch</label>
                                  <div class="col-lg-8">
                                    <select class="form-control" name="branch" id="branch">
										<option value="1">--Select--</option>
										<?php
										$db->setFetchMode(DB_FETCHMODE_ORDERED);
										$sql_branches="select * from branches";
										$exe_branches_query=& $db->query($sql_branches);
										$branches=$exe_branches_query->numRows();
										while($ebranches=& $exe_branches_query->fetchRow())
										{
										?>
										<option value="<?php echo $ebranches[3]?>" <?php if($data['2']==$ebranches[3]){ ?> selected="selected" <?php } ?>><?php echo $ebranches[3]?></option>
										<?php
										}
										?>
                                    </select>
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-4 control-label">Year</label>
                                  <div class="col-lg-8">
                                    <select class="form-control" name="year" id="year">
                                      <option value="1">--Select--</option>
                                      <option value="I Year" <?php if($data[3]=="I Year") { ?> selected="selected" <?php }  ?>>I Year</option>
                                      <option value="II Year" <?php if($data[3]=="II Year") { ?> selected="selected" <?php }  ?>>II Year</option>
									  <option value="III Year" <?php if($data[3]=="III Year") { ?> selected="selected" <?php }  ?>>III Year</option>
                                    </select>
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-4 control-label">Admission Fee</label>
                                  <div class="col-lg-8">
                                    <input type="text" class="form-control" name="fee" id="fee" value="<?php echo $data[4];?>">
									in rupees
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-4 control-label">Tution Fee</label>
                                  <div class="col-lg-8">
                                    <input type="text" class="form-control" name="tfee" id="tfee" value="<?php echo $data[5];?>">
									in rupees
                                  </div>
                                </div>

                                <div class="form-group">
                                  <div class="col-lg-offset-6 col-lg-9">
                                    <input type="submit" class="btn btn-info" name="sub" value="Update">
                                  </div>
                                </div>
                    </form>
                  </div>
                </div>
              </div>
			  
			<div>
			
			
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