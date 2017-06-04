<?php
	session_start();
	if($_SESSION["admin"] != 1)
	{
		header('Location: index.php');
		exit;
	}
	
	$id = $_REQUEST["user_id1"];
	header("Content-Type:text/html; charset=utf-8");
	date_default_timezone_set("Asia/Taipei");
	$dbhost = 'localhost';
    $dbuser = '';
    $dbpass = '';
    $dbname = 'cul';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');
    mysql_query("SET NAMES 'utf8'");
    mysql_select_db($dbname);

	$sql = "DELETE FROM `wish` WHERE `user` = \"".$id."\";";
	$result = mysql_query($sql);
	if($result)
	{
		header('Location: index.php');
		exit;
	}else
	{
		header('Location: index.php');
		//header('Location: index.php?action=logout&err_msg=刪除課程失敗!請洽詢工作人員');
		exit;
	}