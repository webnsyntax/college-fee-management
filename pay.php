<?php
include_once('include/db-connect.php');
include_once("functions.php");
admin_logincheck();
$admin=$_SESSION['uname'];
$mobile_admin=$_SESSION['mobile'];
if(isset($_POST['sub']) && $_POST['sub']=="Pay")
{
$edlevel=$_POST['ed_level'];
$admission_no=$_POST['adno'];
$branch=$_POST['branch'];
$year=$_POST['year'];
$amount=mysql_real_escape_string(trim($_POST['amount']));
if($admission_no=="" || $branch=="" || $year=="" || $amount=="")
{
header('Location:index.php');
}
else
{
$adfee_sql='select * from packages where edlevel = ? and branch = ? and year = ?';
$adfee_fields=array($edlevel, $branch, $year);
$exe_adfee_query=& $db->query($adfee_sql, $adfee_fields);
$adfee=& $exe_adfee_query->fetchRow();
$admission_fee=$adfee[4];

$fee_check_sql='select * from concessions where sid = ? and branch = ? and year = ?';
$fee_check_fields=array($admission_no, $branch, $year);
$exe_feecheck_query=& $db->query($fee_check_sql, $fee_check_fields);
$feechek=& $exe_feecheck_query->fetchRow();
$ayear=$feechek[5];
$check_net=$feechek[8];
$check_paid=$feechek[9];
if($check_paid+$amount > $check_net)
{
echo '<script> alert("Invalid Payment..") </script>';
echo "<script language='JavaScript'> window.location.href ='get-details.php?Id=$admission_no' </script>";
}
else
{
$date=date('Y-m-d');
$posted_date=date('Y-m-d H:i:s');
$table_name='payments';
$fields_values=array(
'sid' =>$admission_no,
'branch' =>$branch,
'year' =>$year,
'amount' =>$amount,
'date' =>$date,
'pay_date' =>$posted_date,
'edlevel' =>$edlevel,
'ayear' =>$ayear
);
$exe_pay_query= $db->autoExecute($table_name, $fields_values, DB_AUTOQUERY_INSERT);
if($exe_pay_query)
{
$id=mysql_insert_id();
/*$receipt_id=array(
'rid' =>"RCID".$id
);
$exe_pay_query1= $db->autoExecute($table_name, $receipt_id, DB_AUTOQUERY_UPDATE, "sno='$id'");*/

$receipt_id="RCID".$id;
$update_rid="update payments set rid='$receipt_id' where sno='{$id}'";
$exe_pay_query1=& $db->query($update_rid);

$db->setFetchMode(DB_FETCHMODE_ORDERED);
$mobile_sql='select student_name, phone1 from students where ad_no = ?';
$exe_mobile_query=& $db->query($mobile_sql, $admission_no);
$mobile=& $exe_mobile_query->fetchRow();

$fee_sql='select * from concessions where sid = ? and branch = ? and year = ?';
$pay_fields=array($admission_no, $branch, $year);
$exe_fee_query=& $db->query($fee_sql, $pay_fields);
$fee=& $exe_fee_query->fetchRow();
$paid=$fee[9];
$due=$fee[10];

if($exe_pay_query1)
{
$new_paid=$paid+$amount;
$new_due=$due-$amount;

$update_query="update concessions set paid='$new_paid', due='$new_due', updated_on='$posted_date' where sid='{$admission_no}' and year='{$year}'";
$exe_update_query=& $db->query($update_query);
if($exe_update_query)
{
$number=urlencode($mobile[1]);
if($paid < $admission_fee)
{
$msg="Dear Parent, payment of Rs.$amount.(including admission fee with Re.Id:$receipt_id) was done for student $mobile[0] with Ad.No:$admission_no studying $branch in Jaagruthi College and your due amount is Rs.$new_due.";

}
else
{
$msg="Dear Parent, payment of Rs.$amount.(Re.Id:$receipt_id) was done for student $mobile[0] with Ad.No:$admission_no studying $branch in Jaagruthi College and your due amount is Rs.$new_due.";
}	
		$cSession = curl_init();
		curl_setopt($cSession,CURLOPT_URL,"http://alerts.kapsystem.com/web2sms.php?username=xxxx&password=xxxx&to=$number&sender=xxxx&message=".urlencode($msg));
		curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($cSession,CURLOPT_HEADER, false);
//Admin Msg
$msg_admin="Dear Admin, payment of Rs.$amount.(Re.Id:$receipt_id) was done for student $mobile[0] with Ad.No:$admission_no studying $branch in Jaagruthi College.";
		$cSession1 = curl_init();
		curl_setopt($cSession1,CURLOPT_URL,"http://alerts.kapsystem.com/web2sms.php?username=xxxx&password=xxxx&to=$mobile_admin&sender=xxxx&message=".urlencode($msg_admin));
		curl_setopt($cSession1,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($cSession1,CURLOPT_HEADER, false);
//		
if(curl_exec($cSession) && curl_exec($cSession1))
{
echo '<script> alert("Payment Successfully") </script>';
echo "<script language='JavaScript'> window.location.href ='get-details.php?Id=$admission_no' </script>";
curl_close($cSession);
curl_close($cSession1);
}
}
else
{
echo '<script> alert("Invalid Payment..") </script>';
echo "<script language='JavaScript'> window.location.href ='get-details.php?Id=$admission_no' </script>";
}
}

}
}
}
}
?>