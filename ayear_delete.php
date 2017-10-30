<?php
include_once('include/db-connect.php');
include_once("functions.php");
admin_logincheck();
if(isset($_REQUEST['Id']))
{
$ayear_id=$_REQUEST['Id'];
//echo "$property_id";
$sql='delete from academicyears where ayear_id = ?';
$data=$ayear_id;
$exe_query=& $db->query($sql, $data);
if($exe_query)
{
include("add-academic.php");
echo '<script> alert("Academic Year Deleted Successfully") </script>';
echo '<script language="JavaScript"> window.location.href ="add-academic.php" </script>';
}
}
?>