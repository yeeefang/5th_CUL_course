<?php
	session_start();
	if((!isset($_SESSION['token'])) || $_SESSION['token']=="")
	{
		header('Location: index.php?action=logout&err_msg=請先登入！');
		exit;
	}
	$id = $_SESSION["token"];
	header("Content-Type:text/html; charset=utf-8");
	date_default_timezone_set("Asia/Taipei");
	$dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = 'rat51335';
    $dbname = 'cul';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');
    mysql_query("SET NAMES 'utf8'");
    mysql_select_db($dbname);
	$sql = "SELECT * FROM `user` WHERE `md5_ID` = \"$id\";";
    $result = mysql_query($sql);
    $data = mysql_fetch_array($result);