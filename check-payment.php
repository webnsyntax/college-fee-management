<?php
include_once('include/db-connect.php');
include_once("functions.php");
admin_logincheck();
$admin=$_SESSION['uname'];
$mobile=$_SESSION['mobile'];
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

<script type="text/javascript">
function valid_details()
{
if(document.getElementById('fdate').value > document.getElementById('tdate').value)
{
alert("From Date Should Less Than Or Equal To Date");
return false;
}
if(document.getElementById('fdate').value=="" && document.getElementById('tdate').value!="")
{
alert("Please Select From Date");
document.getElementById('fdate').focus();
return false;
}
if(document.getElementById('fdate').value!="" && document.getElementById('tdate').value=="")
{
alert("Please Select To Date");
document.getElementById('tdate').focus();
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
	      <h2 class="pull-left">Check Payments</h2>

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
                  <div class="pull-left">Check Payments</div>
                  <div class="clearfix"></div>
                </div>

                <div class="widget-content">
                  <div class="padd">

                    <!-- Form starts.  -->
                     <form class="form-horizontal" name="myform" role="form" method="post" enctype="multipart/form-data" action="" onsubmit="return valid_details();">
                              
                               
								
								<div class="form-group">
                                  <label class="col-lg-4 control-label">From Date</label>
                                  <div class="col-lg-8">
                                    <input type="text" class="datepicker" id="fdate" name="fdate" placeholder="From Date">
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-4 control-label">To Date</label>
                                  <div class="col-lg-8">
                                    <input type="text" class="datepicker" id="tdate" name="tdate" placeholder="To Date">
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-4 control-label">Education Level</label>
                                  <div class="col-lg-4">
                                    <select class="form-control" name="ed_level" id="ed_level" onchange="myBranches();setOptions(document.myform.ed_level.options[document.myform.ed_level.selectedIndex].value);">
                                      <option value="1">--Select--</option>
                                      <option value="Intermediate">Intermediate</option>
                                      <option value="Degree">Degree</option>
                                    </select>
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-4 control-label">Branch</label>
                                  <div class="col-lg-4">
                                    <span id="branchname"></span>
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-4 control-label">Year</label>
                                  <div class="col-lg-4">
                                    <select class="form-control" name="year" id="year" onchange="myFunction()">
                                      <option value="1">--Select Year--</option>
                                    </select>
                                  </div>
                                </div>

								<div class="form-group">
                                  <label class="col-lg-4 control-label">Academic Year</label>
                                  <div class="col-lg-4">
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
                                  <div class="col-lg-offset-6 col-lg-9">
                                    <input type="submit" class="btn btn-info" name="sub" value="Search">
                                  </div>
                                </div>
                              </form>
                  </div>
                </div>
              </div>  

			<?php
			if(isset($_POST['sub']) && $_POST['sub']=="Search")
			{
			$fromdate=mysql_real_escape_string(trim($_POST['fdate']));
			if($fromdate=="")
			{
			$fdate="1";
			}
			else
			{
			$fdate=$fromdate;
			}
			$todate=mysql_real_escape_string(trim($_POST['tdate']));
			if($todate=="")
			{
			$tdate="1";
			}
			else
			{
			$tdate=$todate;
			}
			$edlevel=$_POST['ed_level'];
			if($edlevel==1)
			{
			$tbranch="1";
			}
			else
			{
			$tbranch=$_POST['branch'];
			}
			$tyear=$_POST['year'];
			$ayear=$_POST['ayear'];
			
			/*echo $fdate;
			echo "<br/>";
			echo $tdate;
			echo "<br/>";
			echo $edlevel;
			echo "<br/>";
			echo $tbranch;
			echo "<br/>";
			echo $tyear;
			echo "<br/>";
			echo $ayear;*/

			$db->setFetchMode(DB_FETCHMODE_ORDERED);
			if($fdate==1 && $tdate==1 && $edlevel==1 && $tbranch==1 && $tyear==1 && $ayear==1)
			{
			//$sql_search='select * from payments order by date desc';
			$sql_search='select * from payments where 1=1 order by date desc';
			$exe_search_query=& $db->query($sql_search);
			}
			else
			{	
			$sql_search="select * from payments where 1=1";
			
					if($fdate!=1 && $tdate!=1)
					{
					$sql_search.=" and date >= '$fdate' and date <= '$tdate'";
					}
					if($edlevel!=1)
					{
					$sql_search.=" and edlevel = '{$edlevel}'";
					}
					if($tbranch!=1)
					{
					$sql_search.=" and branch = '{$tbranch}'";
					}
					if($tyear!=1)
					{
					$sql_search.=" and year = '{$tyear}'";
					}
					if($ayear!=1)
					{
					$sql_search.=" and ayear = '{$ayear}'";
					}
					$sql_search.=" order by date desc";

					$exe_search_query=& $db->query($sql_search);
					
			}
					$search_row=$exe_search_query->numRows();
			  
			    echo "<div class='widget'>

                <div class='widget-head'>
                  <div class='pull-left'>Payment Details</div>
                   
                  <div class='clearfix'></div>
                </div>

                  <div class='widget-content'>

                    <table class='table table-striped table-bordered table-hover'>
                      <thead>
                        <tr>
                          <th>Sl.No</th>
                          <th>Admission No</th>
                          <th>Date</th>
                          <th>Amount Paid</th>
                          <th>Receipt Details</th>
                        </tr>
                      </thead>";
					if($search_row==0)
					{
					echo "<div class='alert alert-danger'>
                      No Payments Done As Per Your Search Criteria.
                    </div>";
					}
					else
					{
					 
                    echo "<tbody>";
					$i=1;
					$total=0;
					while($epayments=& $exe_search_query->fetchRow())
					{
                    echo "<tr>
                          <td>$i</td>
                          <td>$epayments[2]</td>
                          <td>$epayments[6]</td>
                          <td>$epayments[5]</td>
                          <td><a href='invoice.php?Id=$epayments[1]' target='_blank'><button class='btn btn-primary'>Click For Receipt</button></a></td>
                        </tr>";
					
					$total +=$epayments[5];
					$i++;
					}	
					echo "<tr>
						<td colspan='3' align='right'>Total Amount:</td>
						<td>$total<td>
						<td></td>
						</tr>
								
                    </tbody>";
					}
                    echo "</table>

                    

                  </div>
                </div>";
			
			}
			?> 
			  
			  
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