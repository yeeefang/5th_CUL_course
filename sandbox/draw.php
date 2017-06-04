<?php
	date_default_timezone_set("Asia/Taipei");
	$dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = 'rat51335';
    $dbname = 'cul';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');
    mysql_query("SET NAMES 'utf8'");
    mysql_select_db($dbname);
    
    //先抽通識
    $sql = "SELECT `name`,`ID` FROM `user`;";
	$result = mysql_query($sql);
	while($user = mysql_fetch_array($result)){
		//抽出第一門通識
		$sql_1 = "UPDATE `wish` SET `priority` = \"1\" WHERE `course` LIKE \"A9%\" AND `user` = \"".$user[1]."\" ORDER BY `priority` ASC LIMIT 1;";
		mysql_query("UPDATE `wish` SET `priority` = \"1\" WHERE `course` LIKE \"A9%\" AND `user` = \"".$user[1]."\" ORDER BY `priority` ASC LIMIT 1;");
		//ban掉其他通識
		$sql_2 = "UPDATE `wish` SET `priority` = \"0\" WHERE `course` LIKE \"A9%\" AND `user` = \"".$user[1]."\" AND `priority` IS NULL;";
		mysql_query("UPDATE `wish` SET `priority` = \"0\" WHERE `course` LIKE \"A9%\" AND `user` = \"".$user[1]."\" AND `priority` IS NULL;");
		
		//echo $user[0].":".$rows_1."<br>";
		
	}
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /*
    $sql = "SELECT * FROM `course` WHERE `id` = \"A9-001\";";
	$result = mysql_query($sql);
	$data = mysql_fetch_array($result);
	$max_001 = $data["max"];
	
	$sql = "SELECT * FROM `course` WHERE `id` = \"A9-002\";";
	$result = mysql_query($sql);
	$data = mysql_fetch_array($result);
	$max_002 = $data["max"];
	
	$sql = "SELECT * FROM `course` WHERE `id` = \"A9-003\";";
	$result = mysql_query($sql);
	$data = mysql_fetch_array($result);
	$max_003 = $data["max"];
    
	$sql = "SELECT course.id,course.name,course.time,course.max,wish.user,wish.course,wish.priority,wish.status FROM `wish` join `course` on wish.course = course.id WHERE wish.course LIKE \"A9-001\" AND wish.priority = \"1\" AND wish.status IS NULL;";
	$result = mysql_query($sql);
	$p1_001 = mysql_num_rows($result);
	if( $p1_001 <= $max_001)
	{
		$sqla = "UPDATE `wish` SET `status`=\"1\" WHERE wish.course = \"A9-001\" AND wish.priority = \"1\" AND wish.status IS NULL;";
		mysql_query($sqla);
		$max_001 -= $p1_001;
		$sqlb = "UPDATE `wish` SET `status`=\"0\" WHERE (`course` = \"E1-001\" OR `course` = \"E1-002\" OR `course` = \"E1-003\" OR `course` = \"H1-001\" OR `course` = \"H1-002\") AND wish.status IS NULL;";
		mysql_query($sqlb);
		$sqlc = "UPDATE `wish` SET `status`=\"0\" WHERE (`course` = \"A9-002\" OR `course` = \"A9-003\") AND wish.status IS NULL;";
		mysql_query($sqlc);
	}
	
	$sql = "SELECT course.id,course.name,course.time,course.max,wish.user,wish.course,wish.priority,wish.status FROM `wish` join `course` on wish.course = course.id WHERE course.id LIKE \"A9-002\" AND wish.priority = \"1\" AND wish.status IS NULL;";
	$result = mysql_query($sql);
	$p1_002 = mysql_num_rows($result);
	if( $p1_002 <= $max_002)
	{
		$sqla = "UPDATE `wish` SET `status`=\"1\" WHERE wish.course = \"A9-002\" AND wish.priority = \"1\" AND wish.status IS NULL;";
		mysql_query($sqla);
		$max_002 -= $p1_002;
		$sqlb = "UPDATE `wish` SET `status`=\"0\" WHERE (`course` = \"E1-004\" OR `course` = \"E1-005\" OR `course` = \"E1-006\" OR `course` = \"H1-003\" OR `course` = \"H1-004\") AND wish.status IS NULL;";
		mysql_query($sqlb);
		$sqlc = "UPDATE `wish` SET `status`=\"0\" WHERE (`course` = \"A9-001\" OR `course` = \"A9-003\") AND wish.status IS NULL;";
		mysql_query($sqlc);
	}
	
	$sql = "SELECT course.id,course.name,course.time,course.max,wish.user,wish.course,wish.priority,wish.status FROM `wish` join `course` on wish.course = course.id WHERE course.id LIKE \"A9-003\" AND wish.priority = \"1\" AND wish.status IS NULL;";
	$result = mysql_query($sql);
	$p1_003 = mysql_num_rows($result);
	if( $p1_003 <= $max_003)
	{
		$sqla = "UPDATE `wish` SET `status`=\"1\" WHERE wish.course = \"A9-003\" AND wish.priority = \"1\" AND wish.status IS NULL;";
		mysql_query($sqla);
		$max_003 -= $p1_003;
		$sqlb = "UPDATE `wish` SET `status`=\"0\" WHERE (`course` = \"E1-007\" OR `course` = \"E1-008\" OR `course` = \"E1-009\" OR `course` = \"H1-005\" OR `course` = \"H1-006\") AND wish.status IS NULL;";
		mysql_query($sqlb);
		$sqlc = "UPDATE `wish` SET `status`=\"0\" WHERE (`course` = \"A9-001\" OR `course` = \"A9-002\") AND wish.status IS NULL;";
		mysql_query($sqlc);
	}
	
	echo "第一志願：".$p1_001."<br>".$p1_002."<br>".$p1_003;
	for($i=1;$i<=3;$i++)
	{
		
	}*/
    
?>