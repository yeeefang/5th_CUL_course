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
    <style>
	html,body{background-color: #5D92BA;font-family: "微軟正黑體", sans-serif;}h1,h2,h3,h4,h5,h6{color:white;}.margin-10px{margin-top:10px;margin-bottom:10px;}.lf-btn {padding: 15px 30px;border: none;background: white;color: #5D92BA;}.lf-btn--right {float: right;}.lf-icon {display: inline-block;}.lf-icon--min {font-size: .9em;}.lf-lnk {font-size: .8em;line-height: 3em;color: white;text-decoration: none;}
	</style>
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-80204569-1', 'auto');
  ga('send', 'pageview');

</script>
  </head>
  <body>
	<div class="container-fluid">
  		<div class="row">
  			<div class="col-md-12 col-sd-12" style="overflow:hidden;text-align:center;background-color:#FFFFFF">
  				<img style="width:100%;max-height:200px;max-width:1168px;" src="image/cover.png"/>
  			</div>
  		</div>
  	</div>
  	<div class="container" style="margin-top: 30px;">
  		<form method="POST" action="preview.php" id="form1" name="form1">
  		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#" onclick="">我的課表</a></li>
				<li class="active">開始抽籤</li>
			</ol>
		</div>
		
		<div class="col-md-12 col-sd-12 col-xs-12">
  			<div class="alert alert-warning">正在進行抽籤...請稍後。</div>
  		</div>
  		<div class="col-md-12 col-sd-12 col-xs-12">
  			<div class="panel panel-default">
  				<div class="panel-body">
  				
<?php
	session_start();
	if((!isset($_SESSION['token'])) || $_SESSION['token']=="")
	{
		header('Location: index.php?action=logout&err_msg=請先登入！');
		exit;
	}
	echo "------START COURSE SELECTION------<br>";
	echo "POWERED BY NTU CSIE<br>";
	echo "Project: CAMP OF UNIVERSITY 5TH<br>";
	echo "Version: Ver. 2.0.1 <br>";
	echo "Build: 2016/07/01 <br>";
	echo "----------------------------------<br>";
	
	
	$id = $_SESSION["token"];
	header("Content-Type:text/html; charset=utf-8");
	date_default_timezone_set("Asia/Taipei");
	$dbhost = 'localhost';
    $dbuser = '';
    $dbpass = '';
    $dbname = 'cul';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');
    mysql_query("SET NAMES 'utf8'");
    mysql_select_db($dbname);
	$sql = "SELECT * FROM `user` WHERE `md5_ID` = \"$id\";";
    $result = mysql_query($sql);
    $data = mysql_fetch_array($result);
    
    //檢查是否選課
    $sql = "SELECT * FROM `wish` WHERE `user` = \"".$data['ID']."\";";
	$result = mysql_query($sql);
  	$rowcount = mysql_num_rows($result);
  	if($rowcount ==0)
  	{
  		header('Location: index.php?action=logout&err_msg=請先選課在執行抽籤！');
    	exit;
  	}
  	
  	//檢查是否已抽籤
	$sql = "SELECT * FROM `result` WHERE `ID` = \"".$data['ID']."\";";
	$result = mysql_query($sql);
  	$rowcount = mysql_num_rows($result);
  	if($rowcount >0)
  	{
  		header('Location: index.php?action=logout&err_msg=已抽籤！請重新登入以重整資料!');
    	exit;
  	}
  	
  	function check_A9($course)
  	{
  			echo "檢查課程[".$course."]已選人數...<br>";
  			$sql = "SELECT * FROM `result` WHERE `course".substr($course,5,1)."` = \"".$course."\";";
			$result = mysql_query($sql);
  			$rowcount = mysql_num_rows($result);
  			//檢查是否而額滿
  			if($rowcount < 105)
  			{
  				echo "課程[".$course."]餘額足夠，尚有".(105-$rowcount)."人<br>";
  				return true;
  			}else{
  				echo "課程[".$course."]已額滿<br>";
  				return false;
  			}
  			
  	
  		
  	}
  	function get_A9()
  	{
  		global $data;
  		$multiple = ["1"=>10,"2"=>8,"3"=>6,"4"=>3,"5"=>2,"6"=>1];
  		$arr = [];
  		$sql = "SELECT `course`,`priority` FROM `wish` WHERE `user` = \"".$data['ID']."\" AND `course` LIKE \"A9%\";";
    	$result = mysql_query($sql);
    	while($wish = mysql_fetch_array($result))
    	{
    		echo "[".$wish[0]."] 為第".$wish[1]."志願，加權權重=".$multiple[$wish[1]]."....<br>";
    		for($i=0;$i<($multiple[$wish[1]]);$i++)
    		{
    			array_push($arr,$wish[0]);
   			}
    	}
    	shuffle($arr);
    	//print_r($arr);
    	$co =  $arr[rand(0,count($arr)-1)];
    	echo "中籤課程為[".$co."]<br>";
    	//exit;
  			if(check_A9($co))
  			{
  				echo "課程[".$co."]可以選課<br>[通識時段抽籤完成]<br>正在回傳抽籤結果...<br>";
  				return $co;
  			}else{
  				echo "課程[A".$co."]無法選課！重新嘗試...<br>";
				return false;
  			}
  	}
  	
  	//先抽通事
  	echo "[開始抽籤]<br>呼叫通識抽籤程序...<br>";
  	
  	while(1)
  	{
  		$course_id = get_A9();
  		if($course_id != false){break;}
  	}
  	echo "已接收通識抽籤結果<br>正在執行課程中選寫入...<br>";
  	$co_time = ["A9-001" =>1, "A9-002" =>2, "A9-003"=>3];
  	$sql = "INSERT INTO `result` (`ID`,`course".$co_time["$course_id"]."`) VALUES (\"".$data["ID"]."\",\"".$course_id."\");";
    if(mysql_query($sql))
    {
    	echo "課程[".$course_id."]寫入成功！<br>[執行通識時段抽籤完成]<br>呼叫課堂衝堂檢查程序...<br>";
    }
    
    //衝堂檢查
    $sql = "SELECT * FROM `result` WHERE `ID` = \"".$data["ID"]."\" LIMIT 0,1;";
    $result = mysql_query($sql);
    if($cdata = mysql_fetch_array($result))
    {
    	echo "課堂佔課資訊查詢成功，已寫入矩陣<br>";
    }
    echo "[第一時段抽籤]<br>";
    
    function check_course($course)
  	{
  			echo "檢查課程[".$course."]已選人數...<br>";
  			$sql = "SELECT `max`,`time` FROM `course` WHERE `id` = \"".$course."\" LIMIT 0,1;";
  			$result = mysql_query($sql);
  			$max = mysql_fetch_array($result);
  			
  			
  			$sql = "SELECT * FROM `result` WHERE `course".$max[1]."` = \"".$course."\";";
			$result = mysql_query($sql);
  			$rowcount = mysql_num_rows($result);
  			//檢查是否而額滿
  			if($rowcount < $max[0])
  			{
  				echo "課程[".$course."]餘額足夠，尚有".($max[0]-$rowcount)."人<br>";
  				return true;
  			}else{
  				echo "課程[".$course."]已額滿<br>";
  				return false;
  			}
  			
  	
  		
  	}
  	
    function get_course($time)
    {
    	echo "讀取課程志願序中...<br>";
    	global $data;
  		$multiple = ["1"=>10,"2"=>8,"3"=>6,"4"=>3,"5"=>2,"6"=>1];
  		$arr = [];
  		$sql = "SELECT wish.course,wish.priority FROM `wish` join `course` on wish.course = course.id WHERE `user` = \"".$data['ID']."\" AND course.time = \"".$time."\" ORDER BY wish.priority ASC;";
    	$result = mysql_query($sql);
    	while($wish = mysql_fetch_array($result))
    	{
    		if($wish[0] !="A9-001" && $wish[0] !="A9-002" && $wish[0] !="A9-003")
    		{
    			echo "[".$wish[0]."] 為第".$wish[1]."志願，加權權重=".$multiple[$wish[1]]."....<br>";
    			for($i=0;$i<($multiple[$wish[1]]);$i++)
    			{
    				array_push($arr,$wish[0]);
   				}
    		}
    	}
    	shuffle($arr);
    	//print_r($arr);
    	$co =  $arr[rand(0,count($arr)-1)];
    	echo "中選課程為[".$co."]<br>";
    	//exit;
  			if(check_course($co))
  			{
  				echo "課程[".$co."]可以選課<br>[時段抽籤完成]<br>正在回傳抽籤結果...<br>";
  				return $co;
  			}else{
  				echo "課程[".$co."]無法選課！重新嘗試...<br>";
				return false;
  			}
    	
    	
    }
    
    
    if($cdata["course1"] !="")
    {
    	echo "第一時段已選課，終止程序（回傳false）<br>";
    }else
    {
    	echo "第一時段未選課，呼叫程序讀取志願序（回傳true）<br>";
    	
    	while(1)
		{
  			$course_id = get_course(1);
  			if($course_id != false){break;}
  		}
  		echo "已接收第一堂課抽籤結果<br>正在執行課程中選寫入...<br>";
  		$sql = "UPDATE `result` SET `course1` = \"$course_id\" WHERE `ID` = \"".$data["ID"]."\";";
    	if(mysql_query($sql))
    	{
    		echo "課程[".$course_id."]寫入成功！<br>[第一時段時段抽籤完成]<br>";
    	}
    	
    }
    
    if($cdata["course2"] !="")
    {
    	echo "第二時段已選課，終止程序（回傳false）<br>";
    }else
    {
    	echo "第二時段未選課，呼叫程序讀取志願序（回傳true）<br>";
    	
    	while(1)
		{
  			$course_id = get_course(2);
  			if($course_id != false){break;}
  		}
  		echo "已接收第二堂課抽籤結果<br>正在執行課程中選寫入...<br>";
  		$sql = "UPDATE `result` SET `course2` = \"$course_id\" WHERE `ID` = \"".$data["ID"]."\";";
    	if(mysql_query($sql))
    	{
    		echo "課程[".$course_id."]寫入成功！<br>[第二時段時段抽籤完成]<br>";
    	}
    	
    }
    
    if($cdata["course3"] !="")
    {
    	echo "第三時段已選課，終止程序（回傳false）<br>";
    }else
    {
    	echo "第三時段未選課，呼叫程序讀取志願序（回傳true）<br>";
    	
    	while(1)
		{
  			$course_id = get_course(3);
  			if($course_id != false){break;}
  		}
  		echo "已接收第三堂課抽籤結果<br>正在執行課程中選寫入...<br>";
  		$sql = "UPDATE `result` SET `course3` = \"$course_id\" WHERE `ID` = \"".$data["ID"]."\";";
    	if(mysql_query($sql))
    	{
    		echo "課程[".$course_id."]寫入成功！<br>[第三時段時段抽籤完成]<br>";
    	}
    	
    }
  	//共通課程終止
  	echo "共通課程(通識課與選修課)抽籤完成！<br>";
  	
  	//實作業師開始
  	function check_speccourse($course)
  	{
  			echo "檢查課程[".$course."]已選人數...<br>";
  			$sql = "SELECT `max`,`time` FROM `course` WHERE `id` = \"".$course."\" LIMIT 0,1;";
  			$result = mysql_query($sql);
  			$max = mysql_fetch_array($result);
  			$regx = ["A"=>"A","B"=>"B","C"=>"A","D"=>"B"];
  			
  			$sql = "SELECT * FROM `result` WHERE `course".$regx[$max[1]]."` = \"".$course."\";";
			$result = mysql_query($sql);
  			$rowcount = mysql_num_rows($result);
  			//檢查是否而額滿
  			if($rowcount < $max[0])
  			{
  				echo "課程[".$course."]餘額足夠，尚有".($max[0]-$rowcount)."人<br>";
  				return true;
  			}else{
  				echo "課程[".$course."]已額滿<br>";
  				return false;
  			}
  	}
  	
  	function get_speccourse($time)
    {
    	echo "讀取課程志願序中...<br>";
    	global $data;
  		$multiple = ["1"=>10,"2"=>8,"3"=>6,"4"=>3,"5"=>2,"6"=>1];
  		$arr = [];
  		$sql = "SELECT wish.course,wish.priority FROM `wish` join `course` on wish.course = course.id WHERE `user` = \"".$data['ID']."\" AND course.time = \"".$time."\" ORDER BY wish.priority ASC;";
    	//echo $sql;
    	//exit;
    	$result = mysql_query($sql);
    	while($wish = mysql_fetch_array($result))
    	{
    			echo "[".$wish[0]."] 為第".$wish[1]."志願，加權權重=".$multiple[$wish[1]]."....<br>";
    			for($i=0;$i<($multiple[$wish[1]]);$i++)
    			{
    				array_push($arr,$wish[0]);
   				}
    	}
    	shuffle($arr);
    	//print_r($arr);
    	$co =  $arr[rand(0,count($arr)-1)];
    	echo "中選課程為[".$co."]<br>";
    	//exit;
  			if(check_speccourse($co))
  			{
  				echo "課程[".$co."]可以選課<br>[時段抽籤完成]<br>正在回傳抽籤結果...<br>";
  				return $co;
  			}else{
  				echo "課程[".$co."]無法選課！重新嘗試...<br>";
				return false;
  			}
    	
    	
    }
  	
  	$squad = $data["squad"];
  	echo "[".$data["name"]."]"."為第[".$squad."]小隊<br>";
  	
  	if($squad <11)
  	{
  		//一類課程 抽兩堂實作
  		echo "[實作課] 呼叫程序讀取志願序<br>";
    	
    	while(1)
    	{
    		while(1)
			{
  				$course_id1 = get_speccourse(A);
  				if($course_id1 != false){break;}
  			}
  			while(1)
			{
  				$course_id2 = get_speccourse(B);
  				if($course_id2 != false){break;}
  			}
  			if((substr($course_id2,5,1) - substr($course_id1,5,1)) != 4) {
  				echo "課程無衝突規則！<br>";
  				break;
  				}else{
  					echo "課程衝突規則！<br>";
  				}
    	}
    	
  		
  		echo "已接收實作課抽籤結果<br>正在執行課程中選寫入...<br>";
  		$sql = "UPDATE `result` SET `courseA` = \"$course_id1\" , `courseB` = \"$course_id2\" WHERE `ID` = \"".$data["ID"]."\";";
    	if(mysql_query($sql))
    	{
    		echo "課程[".$course_id1."]、[".$course_id2."]寫入成功！<br>[實作課抽籤完成]<br>";
    	}
  		
  		
  	}else
  	{
  		//二三類課程 抽實作+業師
  		echo "[實作課] 呼叫程序讀取志願序<br>";
  		while(1)
			{
  				$course_id1 = get_speccourse(C);
  				if($course_id1 != false){break;}
  			}
  		while(1)
			{
  				$course_id2 = get_speccourse(D);
  				if($course_id2 != false){break;}
  			}
  		
  		echo "已接收抽籤結果<br>正在執行課程中選寫入...<br>";
  		$sql = "UPDATE `result` SET `courseA` = \"$course_id1\" , `courseB` = \"$course_id2\" WHERE `ID` = \"".$data["ID"]."\";";
    	if(mysql_query($sql))
    	{
    		echo "課程[".$course_id1."]、[".$course_id2."]寫入成功！<br>[抽籤完成]<br>";
    	}
  		
  		
  	}
  	?>
  	
  	</div></div></div>
  	<div class="col-md-12 col-sd-12 col-xs-12">
  	<a href="mycourse.php" onclick=""><div class="alert alert-success" style="text-align:center;"><span class="glyphicon glyphicon-share-alt"></span> 抽籤已完成！返回查看選課結果</div></a>
  	</div>