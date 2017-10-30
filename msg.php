<?php
session_start();
$uid=$_SESSION['uid'];
//$admin=$_SESSION['uname'];
if($uid=='')
{
header('Location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <!-- Title and other stuffs -->
  <title>User - Authentication</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">

  <!-- Stylesheets -->
  <link href="style/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="style/font-awesome.css">
  <link href="style/style.css" rel="stylesheet">
  <link href="style/bootstrap-responsive.html" rel="stylesheet">
  
  <!-- HTML5 Support for IE -->
  <!--[if lt IE 9]>
  <script src="js/html5shim.js"></script>
  <![endif]-->

</head>

<body>

<!-- Form area -->
<div class="admin-form">
  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <!-- Widget starts -->
            <div class="widget">
              <!-- Widget head -->
              <div class="widget-head">
                <i class="icon-lock"></i>User Authentication
              </div>

              <div class="widget-content">
                <div class="padd">
                  <!-- Login form -->
                  <form class="form-horizontal" method="post" action='msg_check.php'>
                    <!-- Message -->
                    <div class="form-group">
                      <label class="control-label col-lg-6" for="inputEmail">Enter 8 Characters Code that sent to your mobile</label>
                      <div class="col-lg-6">
                        <input type="text" class="form-control" name="msg" id="msg" placeholder="Auth Code">
                      </div>
                    </div>

                        <div class="col-lg-5 col-lg-offset-4">
							<input type="submit" class="btn btn-danger" name="sub" value="Submit">
						</div>
                    <br />
                  </form>
				  
				</div>
                </div>
              
            </div>  
      </div>
    </div>
  </div> 
</div>
	
		

<!-- JS -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>