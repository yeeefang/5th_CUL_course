<?php
	require_once('header.php');
	$sql = "DELETE FROM `wish` WHERE `user` = \"".$data['ID']."\";";
	$result = mysql_query($sql);
	if($result)
	{
		header('Location: mycourse.php');
		exit;
	}else
	{
		header('Location: index.php?action=logout&err_msg=刪除課程失敗!請洽詢工作人員');
		exit;
	}