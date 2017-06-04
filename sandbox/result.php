<?php
	date_default_timezone_set("Asia/Taipei");
	$dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = 'rat51335';
    $dbname = 'cul';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');
    mysql_query("SET NAMES 'utf8'");
    mysql_select_db($dbname);
    
    echo "<table>";
    echo "<tr><td>姓名</td><td>ID</td><td>時段一</td><td>時段二</td><td>時段三</td><td>時段A</td><td>時段B</td></tr>";
    $sql = "SELECT `ID`,`name` FROM `user`;";
	$result = mysql_query($sql);
	while($user = mysql_fetch_array($result)){
		echo "<tr>";
		//echo $user[0];
		$sqla = "SELECT course.id,course.name,course.time,wish.priority,wish.status FROM `wish` join `course` on wish.course = course.id WHERE wish.user = \"".$user[0]."\" AND course.time = \"1\"  AND wish.status = \"1\";";
		$resulta = mysql_query($sqla);
		$coursea = mysql_fetch_array($resulta);
		$sqlb = "SELECT course.id,course.name,course.time,wish.priority,wish.status FROM `wish` join `course` on wish.course = course.id WHERE wish.user = \"".$user[0]."\" AND course.time = \"2\"  AND wish.status = \"1\";";
		$resultb = mysql_query($sqlb);
		$courseb = mysql_fetch_array($resultb);
		$sqlc = "SELECT course.id,course.name,course.time,wish.priority,wish.status FROM `wish` join `course` on wish.course = course.id WHERE wish.user = \"".$user[0]."\" AND course.time = \"3\"  AND wish.status = \"1\";";
		$resultc = mysql_query($sqlc);
		$coursec = mysql_fetch_array($resultc);
		echo "<td>".$user[1]."</td>"."<td>".$user[0]."</td>"."<td>".$coursea[0]."</td>"."<td>".$courseb[0]."</td>"."<td>".$coursec[0]."</td>";
		echo "</tr>";
	}
	
	echo "</table>";
	
   /* $sql = "SELECT course.id,course.name,course.time,wish.priority,wish.status FROM `wish` join `course` on wish.course = course.id WHERE wish.user = \"".$data["ID"]."\" AND course.time = \"1\" ORDER BY wish.priority ASC;";
						$result = mysql_query($sql);
						while($course = mysql_fetch_array($result)){
							
							}*/