<?php
include_once('include/db-connect.php');
include_once("functions.php");
admin_logincheck();
if(isset($_REQUEST['Id']))
{
$batch_id=$_REQUEST['Id'];
//echo "$property_id";
$sql='delete from batches where btid = ?';
$data=$batch_id;
$exe_query=& $db->query($sql, $data);
if($exe_query)
{
include("add-batch.php");
echo '<script> alert("Batch Deleted Successfully") </script>';
echo '<script language="JavaScript"> window.location.href ="add-batch.php" </script>';
}
}
?>