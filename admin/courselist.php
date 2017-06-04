<!DOCTYPE html>
<html>
  <head>
	<!-- 最新編譯和最佳化的 CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/reset.css">
	<script src="https://code.jquery.com/jquery-3.0.0.min.js" integrity="sha256-JmvOoLtYsmqlsWxa7mDSLMwa6dZ9rrIdtrrVYRnDRH0=" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <title>第五屆大學生活體驗營 - 選課系統 | NCKU 5th CUL Course</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0, user-scalable=yes"/>
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-80204569-1', 'auto');
  ga('send', 'pageview');

</script>
  </head>
<?php

	foreach ($_POST as $key => $value) {
        $$key=$value; 
	}
	session_start();
	if($_SESSION["admin"] != 1)
	{
		header('Location: index.php');
		exit;
	}
	header("Content-Type:text/html; charset=utf-8");
	date_default_timezone_set("Asia/Taipei");
	$dbhost = 'localhost';
    $dbuser = '';
    $dbpass = '';
    $dbname = 'cul';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');
    mysql_query("SET NAMES 'utf8'");
    mysql_select_db($dbname);
    $co = $_GET["no"];
    
    $sql = "SELECT `id`,`time`,`name` FROM `course` WHERE 1;";
    $result = mysql_query($sql);
    while($x = mysql_fetch_array($result))
    {
    	$c_name[$x[0]] = $x[2];
    	if($x[1] == "C")
    	{
    		$c_time[$x[0]] = "A";
    	}
    	else if($x[1] == "D")
    	{
    		$c_time[$x[0]] = "B";
    	}else
    	{
    		$c_time[$x[0]] = $x[1];
    	}
    }
    ?>
    <h2><?php echo $co.$c_name[$co];?></h2>
<table class="table table-bordered table-striped">
	<tr><td>小隊</td><td>姓名</td></tr>
<?php $sql = "SELECT user.name,user.squad,user.ID FROM `result` join `user` on result.ID = user.ID where result.course".$c_time[$co]." = \"$co\" ORDER BY user.squad ASC;";$result = mysql_query($sql);$rowcount = mysql_num_rows($result);while($data = mysql_fetch_array($result))
{		echo "<tr>";
    	echo "<td style='width:20%'>".$data[1]."</td>";
		echo "<td style='width:80%'><a target='_blank' href='../index.php?pass_val=".$data[2]."'>".$data[0]."</a></td>";
		echo "</tr>";
}?>
</table>
<h2>選課人數： <?php echo $rowcount;?></h2>