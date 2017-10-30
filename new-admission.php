<?php
include_once('include/db-connect.php');
include_once("functions.php");
admin_logincheck();
$admin=$_SESSION['uname'];
$mobile=$_SESSION['mobile'];
if(isset($_POST['sub']) && $_POST['sub']=="Save")
{
$admin_no=$_POST['adno'];
$sname=mysql_real_escape_string(trim($_POST['sname']));
$fname=mysql_real_escape_string(trim($_POST['fname']));
$dob=$_POST['dob'];
$date=$_POST['date'];
$ed_level=$_POST['ed_level'];
$branch=$_POST['branch'];
$batch=$_POST['batch'];
$phone1=mysql_real_escape_string(trim($_POST['phone1']));
$phone2=mysql_real_escape_string(trim($_POST['phone2']));
if($phone2=="")
{
$op_no="Not Provided";
}
else
{
$op_no=$phone2;
}
$m_name=mysql_real_escape_string(trim($_POST['mname']));
if($m_name=="")
{
$mname="Not Provided";
}
else
{
$mname=$m_name;
}
$t_caste=mysql_real_escape_string(trim($_POST['caste']));
if($t_caste=="")
{
$caste="Not Provided";
}
else
{
$caste=$t_caste;
}
$t_subcaste=mysql_real_escape_string(trim($_POST['subcaste']));
if($t_subcaste=="")
{
$subcaste="Not Provided";
}
else
{
$subcaste=$t_subcaste;
}
$t_adar=mysql_real_escape_string(trim($_POST['adar']));
if($t_adar=="")
{
$adar="Not Provided";
}
else
{
$adar=$t_adar;
}
$address=mysql_real_escape_string(trim($_POST['address']));
$image_name=$_FILES['photo']['name'];
$image_tmp_path=$_FILES['photo']['tmp_name'];
$posted_date=date('Y-m-d H:i:s');
if($admin_no=="" || $sname=="" || $fname=="" || $dob=="" || $date=="" || $ed_level=="" || $branch=="" || $batch=="" || $phone1=="" || $address=="" || $image_name=="")
{
header('Location:index.php');
}
else
{
$db->setFetchMode(DB_FETCHMODE_ORDERED);
$phone_sql='select * from students where phone1 = ? and ed_level = ? and branch = ? and batch = ?';
$phone_fields=array($phone1, $ed_level, $branch, $batch);
$exe_phone_query=& $db->query($phone_sql, $phone_fields);
$phone_row=$exe_phone_query->numRows();
if($phone_row==1)
{
echo '<script> alert("Phone Number 1 You Entered Is Already Existing In Database..") </script>';
}
else
{
$new_path="students/".$admin_no.$image_name;
move_uploaded_file($image_tmp_path, $new_path);
$table_name='students';
		$fields_values=array(
		'ad_no' =>$admin_no,
		'ad_date' =>$date,
		'student_name' =>$sname,
		'father_name' =>$fname,
		'ed_level' =>$ed_level,
		'batch' =>$batch,
		'branch' =>$branch,
		'phone1' =>$phone1,
		'phone2' =>$op_no,
		'address' =>$address,
		'photo' =>$new_path,
		'insert_on' =>$posted_date,
		'update_on' =>$posted_date,
		'mother_name' =>$mname,
		'dob' =>$dob,
		'caste' =>$caste,
		'subcaste' =>$subcaste,
		'adar_no' =>$adar
		);
$exe_query= $db->autoExecute($table_name, $fields_values, DB_AUTOQUERY_INSERT);
if($exe_query)
{
echo '<script> alert("Student Added Successfully") </script>';
}
}
}
/*echo $admin_no;
echo "<br/>";
echo $sname;
echo "<br/>";
echo $fname;
echo "<br/>";
echo $date;
echo "<br/>";
echo $ed_level;
echo "<br/>";
echo $branch;
echo "<br/>";
echo $batch;
echo "<br/>";
echo $phone1;
echo "<br/>";
echo $address;
echo "<br/>";
echo $image_name;*/
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
  
    $(function() {
    $( "#datepicker" ).datepicker({
	
	dateFormat: "yy-mm-dd",
      changeMonth: true,
      changeYear: true,
	  yearRange: '1980:2020'
    });
  });
	</script>

<script type="text/javascript">
function valid_details()
{
var con=/^[789]\d{9}$/;
if(document.getElementById('sname').value=="")
{
alert("Please Enter Student Name");
document.getElementById('sname').focus();
return false;
}
if(document.getElementById('fname').value=="")
{
alert("Please Enter Father Name");
document.getElementById('fname').focus();
return false;
}
if(document.getElementById('datepicker').value=="")
{
alert("Please Select Date of Birth");
document.getElementById('datepicker').focus();
return false;
}
if(document.getElementById('date').value=="")
{
alert("Please Select Date");
document.getElementById('date').focus();
return false;
}
if(document.getElementById('ed_level').value==1)
{
alert("Please Select Education Level");
return false;
}
if(document.getElementById('batch').value==1)
{
alert("Please Select Batch");
return false;
}
if(document.getElementById('branch').value==1)
{
alert("Please Select Branch");
return false;
}
if(document.getElementById('phone1').value=="")
{
alert("Please Enter Phone Number 1");
document.getElementById('phone1').focus();
return false;
}
else if(!document.getElementById('phone1').value.match(con))
{
alert("Please Enter Valid 10 Digit Phone Number");
document.getElementById('phone1').focus();
return false;
}
if(document.getElementById('address').value=="")
{
alert("Please Enter Address");
document.getElementById('address').focus();
return false;
}
if(document.getElementById('photo').value=="")
{
alert("Please Upload A Photo");
return false;
}
}
function myBranches()
{
var edlevel=document.getElementById('ed_level').value;
var queryString1 = "?edlevel=" + edlevel ;

if(window.Activexobject)
	{
	obj=new Activexobject("Microsoft.XMLHTTP");
	}
	else
	{
	obj=new XMLHttpRequest();
	}
	obj.open("GET", "get-branches.php" + queryString1, true);
	obj.send();
	
	obj.onreadystatechange=function()
	{
	if(obj.readyState==4)
	{
	document.getElementById('branchname').innerHTML=obj.responseText;
	}
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
	      <h2 class="pull-left">New Admission</h2>

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
                  <div class="pull-left">Admission Form</div>
                  <div class="clearfix"></div>
                </div>

                <div class="widget-content">
                  <div class="padd">

                    <!-- Form starts.  -->
                     <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" action="" onsubmit="return valid_details();">
                              
                                <div class="form-group">
                                  <label class="col-lg-4 control-label">Admission Number</label>
                                  <div class="col-lg-8">
								<?php
								$db->setFetchMode(DB_FETCHMODE_ORDERED);
								$sql_id="select id from students order by id desc limit 1;";
								$exe_id_query=& $db->query($sql_id);
								$id_rows=$exe_id_query->numRows();
								if($id_rows==0)
								{
								$ad_no="JC1001";
								}
								else
								{
								$erows=& $exe_id_query->fetchRow();
								$new_row = $erows[0] + 1;
								//echo $new_row;
								$ad_no="JC".$new_row;
								}
								?>
                                   <input type="text" class="form-control" name="adno" id="adno" value="<?php echo $ad_no;?>" readonly >
								  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-4 control-label">Student Name</label>
                                  <div class="col-lg-8">
                                    <input type="text" class="form-control" name="sname" id="sname" placeholder="Student Name">
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-4 control-label">Father Name</label>
                                  <div class="col-lg-8">
                                    <input type="text" class="form-control" name="fname" id="fname" placeholder="Father Name">
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-4 control-label">Mother Name</label>
                                  <div class="col-lg-8">
                                    <input type="text" class="form-control" name="mname" placeholder="Mother Name">
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-4 control-label">Date Of Birth</label>
                                  <div class="col-lg-8">
                                    <input type="text" id="datepicker" name="dob" placeholder="DOB">
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-4 control-label">Caste</label>
                                  <div class="col-lg-8">
                                    <input type="text" class="form-control" name="caste" placeholder="Enter Caste">
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-4 control-label">Sub Caste</label>
                                  <div class="col-lg-8">
                                    <input type="text" class="form-control" name="subcaste" placeholder="Enter Sub Caste">
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-4 control-label">Aadhar Card No</label>
                                  <div class="col-lg-8">
                                    <input type="text" class="form-control" name="adar" placeholder="Enter Aadhar Card No">
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-4 control-label">Date Of Joining</label>
                                  <div class="col-lg-8">
                                    <input type="text" class="datepicker" id="date" name="date" placeholder="Date">
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-4 control-label">Education Level</label>
                                  <div class="col-lg-8">
                                    <select class="form-control" name="ed_level" id="ed_level" onchange="myBranches()">
                                      <option value="1">--Select--</option>
                                      <option value="Intermediate">Intermediate</option>
                                      <option value="Degree">Degree</option>
                                    </select>
                                  </div>
                                </div> 
								
								<div class="form-group">
                                  <label class="col-lg-4 control-label">Branch</label>
                                  <div class="col-lg-8">
								  <span id="branchname"></span>
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-4 control-label">Duration/Batch</label>
                                  <div class="col-lg-8">
                                    <select class="form-control" name="batch" id="batch">
										<option value="1">--Select--</option>
										<?php
										$db->setFetchMode(DB_FETCHMODE_ORDERED);
										$sql_batches="select * from batches";
										$exe_batches_query=& $db->query($sql_batches);
										$batches=$exe_batches_query->numRows();
										while($ebatches=& $exe_batches_query->fetchRow())
										{
										?>
										<option value="<?php echo $ebatches[2]?>"><?php echo $ebatches[2]?></option>
										<?php
										}
										?>                                     
                                    </select>
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-4 control-label">Phone Number 1</label>
                                  <div class="col-lg-8">
                                    <input type="text" class="form-control" name="phone1" id="phone1" placeholder="Phone Number 1">
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-4 control-label">Phone Number 2(Optional)</label>
                                  <div class="col-lg-8">
                                    <input type="text" class="form-control" name="phone2" id="phone2" placeholder="Phone Number 2 Optional">
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                  <label class="col-lg-4 control-label">Address</label>
                                  <div class="col-lg-8">
                                    <textarea class="form-control" rows="3" name="address" id="address" placeholder="Address"></textarea>
                                  </div>
                                </div>

								<div class="form-group">
                                  <label class="col-lg-4 control-label">Photo</label>
                                  <div class="col-lg-8">
                                    <input type="file" class="form-control" name="photo" id="photo">
                                  </div>
                                </div>								

                                <div class="form-group">
                                  <div class="col-lg-offset-6 col-lg-9">
                                    <input type="submit" class="btn btn-info" name="sub" value="Save">
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