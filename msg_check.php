<?php
include_once('include/db-connect.php');
session_start();
$uid=$_SESSION['uid'];
$mobile=$_SESSION['mobile'];
//$admin=$_SESSION['uname'];
if(isset($_POST['sub']) && $_POST['sub']=='Submit')
{
$message=trim($_POST['msg']);
if($message=="")
{
unset($_SESSION['uname']);
session_destroy();
include("login.php");
echo '<script> alert("Invalid Authentication") </script>';
echo '<script language="JavaScript"> window.location.href ="login.php" </script>';
}
else
{
$db->setFetchMode(DB_FETCHMODE_ORDERED);
$sql='select * from admin where phone = ? and message = ?';
$data=array($mobile, $message);
$user_auth=& $db->query($sql, $data);
$rows=$user_auth->numRows();
$user_data=& $user_auth->fetchRow();
if($rows==1)
{
$_SESSION['uname']=$user_data[1];
$login_date=date('Y-m-d H:i:s');
$update_query="update admin set last_login='$login_date' where sno='{$uid}'";
$exe_query=& $db->query($update_query);
if($exe_query)
{
header('Location:index.php');
}
else
{
unset($_SESSION['uname']);
session_destroy();
include("login.php");
echo '<script> alert("Invalid Authentication") </script>';
echo '<script language="JavaScript"> window.location.href ="login.php" </script>';
}
}
else
{
unset($_SESSION['uname']);
session_destroy();
include("login.php");
echo '<script> alert("Invalid Authentication") </script>';
echo '<script language="JavaScript"> window.location.href ="login.php" </script>';
}
}
}
?>