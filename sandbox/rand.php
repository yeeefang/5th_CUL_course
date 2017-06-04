<?php
	date_default_timezone_set("Asia/Taipei");
	$dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = 'rat51335';
    $dbname = 'cul';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');
    mysql_query("SET NAMES 'utf8'");
    mysql_select_db($dbname);
	$sql = "SELECT * FROM `user`;";
    $result = mysql_query($sql);
    $arr1 = array("1","2","3","4","5","6");
    $arr2 = array("1","2","3","4","5","6");
    $arr3 = array("1","2","3","4","5","6");
    while($data = mysql_fetch_array($result))
    {
    	 shuffle($arr1);
    	 shuffle($arr2);
    	 shuffle($arr3);
    	$sqla = "INSERT INTO `wish` ( `user`, `course`, `priority`, `status`) VALUES
( '".$data[3]."', 'H1-001', '".$arr1[0]."', NULL),
( '".$data[3]."', 'H1-002', '".$arr1[1]."', NULL),
( '".$data[3]."', 'E1-001', '".$arr1[2]."', NULL),
( '".$data[3]."', 'E1-002', '".$arr1[3]."', NULL),
( '".$data[3]."', 'E1-003', '".$arr1[4]."', NULL),
( '".$data[3]."', 'A9-001', '".$arr1[5]."', NULL),

( '".$data[3]."', 'H1-003', '".$arr2[0]."', NULL),
( '".$data[3]."', 'H1-004', '".$arr2[1]."', NULL),
( '".$data[3]."', 'E1-004', '".$arr2[2]."', NULL),
( '".$data[3]."', 'E1-005', '".$arr2[3]."', NULL),
( '".$data[3]."', 'E1-006', '".$arr2[4]."', NULL),
( '".$data[3]."', 'A9-002', '".$arr2[5]."', NULL),

( '".$data[3]."', 'H1-005', '".$arr3[0]."', NULL),
( '".$data[3]."', 'H1-006', '".$arr3[1]."', NULL),
( '".$data[3]."', 'E1-007', '".$arr3[2]."', NULL),
( '".$data[3]."', 'E1-008', '".$arr3[3]."', NULL),
( '".$data[3]."', 'E1-009', '".$arr3[4]."', NULL),
( '".$data[3]."', 'A9-003', '".$arr3[5]."', NULL),

( '".$data[3]."', 'E2-100', 1, NULL),
( '".$data[3]."', 'E2-101', 2, NULL),
( '".$data[3]."', 'E2-102', 3, NULL),
( '".$data[3]."', 'E2-103', 4, NULL),
( '".$data[3]."', 'E2-104', 5, NULL),
( '".$data[3]."', 'E2-105', 6, NULL),
( '".$data[3]."', 'E3-201', 1, NULL),
( '".$data[3]."', 'E3-202', 2, NULL);";
	mysql_query($sqla);
    }
?>
