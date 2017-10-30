<?php
include_once('include/db-connect.php');
include_once("functions.php");
admin_logincheck();
if(isset($_REQUEST['Id']))
{
$branch_id=$_REQUEST['Id'];
//echo "$property_id";
$sql='delete from branches where brid = ?';
$data=$branch_id;
$exe_query=& $db->query($sql, $data);
if($exe_query)
{
include("add-branch.php");
echo '<script> alert("Branch Deleted Successfully") </script>';
echo '<script language="JavaScript"> window.location.href ="add-branch.php" </script>';
}
}
?>