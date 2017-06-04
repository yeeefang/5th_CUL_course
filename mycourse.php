<?php
	require_once('header.php');
	
	$sql = "SELECT * FROM `result` WHERE `ID` = \"".$data['ID']."\";";
	$result = mysql_query($sql);
	$sel_rowcount = mysql_num_rows($result);
	$selected = mysql_fetch_array($result);
	

	$sql = "SELECT `id`,`name`,`instr`,`intro` FROM `course` WHERE 1;";
    $result = mysql_query($sql);
    while($x = mysql_fetch_array($result))
    {
    	$c_name[$x[0]] = $x[1];
    	$c_instr[$x[0]] = $x[2];
    	$c_intro[$x[0]] = $x[3];
    }
    //print_r($c_intro);
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
  		<div class="row">
			<ol class="breadcrumb">
			<?php
			$sql = "SELECT * FROM `wish` WHERE `user` = \"".$data['ID']."\";";
			$result = mysql_query($sql);
  			$rowcount = mysql_num_rows($result);
  			?>
				<li class="active"><a href="mycourse.php">我的課程 
				<?php if($rowcount ==0)
				{?>
				<span class="label label-danger"> 未選課 </span></a></li>
				<?php }else if($rowcount !=0 && $sel_rowcount ==0){?>
				<span class="label label-danger"> 未抽籤 </span></a></li>
				<?php }else{?>
				<span class="label label-success"> 已抽籤 </span></a></li>
				<?php }?>
				<li style="float:right;"><a href="index.php?action=logout&msg=已經登出，再見！">登出</a></li>
				<li style="float:right;"><?php echo "(".$data["squad"].") ".$data["name"];?></li>
			</ol>
		</div>
		
		<div class="alert alert-warning">課程清單內有各時段的課程簡介，請慎選課程。完成選填志願後，請記得執行『開始抽籤』！</div>
		
		<div class="row">
	  	<div class="col-md-4 col-sd-12 col-xs-12">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">時段一 <a href="#" data-toggle="modal" data-target="#course1"><span class="label label-info">課程清單</span></a></h3> 
				</div>
				<div class="panel-body" style="min-height:100px;">
				<?php
				if($sel_rowcount!=0)
				{
				echo "<div style='text-align:center;'><span class='label label-success'>".$selected["course1"]."</span> <span class='glyphicon glyphicon-ok' title='Course Confirmed'></span></div><br>";
				echo "<div style='text-align:center;font-size:28px'>".$c_name[$selected["course1"]]."</div><br></div><div class='panel-footer'>";
				echo $c_intro[$selected["course1"]];
				}else{
				echo "<div style='text-align:center;font-size:28px'>沒有已抽中課程</div><br></div><div class='panel-footer'>請先選填志願並完成抽籤，這裡會顯示中選的課程。";	
				}
				?>
				
				</div>
			</div>
		</div>
		
		<div class="col-md-4 col-sd-12 col-xs-12">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">時段二 <a href="#" data-toggle="modal" data-target="#course2"><span class="label label-info">課程清單</span></a></h3>
				</div>
				<div class="panel-body" style="min-height:100px;">
				<?php
				if($sel_rowcount!=0)
				{
				echo "<div style='text-align:center;'><span class='label label-success'>".$selected["course2"]."</span> <span class='glyphicon glyphicon-ok' title='Course Confirmed'></span></div><br>";
				echo "<div style='text-align:center;font-size:28px'>".$c_name[$selected["course2"]]."</div><br></div><div class='panel-footer'>";
				echo $c_intro[$selected["course2"]];
				}else{
				echo "<div style='text-align:center;font-size:28px'>沒有已抽中課程</div><br></div><div class='panel-footer'>請先選填志願並完成抽籤，這裡會顯示中選的課程。";	
				}
				?>
				
				</div>
			</div>
		</div>
		
		<div class="col-md-4 col-sd-12 col-xs-12">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">時段三 <a href="#" data-toggle="modal" data-target="#course3"><span class="label label-info">課程清單</span></a></h3>
				</div>
				<div class="panel-body" style="min-height:100px;">
				<?php
				if($sel_rowcount!=0)
				{
				echo "<div style='text-align:center;'><span class='label label-success'>".$selected["course3"]."</span> <span class='glyphicon glyphicon-ok' title='Course Confirmed'></span></div><br>";
				echo "<div style='text-align:center;font-size:28px'>".$c_name[$selected["course3"]]."</div><br></div><div class='panel-footer'>";
				echo $c_intro[$selected["course3"]];
				}else{
				echo "<div style='text-align:center;font-size:28px'>沒有已抽中課程</div><br></div><div class='panel-footer'>請先選填志願並完成抽籤，這裡會顯示中選的課程。";	
				}
				?>
				
				</div>
			</div>
		</div>
		</div>
		<div class="row">
		
		<?php
		//僅有二三類顯示一個實作課+業師
		if($data["squad"]>=11)
		{?>
		<div class="col-md-6 col-sd-12 col-xs-12">
			<div class="panel panel-warning">
				<div class="panel-heading">
					<h3 class="panel-title">[二三類] 實作課 <a href="#" data-toggle="modal" data-target="#courseC"><span class="label label-info">課程清單</span></a></h3>
				</div>
				<div class="panel-body" style="min-height:100px;">
				<?php
				if($sel_rowcount!=0)
				{
				echo "<div style='text-align:center;'><span class='label label-success'>".$selected["courseA"]."</span> <span class='glyphicon glyphicon-ok' title='Course Confirmed'></span></div><br>";
				echo "<div style='text-align:center;font-size:28px'>".$c_name[$selected["courseA"]]."</div><br></div><div class='panel-footer'>";
				echo $c_intro[$selected["courseA"]];
				}else{
				echo "<div style='text-align:center;font-size:28px'>沒有已抽中課程</div><br></div><div class='panel-footer'>請先選填志願並完成抽籤，這裡會顯示中選的課程。";	
				}
				?>
				
				</div>
			</div>
		</div>
		<div class="col-md-6 col-sd-12 col-xs-12">
			<div class="panel panel-warning">
				<div class="panel-heading">
					<h3 class="panel-title">[二三類] 業師 <a href="#" data-toggle="modal" data-target="#courseD"><span class="label label-info">課程清單</span></a></h3>
				</div>
				<div class="panel-body" style="min-height:100px;">
				<?php
				if($sel_rowcount!=0)
				{
				echo "<div style='text-align:center;'><span class='label label-success'>".$selected["courseB"]."</span> <span class='glyphicon glyphicon-ok' title='Course Confirmed'></span></div><br>";
				echo "<div style='text-align:center;font-size:28px'>".$c_name[$selected["courseB"]]."</div><br></div><div class='panel-footer'>";
				echo $c_intro[$selected["courseB"]];
				}else{
				echo "<div style='text-align:center;font-size:28px'>沒有已抽中課程</div><br></div><div class='panel-footer'>請先選填志願並完成抽籤，這裡會顯示中選的課程。";	
				}
				?>
				
				</div>
			</div>
		</div>
  		<?php }else{//一類組顯示兩個實作課?>
  		<div class="col-md-6 col-sd-12 col-xs-12">
			<div class="panel panel-warning">
				<div class="panel-heading">
					<h3 class="panel-title">[一類] 實作課(1) <a href="#" data-toggle="modal" data-target="#courseA"><span class="label label-info">課程清單</span></a></h3>
				</div>
				<div class="panel-body" style="min-height:100px;">
				<?php
				if($sel_rowcount!=0)
				{
				echo "<div style='text-align:center;'><span class='label label-success'>".$selected["courseA"]."</span> <span class='glyphicon glyphicon-ok' title='Course Confirmed'></span></div><br>";
				echo "<div style='text-align:center;font-size:28px'>".$c_name[$selected["courseA"]]."</div><br></div><div class='panel-footer'>";
				echo $c_intro[$selected["courseA"]];
				}else{
				echo "<div style='text-align:center;font-size:28px'>沒有已抽中課程</div><br></div><div class='panel-footer'>請先選填志願並完成抽籤，這裡會顯示中選的課程。";	
				}
				?>
				
				</div>
			</div>
		</div>
		<div class="col-md-6 col-sd-12 col-xs-12">
			<div class="panel panel-warning">
				<div class="panel-heading">
					<h3 class="panel-title">[一類] 實作課(2) <a href="#" data-toggle="modal" data-target="#courseB"><span class="label label-info">課程清單</span></a></h3>
				</div>
				<div class="panel-body" style="min-height:100px;">
				<?php
				if($sel_rowcount!=0)
				{
				echo "<div style='text-align:center;'><span class='label label-success'>".$selected["courseB"]."</span> <span class='glyphicon glyphicon-ok' title='Course Confirmed'></span></div><br>";
				echo "<div style='text-align:center;font-size:28px'>".$c_name[$selected["courseB"]]."</div><br></div><div class='panel-footer'>";
				echo $c_intro[$selected["courseB"]];
				}else{
				echo "<div style='text-align:center;font-size:28px'>沒有已抽中課程</div><br></div><div class='panel-footer'>請先選填志願並完成抽籤，這裡會顯示中選的課程。";	
				}
				?>
				</div>
			</div>
		</div>
  		<?php }?>
  		</div>
  	</div>
  	<div class="container">
  		<div class="col-md-12 col-sd-12 col-xs-12">
			<?php
  			$sql = "SELECT * FROM `settings` WHERE 1;";
			$result = mysql_query($sql);
  			$open_sel = mysql_fetch_array($result);
  			
  			$sql = "SELECT * FROM `wish` WHERE `user` = \"".$data['ID']."\";";
			$result = mysql_query($sql);
  			$rowcount = mysql_num_rows($result);
  			
  			$sql = "SELECT * FROM `result` WHERE `ID` = \"".$data['ID']."\";";
			$result = mysql_query($sql);
  			$rowcount2 = mysql_num_rows($result);
  			if($rowcount2 >0)
  			{
  				//已經完成抽籤
  				?><a href="confirm.php"><div class="alert alert-success" style="text-align:center;"><span class="glyphicon glyphicon-th-list"></span> 瀏覽志願序</div></a>
  			<?php }
  			else if($rowcount >0)
  			{?>
  				<a href="confirm.php"><div class="alert alert-success" style="text-align:center;"><span class="glyphicon glyphicon-th-list"></span> 瀏覽志願序</div></a>
  				<a href="#" onclick="gowithalert1('draw_action.php');"><div class="alert alert-success" style="text-align:center;"><span class="glyphicon glyphicon-cog"></span> 開始抽籤！</div></a>
  				<?php if($open_sel[1]){?>
  				<a href="#" onclick='del_draw()'><div class="alert alert-danger" style="text-align:center;"><span class="glyphicon glyphicon-remove"></span> 刪除志願</div></a>
  				<?php }?>
  			<?php }else{?>
  				<?php if($open_sel[1]){?>
  				<a href="select.php"><div class="alert alert-success" style="text-align:center;"><span class="glyphicon glyphicon-chevron-right"></span> 選填志願</div></a>
  				<?php }?>
  			<?php }
  			?>
  			</div>
  	</div>

  	
  	
  	
  	<!-- 時段一 -->
<div class="modal fade" id="course1" tabindex="-1" role="dialog" aria-labelledby="course1Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="course1Label">[時段一] 課程清單</h4>
      </div>
      <div class="modal-body">
      
		<div class="panel panel-info">
			<div class="panel-heading">一類必修課
			</div>
			<table class="table table-hover table-striped">
				<tr>
					<th>#</th>
					<th>課程名稱</th>
					<th>教授名稱</th>
					<th>人數上限</th>
				</tr>
				<?php
				$sql = "SELECT * FROM `course` WHERE `time` = \"1\" AND `id` LIKE \"H1%\";";
				$result = mysql_query($sql);
				while($course = mysql_fetch_array($result)){
					echo "<tr ><td style='width:16%;'>".$course['id']."</td>"."<td style='width:50%;'>".$course['name'];
					if($course['intro'] != "")
					{
						echo " <a href='#' data-toggle='popover' data-content='".$course['intro']."' data-placement='bottom' data-trigger='focus' tabindex='0'><span class='label label-success'>介紹</span></a>";
					}
					echo "</td>"."<td style='width:18%;'>".$course['instr']."</td>"."<td style='width:16%;'>".$course['max']."</td></tr>";
				}?>
			</table>
		</div>

		<div class="panel panel-warning">
			<div class="panel-heading">二三類必修課
			</div>
			<table class="table table-hover table-striped">
				<tr>
					<th>#</th>
					<th>課程名稱</th>
					<th>教授名稱</th>
					<th>人數上限</th>
				</tr>
				<?php
				$sql = "SELECT * FROM `course` WHERE `time` = \"1\" AND `id` LIKE \"E1%\";";
				$result = mysql_query($sql);
				while($course = mysql_fetch_array($result)){
					echo "<tr ><td style='width:16%;'>".$course['id']."</td>"."<td style='width:50%;'>".$course['name'];
					if($course['intro'] != "")
					{
						echo " <a href='#' data-toggle='popover' data-content='".$course['intro']."' data-placement='bottom' data-trigger='focus' tabindex='0'><span class='label label-success'>介紹</span></a>";
					}
					echo "</td>"."<td style='width:18%;'>".$course['instr']."</td>"."<td style='width:16%;'>".$course['max']."</td></tr>";
				}?>
			</table>
		</div>
		
		<div class="panel panel-success">
			<div class="panel-heading">通識課
			</div>
			<table class="table table-hover table-striped">
				<tr>
					<th>#</th>
					<th>課程名稱</th>
					<th>教授名稱</th>
					<th>人數上限</th>
				</tr>
				<?php
				$sql = "SELECT * FROM `course` WHERE `time` = \"1\" AND `id` LIKE \"A9%\";";
				$result = mysql_query($sql);
				while($course = mysql_fetch_array($result)){
					echo "<tr ><td style='width:16%;'>".$course['id']."</td>"."<td style='width:50%;'>".$course['name'];
					if($course['intro'] != "")
					{
						echo " <a href='#' data-toggle='popover' data-content='".$course['intro']."' data-placement='bottom' data-trigger='focus' tabindex='0'><span class='label label-success'>介紹</span></a>";
					}
					echo "</td>"."<td style='width:18%;'>".$course['instr']."</td>"."<td style='width:16%;'>".$course['max']."</td></tr>";
				}?>
			</table>
		</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
      </div>
    </div>
  </div>
</div>

	<!-- 時段二 -->

<div class="modal fade" id="course2" tabindex="-1" role="dialog" aria-labelledby="course2Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="course2Label">[時段二] 課程清單</h4>
      </div>
      <div class="modal-body">
      
		<div class="panel panel-info">
			<div class="panel-heading">一類必修課
			</div>
			<table class="table table-hover table-striped">
				<tr>
					<th>#</th>
					<th>課程名稱</th>
					<th>教授名稱</th>
					<th>人數上限</th>
				</tr>
				<?php
				$sql = "SELECT * FROM `course` WHERE `time` = \"2\" AND `id` LIKE \"H1%\";";
				$result = mysql_query($sql);
				while($course = mysql_fetch_array($result)){
					echo "<tr ><td style='width:16%;'>".$course['id']."</td>"."<td style='width:50%;'>".$course['name'];
					if($course['intro'] != "")
					{
						echo " <a href='#' data-toggle='popover' data-content='".$course['intro']."' data-placement='bottom' data-trigger='focus' tabindex='0'><span class='label label-success'>介紹</span></a>";
					}
					echo "</td>"."<td style='width:18%;'>".$course['instr']."</td>"."<td style='width:16%;'>".$course['max']."</td></tr>";
				}?>
			</table>
		</div>

		<div class="panel panel-warning">
			<div class="panel-heading">二三類必修課
			</div>
			<table class="table table-hover table-striped">
				<tr>
					<th>#</th>
					<th>課程名稱</th>
					<th>教授名稱</th>
					<th>人數上限</th>
				</tr>
				<?php
				$sql = "SELECT * FROM `course` WHERE `time` = \"2\" AND `id` LIKE \"E1%\";";
				$result = mysql_query($sql);
				while($course = mysql_fetch_array($result)){
					echo "<tr ><td style='width:16%;'>".$course['id']."</td>"."<td style='width:50%;'>".$course['name'];
					if($course['intro'] != "")
					{
						echo " <a href='#' data-html='true' data-toggle='popover' data-content='".$course['intro']."' data-placement='bottom' data-trigger='focus' tabindex='0'><span class='label label-success'>介紹</span></a>";
					}
					echo "</td>"."<td style='width:18%;'>".$course['instr']."</td>"."<td style='width:16%;'>".$course['max']."</td></tr>";
				}?>
			</table>
		</div>
		
		<div class="panel panel-success">
			<div class="panel-heading">通識課
			</div>
			<table class="table table-hover table-striped">
				<tr>
					<th>#</th>
					<th>課程名稱</th>
					<th>教授名稱</th>
					<th>人數上限</th>
				</tr>
				<?php
				$sql = "SELECT * FROM `course` WHERE `time` = \"2\" AND `id` LIKE \"A9%\";";
				$result = mysql_query($sql);
				while($course = mysql_fetch_array($result)){
					echo "<tr ><td style='width:16%;'>".$course['id']."</td>"."<td style='width:50%;'>".$course['name'];
					if($course['intro'] != "")
					{
						echo " <a href='#' data-toggle='popover' data-content='".$course['intro']."' data-placement='bottom' data-trigger='focus' tabindex='0'><span class='label label-success'>介紹</span></a>";
					}
					echo "</td>"."<td style='width:18%;'>".$course['instr']."</td>"."<td style='width:16%;'>".$course['max']."</td></tr>";
				}?>
			</table>
		</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
      </div>
    </div>
  </div>
</div>

	<!-- 時段三 -->
<div class="modal fade" id="course3" tabindex="-1" role="dialog" aria-labelledby="course3Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="course3Label">[時段三] 課程清單</h4>
      </div>
      <div class="modal-body">
      
		<div class="panel panel-info">
			<div class="panel-heading">一類必修課
			</div>
			<table class="table table-hover table-striped">
				<tr>
					<th>#</th>
					<th>課程名稱</th>
					<th>教授名稱</th>
					<th>人數上限</th>
				</tr>
				<?php
				$sql = "SELECT * FROM `course` WHERE `time` = \"3\" AND `id` LIKE \"H1%\";";
				$result = mysql_query($sql);
				while($course = mysql_fetch_array($result)){
					echo "<tr ><td style='width:16%;'>".$course['id']."</td>"."<td style='width:50%;'>".$course['name'];
					if($course['intro'] != "")
					{
						echo " <a href='#' data-toggle='popover' data-content='".$course['intro']."' data-placement='bottom' data-trigger='focus' tabindex='0'><span class='label label-success'>介紹</span></a>";
					}
					echo "</td>"."<td style='width:18%;'>".$course['instr']."</td>"."<td style='width:16%;'>".$course['max']."</td></tr>";
				}?>
			</table>
		</div>

		<div class="panel panel-warning">
			<div class="panel-heading">二三類必修課
			</div>
			<table class="table table-hover table-striped">
				<tr>
					<th>#</th>
					<th>課程名稱</th>
					<th>教授名稱</th>
					<th>人數上限</th>
				</tr>
				<?php
				$sql = "SELECT * FROM `course` WHERE `time` = \"3\" AND `id` LIKE \"E1%\";";
				$result = mysql_query($sql);
				while($course = mysql_fetch_array($result)){
					echo "<tr ><td style='width:16%;'>".$course['id']."</td>"."<td style='width:50%;'>".$course['name'];
					if($course['intro'] != "")
					{
						echo " <a href='#' data-html='true' data-toggle='popover' data-content='".$course['intro']."' data-placement='bottom' data-trigger='focus' tabindex='0'><span class='label label-success'>介紹</span></a>";
					}
					echo "</td>"."<td style='width:18%;'>".$course['instr']."</td>"."<td style='width:16%;'>".$course['max']."</td></tr>";
				}?>
			</table>
		</div>
		
		<div class="panel panel-success">
			<div class="panel-heading">通識課
			</div>
			<table class="table table-hover table-striped">
				<tr>
					<th>#</th>
					<th>課程名稱</th>
					<th>教授名稱</th>
					<th>人數上限</th>
				</tr>
				<?php
				$sql = "SELECT * FROM `course` WHERE `time` = \"3\" AND `id` LIKE \"A9%\";";
				$result = mysql_query($sql);
				while($course = mysql_fetch_array($result)){
					echo "<tr ><td style='width:16%;'>".$course['id']."</td>"."<td style='width:50%;'>".$course['name'];
					if($course['intro'] != "")
					{
						echo " <a href='#' data-toggle='popover' data-content='".$course['intro']."' data-placement='bottom' data-trigger='focus' tabindex='0'><span class='label label-success'>介紹</span></a>";
					}
					echo "</td>"."<td style='width:18%;'>".$course['instr']."</td>"."<td style='width:16%;'>".$course['max']."</td></tr>";
				}?>
			</table>
		</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
      </div>
    </div>
  </div>
</div>

	<!-- 一類實作(1) -->
<div class="modal fade" id="courseA" tabindex="-1" role="dialog" aria-labelledby="courseALabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="courseALabel">[一類] 實作課(1)</h4>
      </div>
      <div class="modal-body">
      
		<div class="panel panel-success">
			<div class="panel-heading">[一類] 實作課(1)
			</div>
			<table class="table table-hover table-striped">
				<tr>
					<th>#</th>
					<th>課程名稱</th>
					<th>人數上限</th>
				</tr>
				<?php
				$sql = "SELECT * FROM `course` WHERE `time` = \"A\" AND `id` LIKE \"H2%\";";
				$result = mysql_query($sql);
				while($course = mysql_fetch_array($result)){
					echo "<tr ><td style='width:16%;'>".$course['id']."</td>"."<td style='width:50%;'>".$course['name'];
					if($course['intro'] != "")
					{
						echo " <a href='#' data-toggle='popover' data-content='".$course['intro']."' data-placement='bottom' data-trigger='focus' tabindex='0'><span class='label label-success'>介紹</span></a>";
					}
					echo "</td><td style='width:16%;'>".$course['max']."</td></tr>";
				}?>
			</table>
		</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
      </div>
    </div>
  </div>
</div>

<!-- 一類實作(2) -->
<div class="modal fade" id="courseB" tabindex="-1" role="dialog" aria-labelledby="courseBLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="courseBLabel">[一類] 實作課(2)</h4>
      </div>
      <div class="modal-body">
      
		<div class="panel panel-success">
			<div class="panel-heading">[一類] 實作課(2)
			</div>
			<table class="table table-hover table-striped">
				<tr>
					<th>#</th>
					<th>課程名稱</th>
					<th>人數上限</th>
				</tr>
				<?php
				$sql = "SELECT * FROM `course` WHERE `time` = \"B\" AND `id` LIKE \"H2%\";";
				$result = mysql_query($sql);
				while($course = mysql_fetch_array($result)){
					echo "<tr ><td style='width:16%;'>".$course['id']."</td>"."<td style='width:50%;'>".$course['name'];
					if($course['intro'] != "")
					{
						echo " <a href='#' data-toggle='popover' data-content='".$course['intro']."' data-placement='bottom' data-trigger='focus' tabindex='0'><span class='label label-success'>介紹</span></a>";
					}
					echo "</td><td style='width:16%;'>".$course['max']."</td></tr>";
				}?>
			</table>
		</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
      </div>
    </div>
  </div>
</div>

<!-- 二三類實作 -->
<div class="modal fade" id="courseC" tabindex="-1" role="dialog" aria-labelledby="courseCLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="courseCLabel">[二三類] 實作課</h4>
      </div>
      <div class="modal-body">
      
		<div class="panel panel-success">
			<div class="panel-heading">[二三類] 實作課
			</div>
			<table class="table table-hover table-striped">
				<tr>
					<th>#</th>
					<th>課程名稱</th>
					<th>人數上限</th>
				</tr>
				<?php
				$sql = "SELECT * FROM `course` WHERE `time` = \"C\" AND `id` LIKE \"E2%\";";
				$result = mysql_query($sql);
				while($course = mysql_fetch_array($result)){
					echo "<tr ><td style='width:16%;'>".$course['id']."</td>"."<td style='width:50%;'>".$course['name'];
					if($course['intro'] != "")
					{
						echo " <a href='#' data-html='true' data-toggle='popover' data-content='".$course['intro']."' data-placement='bottom' data-trigger='focus' tabindex='0'><span class='label label-success'>介紹</span></a>";
					}
					echo "</td><td style='width:16%;'>".$course['max']."</td></tr>";
				}?>
			</table>
		</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
      </div>
    </div>
  </div>
</div>

<!-- 二三類業師 -->
<div class="modal fade" id="courseD" tabindex="-1" role="dialog" aria-labelledby="courseDLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="courseDLabel">[二三類] 業師</h4>
      </div>
      <div class="modal-body">
      
		<div class="panel panel-success">
			<div class="panel-heading">[二三類] 業師
			</div>
			<table class="table table-hover table-striped">
				<tr>
					<th>#</th>
					<th>課程名稱</th>
					<th>老師名稱</th>
					<th>人數上限</th>
				</tr>
				<?php
				$sql = "SELECT * FROM `course` WHERE `time` = \"D\" AND `id` LIKE \"E3%\";";
				$result = mysql_query($sql);
				while($course = mysql_fetch_array($result)){
					echo "<tr ><td style='width:16%;'>".$course['id']."</td>"."<td style='width:50%;'>".$course['name'];
					if($course['intro'] != "")
					{
						echo " <a href='#' data-html='true' data-toggle='popover' data-content='".$course['intro']."' data-placement='bottom' data-trigger='focus' tabindex='0'><span class='label label-success'>介紹</span></a>";
					}
					echo "</td><td style='width:16%;'>".$course['instr']."</td><td style='width:16%;'>".$course['max']."</td></tr>";
				}?>
			</table>
		</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
      </div>
    </div>
  </div>
</div>
<script>
	$(function () {
  $('[data-toggle="popover"]').popover()
})
function del_draw(){
	if(confirm("刪除志願將無法回復！請在選填時間內重新選擇志願！"))
	{
		document.location.href= "delete.php";
	}
}

function gowithalert1(target){
				if(confirm("請注意！執行抽籤後，將無法在更動志願序，一旦繼續，課程會馬上開始進行抽籤！確定要繼續嗎?"))
				{
					document.location.href= target;
				}
		}

</script>
</body>
</html>