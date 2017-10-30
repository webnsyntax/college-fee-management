<?php
include_once('include/db-connect.php');
include_once("functions.php");
admin_logincheck();
$admin=$_SESSION['uname'];
$mobile=$_SESSION['mobile'];
if(isset($_POST['sub']) && $_POST['sub']=="Save")
{
$adno=mysql_real_escape_string(trim($_POST['adno']));
$ed_level=$_POST['ed_level'];
$branch=$_POST['branch'];
$year=$_POST['year'];
$ayear=$_POST['ayear'];
$tfee=$_POST['tfee'];
$cfee=mysql_real_escape_string(trim($_POST['cfee']));
$nfee=mysql_real_escape_string(trim($_POST['nfee']));
/*echo "$adno<br/>";
echo "$branch<br/>";
echo "$year<br/>";
echo "$tfee<br/>";
echo "$cfee<br/>";
echo "$nfee<br/>";*/
if($adno=="" || $ed_level=="" || $branch=="" || $year=="" || $ayear=="" || $tfee=="" || $cfee=="" || $nfee=="")
{
header('Location:add-concession.php');
}
else
{
$db->setFetchMode(DB_FETCHMODE_ORDERED);
$test_sql='select * from students where ad_no = ?';
$exe_test_query=& $db->query($test_sql, $adno);
$test_row=$exe_test_query->numRows();
$student_data=& $exe_test_query->fetchRow();
if($test_row==0 || $branch!=$student_data[7])
{
echo '<script> alert("Invalid Concession..") </script>';
}
else
{
$sql_search='select * from concessions where sid = ? and branch = ? and year = ?';
$search_fields=array($adno, $branch, $year);
$exe_search_query=& $db->query($sql_search, $search_fields);
$search_row=$exe_search_query->numRows();
if($search_row==1)
{
echo '<script> alert("Concession is already added for this student.") </script>';
}
else
{
$date=date('Y-m-d');
$posted_date=date('Y-m-d H:i:s');
$table_name='concessions';
$fields_values=array(
'sid' =>$adno,
'ed_level' =>$ed_level,
'branch' =>$branch,
'year' =>$year,
'ayear' =>$ayear,
'totalFee' =>$tfee,
'cFee' =>$cfee,
'nFee' =>$nfee,
'paid' =>'0',
'due' =>$nfee,
'posted_on' =>$posted_date,
'updated_on' =>$posted_date,
'date' =>$date
);
$exe_setconfee_query= $db->autoExecute($table_name, $fields_values, DB_AUTOQUERY_INSERT);
if($exe_setconfee_query)
{
echo '<script> alert("Concession Added Successfully") </script>';
}
}
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
if(document.getElementById('adno').value=="")
{
alert("Please Enter Admission Number");
document.getElementById('adno').focus();
return false;
}
if(document.getElementById('ed_level').value==1)
{
alert("Please Select Education Level");
return false;
}
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
if(document.getElementById('ayear').value==1)
{
alert("Please Select Academic Year");
return false;
}
if(document.getElementById('cfee').value=="")
{
alert("Please Enter Concession Fee");
document.getElementById('cfee').focus();
return false;
}
else if(!document.getElementById('cfee').value.match(con))
{
alert("Please Enter Valid Concession Fee");
document.getElementById('cfee').focus();
return false;
}
/*if(document.getElementById('tfee').value!="" && document.getElementById('cfee').value!="")
{
var cfee=document.getElementById('cfee').value;
var tfee=document.getElementById('tfee').value;
var nfee=document.getElementById('nfee').value=document.getElementById('tfee').value-document.getElementById('cfee').value;
alert("hai "+nfee);
}*/
}
function NetFee()
{
var tfee=document.getElementById('tfee').value;
var cfee=document.getElementById('cfee').value;
var nfee=document.getElementById('nfee').value=document.getElementById('tfee').value-document.getElementById('cfee').value;
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
function setOptions(chosen) {
var selbox = document.myform.year;
 
selbox.options.length = 0;
if (chosen == "1") {
  selbox.options[selbox.options.length] = new Option('--Select Year--','--Select Year--');
 
}
if (chosen == "Intermediate") {
  selbox.options[selbox.options.length] = new Option('--Select Year--','1');
  selbox.options[selbox.options.length] = new Option('I Year','I Year');
  selbox.options[selbox.options.length] = new Option('II Year','II Year');
}
if (chosen == "Degree") {
  selbox.options[selbox.options.length] = new Option('--Select Year--','1');
  selbox.options[selbox.options.length] = new Option('I Year','I Year');
  selbox.options[selbox.options.length] = new Option('II Year','II Year');
  selbox.options[selbox.options.length] = new Option('III Year','III Year');
}
}
function myFunction()
{
var branch=document.getElementById('branch').value;
var year=document.getElementById('year').value;
var queryString = "?branch=" + branch ;
 queryString +=  "&year=" + year;

if(window.Activexobject)
	{
	obj=new Activexobject("Microsoft.XMLHTTP");
	}
	else
	{
	obj=new XMLHttpRequest();
	}
	obj.open("GET", "get-fee.php" + queryString, true);
	obj.send();
	
	obj.onreadystatechange=function()
	{
	if(obj.readyState==4)
	{
	document.getElementById('vehno').innerHTML=obj.responseText;
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
	      <h2 class="pull-left">Add Concession</h2>

        <div class="clearfix"></div>
        
        <div class="clearfix"></div>

	    </div>
	    <!-- Page heading ends -->



	    <!-- Matter -->

	    <div class="matter">
        <div class="container">


			<div class="row">
            <div class="col-md-8">
			
			<div class="widget">
                
                <div class="widget-head">
                  <div class="pull-left">Add Concession</div>
                
                  <div class="clearfix"></div>
                </div>

                <div class="widget-content">
                  <div class="padd">

                   
                    <!-- Form starts.  -->
                     <form class="form-horizontal" name="myform" role="form" method="post" autocomplete="off" action="" onsubmit="return valid_details();">
                              
                                <div class="form-group">
                                  <label class="col-lg-2 control-label">Admission No</label>
                                  <div class="col-lg-8">
                                    <input type="text" class="form-control" name="adno" id="adno" placeholder="Admission No">
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-2 control-label">Education Level</label>
                                  <div class="col-lg-8">
                                    <select class="form-control" name="ed_level" id="ed_level" onchange="myBranches();setOptions(document.myform.ed_level.options[document.myform.ed_level.selectedIndex].value);">
                                      <option value="1">--Select--</option>
                                      <option value="Intermediate">Intermediate</option>
                                      <option value="Degree">Degree</option>
                                    </select>
                                  </div>
                                </div>
                              
                                <div class="form-group">
                                  <label class="col-lg-2 control-label">Branch</label>
                                  <div class="col-lg-8">
                                    <span id="branchname"></span> 
                                  </div>
                                </div>   

								<div class="form-group">
                                  <label class="col-lg-2 control-label">Year</label>
                                  <div class="col-lg-8">
                                    <select class="form-control" name="year" id="year" onchange="myFunction()">
                                      <option value="1">--Select Year--</option>
                                    </select>
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-2 control-label">Academic Year</label>
                                  <div class="col-lg-8">
                                    <?php
									$db->setFetchMode(DB_FETCHMODE_ORDERED);
									$sql_batches="select * from academicyears";
									$exe_batches_query=& $db->query($sql_batches);
									echo "<select class='form-control' name='ayear' id='ayear'>
									<option value='1'>--Select Academic Year--</option>";
									while($eyears=& $exe_batches_query->fetchRow())
									{
									?>
									<option value="<?php echo $eyears[2]?>"><?php echo $eyears[2]?></option>
									<?php
									}
									echo "</select>";
									?>
                                  </div>
                                </div>
								
								 <div class="form-group">
                                  <label class="col-lg-2 control-label">Total Fee</label>
                                  <div class="col-lg-8">
								   <span id="vehno"></span> 
                                    
                                  </div>
                                </div> 
								
								<div class="form-group">
                                  <label class="col-lg-2 control-label">Concession</label>
                                  <div class="col-lg-8">
                                    <input type="text" class="form-control" name="cfee" id="cfee" placeholder="Concession" onkeyup="NetFee()">
                                  </div>
                                </div> 

                                <div class="form-group">
                                  <label class="col-lg-2 control-label">Net Fee</label>
                                  <div class="col-lg-8">
                                    <input type="text" class="form-control" name="nfee" id="nfee" placeholder="Net Fee" readonly>
                                  </div>
                                </div> 
								
								

                                
                                <div class="form-group">
                                  <div class="col-lg-offset-2 col-lg-9">
                                    <input type="submit" class="btn btn-success" name="sub" value="Save">
                                  </div>
                                </div>
                              </form>
                  </div>
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