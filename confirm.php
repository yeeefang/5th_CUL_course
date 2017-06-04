<?php
	require_once('header.php');
	$abbr=array("H1"=>"一類必","E1"=>"二三必","A9"=>"通識課","H2"=>"實作","E2"=>"實作","E3"=>"業師");
	foreach ($_POST as $key => $value) {
        $$key=$value; 
	}
	
	$sql = "SELECT * FROM `result` WHERE `ID` = \"".$data['ID']."\";";
	$result = mysql_query($sql);
	//$sel_rowcount = mysql_num_rows($result);
	$selected = mysql_fetch_array($result);
	
	$sql = "SELECT * FROM `course`;";
	$result = mysql_query($sql);
	while($course = mysql_fetch_array($result)){
		$sqla = "SELECT * FROM `wish` WHERE `user` = \"".$data["ID"]."\" AND `course` = \"".$course["id"]."\";";
		$resulta = mysql_query($sqla);
		$exist = mysql_num_rows($resulta);
		if(isset($$course['id']) && $exist == 0)
		{
			$sql1 = "INSERT INTO `wish`(`user`, `course`, `priority`) VALUES (\"".$data["ID"]."\" , \"".$course["id"]."\" , \"".$$course["id"]."\");";
			mysql_query($sql1);
		}
	}
?>
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
  		<form method="POST" action="confirm.php" id="form1" name="form1">
  		<div class="row">
			<ol class="breadcrumb">
				<li><a href="mycourse.php">我的課表</a></li>
				<li class="active">選課完成</li>
				<li style="float:right;"><a href="index.php?action=logout&msg=已經登出，再見！">登出</a></li>
				<li style="float:right;"><?php echo "(".$data["squad"].") ".$data["name"];?></li>
			</ol>
		</div>
		
		<div class="col-md-12 col-sd-12 col-xs-12">
  			<div class="alert alert-success"><span class="glyphicon glyphicon-exclamation-ok" aria-hidden="true"></span> <strong>完成！</strong></div>
  		</div>
		<!--時段一-->
	  	<div class="col-md-6 col-sd-12 col-xs-12">
	  		<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">時段一</h3> 
				</div>
				<div class="panel-body" style="min-height:150px;">
					<table class="table">
						<tr>
							<th>#</th>
							<th>課程名稱</th>
							<th>志願序</th>
						</tr>
						<?php
						$sql = "SELECT course.id,course.name,course.time,wish.priority,wish.status FROM `wish` join `course` on wish.course = course.id WHERE wish.user = \"".$data["ID"]."\" AND course.time = \"1\" ORDER BY wish.priority ASC;";
						$result = mysql_query($sql);
						while($course = mysql_fetch_array($result)){
							//if($course[4] == "1")
							if($selected["course1"] == $course[0])
							{
								echo "<tr class='success'>";
							}
							else
							{
								echo "<tr>";
							}
							echo "<td style='width:15%;'><span class='label label-info'>".$abbr[substr($course[0],0,2)]."</span></td>"."<td style='width:60%;'>".$course[1]."</td><td style='width:25%;'><input type='text' pattern='[0-9]*' class='form-control' style='text-align:center;' maxlength='1' value='".$course[3]."' readonly required data-time='".$course[2]."' data-time='".$course[2]."' name='".$course[0]."' id='".$course[0]."'/></td></tr>";
						}?>
					</table>
				</div>
			</div>
		</div>
		
		<!--時段二-->
	  	<div class="col-md-6 col-sd-12 col-xs-12">
	  		<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">時段二</h3> 
				</div>
				<div class="panel-body" style="min-height:150px;">
					<table class="table">
						<tr>
							<th>#</th>
							<th>課程名稱</th>
							<th>志願序</th>
						</tr>
						<?php
						$sql = "SELECT course.id,course.name,course.time,wish.priority,wish.status FROM `wish` join `course` on wish.course = course.id WHERE wish.user = \"".$data["ID"]."\" AND course.time = \"2\" ORDER BY wish.priority ASC;";
						$result = mysql_query($sql);
						while($course = mysql_fetch_array($result)){
							if($selected["course2"] == $course[0])
							{
								echo "<tr class='success'>";
							}
							else
							{
								echo "<tr>";
							}
							echo "<td style='width:15%;'><span class='label label-info'>".$abbr[substr($course[0],0,2)]."</span></td>"."<td style='width:60%;'>".$course[1]."</td><td style='width:25%;'><input type='text' pattern='[0-9]*' class='form-control' style='text-align:center;' maxlength='1' value='".$course[3]."' readonly required data-time='".$course[2]."' data-time='".$course[2]."' name='".$course[0]."' id='".$course[0]."'/></td></tr>";
						}?>
					</table>
				</div>
			</div>
		</div>
		
		<!--時段三-->
	  	<div class="col-md-6 col-sd-12 col-xs-12">
	  		<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">時段三</h3> 
				</div>
				<div class="panel-body" style="min-height:150px;">
					<table class="table">
						<tr>
							<th>#</th>
							<th>課程名稱</th>
							<th>志願序</th>
						</tr>
						<?php
						$sql = "SELECT course.id,course.name,course.time,wish.priority,wish.status FROM `wish` join `course` on wish.course = course.id WHERE wish.user = \"".$data["ID"]."\" AND course.time = \"3\" ORDER BY wish.priority ASC;";
						$result = mysql_query($sql);
						while($course = mysql_fetch_array($result)){
							if($selected["course3"] == $course[0])
							{
								echo "<tr class='success'>";
							}
							else
							{
								echo "<tr>";
							}
							echo "<td style='width:15%;'><span class='label label-info'>".$abbr[substr($course[0],0,2)]."</span></td>"."<td style='width:60%;'>".$course[1]."</td><td style='width:25%;'><input type='text' pattern='[0-9]*' class='form-control' style='text-align:center;' maxlength='1' value='".$course[3]."' readonly required data-time='".$course[2]."' data-time='".$course[2]."' name='".$course[0]."' id='".$course[0]."'/></td></tr>";
						}?>
					</table>
				</div>
			</div>
		</div>
		
		<?php 
		//二三類顯示一個實作課+業師
		if($data["squad"]>=11)
		{?>
		<!--二三類實作課-->
	  	<div class="col-md-6 col-sd-12 col-xs-12">
	  		<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">實作課</h3> 
				</div>
				<div class="panel-body" style="min-height:150px;">
					<table class="table">
						<tr>
							<th>#</th>
							<th>課程名稱</th>
							<th>志願序</th>
						</tr>
						<?php
						$sql = "SELECT course.id,course.name,course.time,wish.priority,wish.status FROM `wish` join `course` on wish.course = course.id WHERE wish.user = \"".$data["ID"]."\" AND course.time = \"C\" ORDER BY wish.priority ASC;";
						$result = mysql_query($sql);
						while($course = mysql_fetch_array($result)){
							if($selected["courseA"] == $course[0])
							{
								echo "<tr class='success'>";
							}
							else
							{
								echo "<tr>";
							}
							echo "<td style='width:15%;'><span class='label label-info'>".$abbr[substr($course[0],0,2)]."</span></td>"."<td style='width:60%;'>".$course[1]."</td><td style='width:25%;'><input type='text' pattern='[0-9]*' class='form-control' style='text-align:center;' maxlength='1' value='".$course[3]."' readonly required data-time='".$course[2]."' data-time='".$course[2]."' name='".$course[0]."' id='".$course[0]."'/></td></tr>";
						}?>
					</table>
				</div>
			</div>
		</div>
		<!--二三類業師-->
	  	<div class="col-md-6 col-sd-12 col-xs-12">
	  		<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">業師</h3> 
				</div>
				<div class="panel-body" style="min-height:150px;">
					<table class="table">
						<tr>
							<th>#</th>
							<th>課程名稱</th>
							<th>志願序</th>
						</tr>
						<?php
						$sql = "SELECT course.id,course.name,course.time,wish.priority,wish.status FROM `wish` join `course` on wish.course = course.id WHERE wish.user = \"".$data["ID"]."\" AND course.time = \"D\" ORDER BY wish.priority ASC;";
						$result = mysql_query($sql);
						while($course = mysql_fetch_array($result)){
							if($selected["courseB"] == $course[0])
							{
								echo "<tr class='success'>";
							}
							else
							{
								echo "<tr>";
							}
							echo "<td style='width:15%;'><span class='label label-info'>".$abbr[substr($course[0],0,2)]."</span></td>"."<td style='width:60%;'>".$course[1]."</td><td style='width:25%;'><input type='text' pattern='[0-9]*' class='form-control' style='text-align:center;' maxlength='1' value='".$course[3]."' readonly required data-time='".$course[2]."' data-time='".$course[2]."' name='".$course[0]."' id='".$course[0]."'/></td></tr>";
						}?>
					</table>
				</div>
			</div>
		</div>
		<?php }else{?>
		<!--一類實作課1-->
	  	<div class="col-md-6 col-sd-12 col-xs-12">
	  		<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">實作課(1)</h3> 
				</div>
				<div class="panel-body" style="min-height:150px;">
					<table class="table">
						<tr>
							<th>#</th>
							<th>課程名稱</th>
							<th>志願序</th>
						</tr>
						<?php
						$sql = "SELECT course.id,course.name,course.time,wish.priority,wish.status FROM `wish` join `course` on wish.course = course.id WHERE wish.user = \"".$data["ID"]."\" AND course.time = \"A\" ORDER BY wish.priority ASC;";
						$result = mysql_query($sql);
						while($course = mysql_fetch_array($result)){
							if($selected["courseA"] == $course[0])
							{
								echo "<tr class='success'>";
							}
							else
							{
								echo "<tr>";
							}
							echo "<td style='width:15%;'><span class='label label-info'>".$abbr[substr($course[0],0,2)]."</span></td>"."<td style='width:60%;'>".$course[1]."</td><td style='width:25%;'><input type='text' pattern='[0-9]*' class='form-control' style='text-align:center;' maxlength='1' value='".$course[3]."' readonly required data-time='".$course[2]."' data-time='".$course[2]."' name='".$course[0]."' id='".$course[0]."'/></td></tr>";
						}?>
					</table>
				</div>
			</div>
		</div>
		<!--一類實作課2-->
	  	<div class="col-md-6 col-sd-12 col-xs-12">
	  		<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">實作課(2)</h3> 
				</div>
				<div class="panel-body" style="min-height:150px;">
					<table class="table">
						<tr>
							<th>#</th>
							<th>課程名稱</th>
							<th>志願序</th>
						</tr>
						<?php
						$sql = "SELECT course.id,course.name,course.time,wish.priority,wish.status FROM `wish` join `course` on wish.course = course.id WHERE wish.user = \"".$data["ID"]."\" AND course.time = \"B\" ORDER BY wish.priority ASC;";
						$result = mysql_query($sql);
						while($course = mysql_fetch_array($result)){
							if($selected["courseB"] == $course[0])
							{
								echo "<tr class='success'>";
							}
							else
							{
								echo "<tr>";
							}
							echo "<td style='width:15%;'><span class='label label-info'>".$abbr[substr($course[0],0,2)]."</span></td>"."<td style='width:60%;'>".$course[1]."</td><td style='width:25%;'><input type='text' pattern='[0-9]*' class='form-control' style='text-align:center;' maxlength='1' value='".$course[3]."' readonly required data-time='".$course[2]."' data-time='".$course[2]."' name='".$course[0]."' id='".$course[0]."'/></td></tr>";
						}?>
					</table>
				</div>
			</div>
		</div>
		<?php }?>
		</form>
	</div>
	<div class="container">
  		<div class="col-md-12 col-sd-12 col-xs-12">
  			<a href="mycourse.php"><div class="alert alert-success" style="text-align:center;"><span class="glyphicon glyphicon-arrow-right"></span> 返回課表</div></a>
  		</div>
  	</div>
  	
  	<script>
  	function gowithalert(target){
			var $go = true;
			var $arr = new Array(),
			$fields = $("input");
		$fields.each(function() {
			$arr.push($(this).val());
		});
		for(var i=0;i<$arr.length;i++){  
			if ($arr[i] != ""){  
				if(!confirm("這個頁面未儲存的資料將會遺失，確定離開嗎?"))
				{
					$go = false;
				}
				break;
			}
		}
			if($go)
			{
				document.location.href= target;
			}
		}
  	</script>