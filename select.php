<?php
	require_once('header.php');
	$abbr=array("H1"=>"一類必","E1"=>"二三必","A9"=>"通識課","H2"=>"實作","E2"=>"實作","E3"=>"業師");
	$sql = "SELECT * FROM `wish` WHERE `user` = \"".$data['ID']."\";";
	$result = mysql_query($sql);
  	$rowcount = mysql_num_rows($result);
	if($rowcount >0)
  	{
  		header('Location: confirm.php');
    	exit;
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
  		<form method="POST" action="preview.php" id="form1" name="form1">
  		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#" onclick="gowithalert('mycourse.php');">我的課表</a></li>
				<li class="active">選填志願</li>
				<li style="float:right;"><a href="#" onclick="gowithalert('index.php?action=logout&msg=已經登出，再見！');">登出</a></li>
				<li style="float:right;"><?php echo "(".$data["squad"].") ".$data["name"];?></li>
			</ol>
		</div>
		
		<div class="col-md-12 col-sd-12 col-xs-12">
  			<div class="alert alert-warning">各個時段、實作課、業師，請分別以阿拉伯數字(1~9)填上志願順序。</div>
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
						$sql = "SELECT * FROM `course` WHERE `time` = \"1\";";
						$result = mysql_query($sql);
						while($course = mysql_fetch_array($result)){
							echo "<tr><td style='width:15%;'><span class='label label-info'>".$abbr[substr($course['id'],0,2)]."</span></td>"."<td style='width:60%;'>".$course['name']."</td><td style='width:25%;'><input type='text' pattern='[0-9]*' class='form-control' style='text-align:center;' maxlength='1' required data-time='".$course['time']."' data-time='".$course['time']."' name='".$course['id']."' id='".$course['id']."'/></td></tr>";
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
						$sql = "SELECT * FROM `course` WHERE `time` = \"2\";";
						$result = mysql_query($sql);
						while($course = mysql_fetch_array($result)){
							echo "<tr><td style='width:15%;'><span class='label label-info'>".$abbr[substr($course['id'],0,2)]."</span></td>"."<td style='width:60%;'>".$course['name']."</td><td style='width:25%;'><input type='text' pattern='[0-9]*' class='form-control' style='text-align:center;' maxlength='1' required data-time='".$course['time']."' name='".$course['id']."' id='".$course['id']."'/></td></tr>";
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
						$sql = "SELECT * FROM `course` WHERE `time` = \"3\";";
						$result = mysql_query($sql);
						while($course = mysql_fetch_array($result)){
							echo "<tr><td style='width:15%;'><span class='label label-info'>".$abbr[substr($course['id'],0,2)]."</span></td>"."<td style='width:60%;'>".$course['name']."</td><td style='width:25%;'><input type='text' pattern='[0-9]*' class='form-control' style='text-align:center;' maxlength='1' required data-time='".$course['time']."' name='".$course['id']."' id='".$course['id']."'/></td></tr>";
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
						$sql = "SELECT * FROM `course` WHERE `time` = \"C\";";
						$result = mysql_query($sql);
						while($course = mysql_fetch_array($result)){
							echo "<tr><td style='width:15%;'><span class='label label-info'>".$abbr[substr($course['id'],0,2)]."</span></td>"."<td style='width:60%;'>".$course['name']."</td><td style='width:25%;'><input type='text' pattern='[0-9]*' class='form-control' style='text-align:center;' maxlength='1' required data-time='".$course['time']."' name='".$course['id']."' id='".$course['id']."'/></td></tr>";
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
						$sql = "SELECT * FROM `course` WHERE `time` = \"D\";";
						$result = mysql_query($sql);
						while($course = mysql_fetch_array($result)){
							echo "<tr><td style='width:15%;'><span class='label label-info'>".$abbr[substr($course['id'],0,2)]."</span></td>"."<td style='width:60%;'>".$course['name']." <span class='label label-warning'>".$course['instr']."</span></td><td style='width:25%;'><input type='text' pattern='[0-9]*' class='form-control' style='text-align:center;' maxlength='1' required data-time='".$course['time']."' name='".$course['id']."' id='".$course['id']."'/></td></tr>";
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
						$sql = "SELECT * FROM `course` WHERE `time` = \"A\";";
						$result = mysql_query($sql);
						while($course = mysql_fetch_array($result)){
							echo "<tr><td style='width:15%;'><span class='label label-info'>".$abbr[substr($course['id'],0,2)]."</span></td>"."<td style='width:60%;'>".$course['name']."</td><td style='width:25%;'><input type='text' pattern='[0-9]*' class='form-control' style='text-align:center;' maxlength='1' required data-time='".$course['time']."' name='".$course['id']."' id='".$course['id']."'/></td></tr>";
						}?>
					</table>
				</div>
			</div>
		</div>
		<!--二三類業師-->
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
						$sql = "SELECT * FROM `course` WHERE `time` = \"B\";";
						$result = mysql_query($sql);
						while($course = mysql_fetch_array($result)){
							echo "<tr><td style='width:15%;'><span class='label label-info'>".$abbr[substr($course['id'],0,2)]."</span></td>"."<td style='width:60%;'>".$course['name']."</td><td style='width:25%;'><input type='text' pattern='[0-9]*' class='form-control' style='text-align:center;' maxlength='1' required data-time='".$course['time']."' name='".$course['id']."' id='".$course['id']."'/></td></tr>";
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
  			<a href="#" onclick="check_all();"><div class="alert alert-success" style="text-align:center;"><span class="glyphicon glyphicon-play"></span> 送出預覽</div></a>
  		</div>
  	</div>
  	<script>
  	function check_all(){
  		var msg = "",
  		returnvalue = true;
  		if(check_empty())
  		{
  			msg += "欄位未完全輸入 \n";
  			returnvalue = false;
  		}
  		if(check_NaN())
  		{
  			msg += "欄位只能輸入數字 \n";
  			returnvalue = false;
  		}
  		if(check_duplicate('1'))
  		{
  			msg += "[時段一] 志願序重複或錯誤！ \n";
  			returnvalue = false;
  		}
  		if(check_duplicate('2'))
  		{
  			msg += "[時段二] 志願序重複或錯誤！ \n";
  			returnvalue = false;
  		}
  		if(check_duplicate('3'))
  		{
  			msg += "[時段三] 志願序重複或錯誤！ \n";
  			returnvalue = false;
  		}
  		if(check_duplicate('A'))
  		{
  			msg += "[實做課（1）] 志願序重複或錯誤！ \n";
  			returnvalue = false;
  		}
  		if(check_duplicate('B'))
  		{
  			msg += "[實做課（2）] 志願序重複或錯誤！ \n";
  			returnvalue = false;
  		}
  		if(check_duplicate('C'))
  		{
  			msg += "[實做課] 志願序重複或錯誤！ \n";
  			returnvalue = false;
  		}
  		if(check_duplicate('D'))
  		{
  			msg += "[業師] 志願序重複或錯誤！ \n";
  			returnvalue = false;
  		}
  		if(!returnvalue)
  		{
  			alert(msg);
  		}else{
  			form1.submit();
  		}
  	}
  	function check_empty() {
		var $arr = new Array(),
			$fields = $("input");
		$fields.each(function() {
			$arr.push($(this).val());
		});
		for(var i=0;i<$arr.length;i++){  
			if ($arr[i] == ""){  
				return true;
			}
		}
		return false;
}
	function check_NaN() {
		var $arr = new Array(),
			$fields = $("input");
		$fields.each(function() {
			$arr.push($(this).val());
		});
		for(var i=0;i<$arr.length;i++){  
			if (isNaN($arr[i])){  
				return true;
			}
		}
		return false;
}

  	function check_duplicate(time) {
		var $arr = new Array(),
			$fields = $("input[data-time='"+time+"']");
		var $abbr = { 1 : '時段一', 2 : '時段二', 3 : '時段三', Ａ : '實做課(1)', B : '實做課(2)', C : '實做課', D : '業師' };
		$fields.each(function() {
			$arr.push($(this).val());
		});
		$arr = $arr.sort();
		var length = $arr.length;
		for(var i=0;i<length;i++){  
			if ($arr[i] == $arr[i+1]){  
				return true;
			}  
		}
		if(($arr[0]<'1') || ($arr[length-1]>length))
		{
			return true;
		}
		return false;
}

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