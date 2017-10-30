<?php
include_once('include/db-connect.php');
if(isset($_POST['sub']) && $_POST['sub']=='Sign In')
{
$username=mysql_real_escape_string(trim($_POST['uname']));
$password=md5(trim($_POST['pass']));
if($username=='' || $password=='')
{
header('Location:login.php?msg=Invalid');
}
else
{
$db->setFetchMode(DB_FETCHMODE_ORDERED);
$sql="select * from admin where user_name = ? and password = ?";
$data=array($username, $password);
$exe_query=& $db->query($sql, $data);
$match=$exe_query->numRows();
if($match==1)
{
$data=& $exe_query->fetchRow();
session_start();
$_SESSION['uid']=$data[0];
//$_SESSION['uname']=$data[1];
$_SESSION['mobile']=$data[3];
$uid=$_SESSION['uid'];
/*echo $data[1];
echo "<br/>";
echo $data[2];
echo "<br/>";
echo $data[3];*/
        function createRandomPassword() {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz0123456789";
        $i = 0;
        $pass = '' ;

        while ($i <= 7) {
            $num = mt_rand(0,61);
            $tmp = substr($chars, $num, 1);
            $pass = $pass . $tmp;
            $i++;
        }
        return $pass;
        }

        $msg = createRandomPassword();
		//echo $msg;
		$update_query="update admin set message='$msg' where sno='{$uid}'";
		$exe_update_query=& $db->query($update_query);
		if($exe_update_query)
		{
		//header('Location:msg.php');
		//echo "Sent Message";
		$number=urlencode($data[3]);
		$cSession = curl_init();
		curl_setopt($cSession,CURLOPT_URL,"http://alerts.kapsystem.com/web2sms.php?username=xxxx&password=xxx&to=$number&sender=xxxxx&message=".urlencode($msg));
		curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($cSession,CURLOPT_HEADER, false);
		if(curl_exec($cSession))
		{
		header('Location:msg.php');
		curl_close($cSession);
		}
		}
		else
		{
		header('Location:login.php?msg=Invalid');
		}

}
else
{
header('Location:login.php?msg=Invalid');
}
}
}
?>