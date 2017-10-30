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
$test_sql='select * from students where ad_no = ?';
$exe_test_query=& $db->query($test_sql, $admin_no);
$test_row=$exe_test_query->numRows();
if($test_row==0)
{
header('Location:index.php');
}
else
{
$student_data=& $exe_test_query->fetchRow();
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
	      <h2 class="pull-left">Account Details</h2>

        <div class="clearfix"></div>
        
        <div class="clearfix"></div>

	    </div>
	    <!-- Page heading ends -->



	    <!-- Matter -->

	    <div class="matter">
        <div class="container">


            <div class="row">

            <div class="col-md-12">
      
			   <div class="widget">

                <div class="widget-head">
                  <div class="pull-left">Student Details</div>
                   
                  <div class="clearfix"></div>
                </div>

                  <div class="widget-content">

                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>Admission No</th>
                          <th>Name</th>
						  <th>Father Name</th>
						  <th>Phone</th>
                          <th>Branch</th>
                          <th>Batch</th>
                        </tr>
                      </thead>
                      <tbody>

                    <?php 
						echo "<tr>
                          <td>$student_data[1]</td>
                          <td>$student_data[4]</td>
                          <td>$student_data[5]</td>
                          <td>$student_data[8]</td>
						  <td>$student_data[7]</td>
                          <td>$student_data[6]</td>
                        </tr>";
					?>
	

                      </tbody>
                    </table>
					
                  </div>

                </div>
	  
				   <div class="widget">

                <div class="widget-head">
                  <div class="pull-left">Fee Details</div>
                   
                  <div class="clearfix"></div>
                </div>

                  <div class="widget-content">

                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>Year</th>
                          <th>Actual Fee</th>
						  <th>Concession Fee</th>
						  <th>Net Fee</th>
                          <th>Paid Amount</th>
                          <th>Due Amount</th>
                        </tr>
                      </thead>
					<?php
					$db->setFetchMode(DB_FETCHMODE_ORDERED);
					$fee_sql='select * from concessions where sid = ?';
					$exe_fee_query=& $db->query($fee_sql, $admin_no);
					$fee_row=$exe_fee_query->numRows();
					if($fee_row==0)
					{
					echo "<div class='alert alert-info'>
                      Concession Fee Not Added For This Student.
                    </div>";
					}
					else
					{
                    echo "<tbody>";
					while($concessions=& $exe_fee_query->fetchRow())
					{
                      echo "<tr>
                          <td>$concessions[4]</td>
                          <td>$concessions[6]</td>
                          <td>$concessions[7]</td>
                          <td>$concessions[8]</td>
						  <td>$concessions[9]</td>
                          <td>";
						  if($concessions[10]==0)
						  {
						  echo "<span class='label label-danger'>Total Paid</span>";
						  }
						  else
						  {
						  echo "$concessions[10]";
						  }
						  echo "</td>
                        </tr>";
					}
                    echo "</tbody>";
					}
					?>
                    </table>
					
                  </div>

                </div>
				<div class="col-md-6">
				<div class="widget">

                <div class="widget-head">
                  <div class="pull-left">Payment Details</div> 
                  <div class="clearfix"></div>
                </div>

                  <div class="widget-content">

                    <table class="table table-striped table-bordered table-hover">
						<thead>
                        <tr>
                          <th>Sl.No</th>
                          <th>Receipt Id</th>
						  <th>Paid Amount</th>
						  <th>Date</th>
                          <th>Invoice</th>
                        </tr>
						</thead>
						<?php
						$db->setFetchMode(DB_FETCHMODE_ORDERED);
						$pay_sql='select * from payments where sid = ?';
						$exe_pay_query=& $db->query($pay_sql, $admin_no);
						$pay_row=$exe_pay_query->numRows();
						if($pay_row==0)
						{
						echo "<div class='alert alert-success'>
						  Still Now This Student Not Paid Any Fee..
						</div>";
						}
						else
						{
						echo "<tbody>";
						$i=1;
						while($payments=& $exe_pay_query->fetchRow())
						{					
						echo "<tr>
                          <td>$i</td>
                          <td>$payments[1]</td>
						  <td>$payments[5]</td>
						  <td>$payments[6]</td>
                          <td>
						  <a href='invoice.php?Id=$payments[1]' target='_blank'><button class='btn btn-primary'>Generate Invoice</button></a>
                          </td>
						</tr>";
						$i++;
						}
						echo "</tbody>";
						}
						?>
                    </table>

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