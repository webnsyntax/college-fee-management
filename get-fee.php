<?php
include_once('include/db-connect.php');
include_once("functions.php");
admin_logincheck();
$admin=$_SESSION['uname'];
$mobile=$_SESSION['mobile'];

$branch=$_GET['branch'];
$year=$_GET['year'];
$db->setFetchMode(DB_FETCHMODE_ORDERED);
$sql_search='select * from packages where branch = ? and year = ?';
$search_fields=array($branch, $year);
$exe_search_query=& $db->query($sql_search, $search_fields);
$search_row=$exe_search_query->numRows();
if($search_row==1)
{
$data=& $exe_search_query->fetchRow();
$total_fee=$data[4]+$data[5];
//echo $data[3];
echo "<input type='text' class='form-control' id='tfee' name='tfee' value='$total_fee' readonly>";
}
else
{
echo "Fee Not Set..";
}
?>
