<?php
include_once('include/db-connect.php');
include_once("functions.php");
admin_logincheck();
if(isset($_REQUEST['Id']))
{
$package_id=$_REQUEST['Id'];
//echo "$property_id";
$sql='delete from packages where sno = ?';
$data=$package_id;
$exe_query=& $db->query($sql, $data);
if($exe_query)
{
include("set-fee.php");
echo '<script> alert("Fee Deleted Successfully") </script>';
echo '<script language="JavaScript"> window.location.href ="set-fee.php" </script>';
}
}
?>