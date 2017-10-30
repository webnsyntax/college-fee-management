<?php
include('DB-1.7.13/DB.php');
error_reporting(E_ALL & ~E_STRICT);
 //$dsn = 'mysql://bhoomi:Vijayawada@1@bhoomi.db.10250344.hostedresource.com/bhoomi';
$dsn = 'mysql://root:@localhost/college';
 $options = array(
          'debug'       => 2,
          'portability' => DB_PORTABILITY_ALL,
      );
	  /* $parsed = array(
            'phptype'  => false,
            'dbsyntax' => false,
            'username' => false,
            'password' => false,
            'protocol' => false,
            'hostspec' => false,
            'port'     => false,
            'socket'   => false,
            'database' => false,
        );*/
	$db =& DB::connect($dsn, $options);
	/*$db = new DB();
	$db->connect($dsn, $options);*/
      if (PEAR::isError($db)) {
          die($db->getMessage());
      }
/*if($db)
{
echo "db selected";
}
else
echo "db not selected";*/


?>