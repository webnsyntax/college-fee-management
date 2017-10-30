<?php
include_once('include/db-connect.php');
include_once("functions.php");
admin_logincheck();
$admin=$_SESSION['uname'];
$mobile=$_SESSION['mobile'];

$edlevel=$_GET['edlevel'];
$db->setFetchMode(DB_FETCHMODE_ORDERED);
$sql_search='select * from branches where degree = ?';
$search_fields=array($edlevel);
$exe_search_query=& $db->query($sql_search, $search_fields);
$search_row=$exe_search_query->numRows();
/*if($search_row!=0)
{
//$data=& $exe_search_query->fetchRow();
//echo $data[3];
while($ebranches=& $exe_search_query->fetchRow())
{
?>
<option value="<?php echo $ebranches[3]?>"><?php echo $ebranches[3]?></option>
<?php
}
}
else
{
echo "No Branches Added..";
}*/
echo "<select class='form-control' name='branch' id='branch'>
<option value='1'>--Select Branch--</option>";
while($ebranches=& $exe_search_query->fetchRow())
{
?>
<option value="<?php echo $ebranches[3]?>"><?php echo $ebranches[3]?></option>
<?php
}
echo "</select>";
?>
