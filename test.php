<?php
include_once('include/db-connect.php');
$admin_no="JC1001";
$db->setFetchMode(DB_FETCHMODE_ORDERED);
$sql='select * from students where ad_no = ?';
$exe_query=& $db->query($sql, $admin_no);
$row=$exe_query->numRows();
if($row==1)
{
$data=& $exe_query->fetchRow();
$batch=$data[5];
$branch=$data[6];
echo $batch;
echo "<br/>";
echo $branch;
echo "<br/>";
$sql1='select btname from batches where btid = ?';
$exe_query1=& $db->query($sql1, $batch);
$row1=$exe_query1->numRows();
echo $row1;
echo "<br/>";
$sql2='select brname from branches where brid = ?';
$exe_query2=& $db->query($sql2, $branch);
$row2=$exe_query2->numRows();
echo $row2;
}
?>