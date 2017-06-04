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
	function sel(id)
	{
		document.getElementById("user_id1").value = id;
		document.getElementById("user_id2").value = id;
		$('html,body').animate({

                 scrollTop:$('#user_id1').offset().top

               }, 'show');
	
	}
</script>
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
	header("Content-Type:text/html; charset=utf-8");
	date_default_timezone_set("Asia/Taipei");
	$dbhost = 'localhost';
    $dbuser = '';
    $dbpass = '';
    $dbname = 'cul';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');
    mysql_query("SET NAMES 'utf8'");
    mysql_select_db($dbname);
    
   	$sql = "SELECT `id`,`name`,`instr`,`intro` FROM `course` WHERE 1;";
    $result = mysql_query($sql);
    while($x = mysql_fetch_array($result))
    {
    	$c_name[$x[0]] = $x[1];
    }
    
    if($_SESSION["admin"] == 1)
    {?>
    	
<div class="btn-group" role="group" aria-label="...">
  <a href="#list-1"><button type="button" class="btn btn-default">學員選課清單</button></a>
  <a href="#list-2"><button type="button" class="btn btn-default">課程選課人數</button></a>
  <a href="#list-3"><button type="button" class="btn btn-default">進階操作</button></a>
</div>

<h4>小隊快速查詢</h4>

<div class="btn-toolbar" role="toolbar" aria-label="...">
  <div class="btn-group" role="group" aria-label="1">
  <?php 
  for($i=1;$i<=10;$i++)
  {
  	echo "<a href='#list-1-".$i."'><button type='button' class='btn btn-default'>".$i."</button></a>";
  }
  ?>
  </div><br><br>
  <div class="btn-group" role="group" aria-label="2">
  <?php 
  for($i=11;$i<=26;$i++)
  {
  	echo "<a href='#list-1-".$i."'><button type='button' class='btn btn-default'>".$i."</button></a>";
  }
  ?>
  </div>
</div>
<h1>學員選課清單</h1>
<div class="alert alert-info">
白底：未填志願、未抽籤（狀態顯示：<span class='glyphicon glyphicon-remove'></span>）<br>
黃底：已填志願、未抽籤（狀態顯示：<span class='glyphicon glyphicon-pause'></span>）<br>
綠底：已抽籤完成（狀態顯示：<span class='glyphicon glyphicon-ok'></span> + 完成時間）<br>
點選學員姓名旁的登入可以以該學員身份登入選課！</div>
<div name="list-1">
<table class="table table-bordered table-striped">
<tr><td>小隊</td><td>姓名</td><td>時段1</td><td>時段2</td><td>時段3</td><td>時段A</td><td>時段B</td><td>狀態</td></tr>
<?php $sql = "SELECT user.squad,user.name,result.course1,result.course2,result.course3,result.courseA,result.courseB,result.timesp,user.ID FROM `user` left join `result` on user.ID = result.ID where 1 ORDER BY squad ASC;";$result = mysql_query($sql);while($data = mysql_fetch_array($result))
{
	$sqla = "SELECT * FROM `wish` WHERE `user` = \"".$data[8]."\" ;";
	$resulta = mysql_query($sqla);
  	$rowcount = mysql_num_rows($resulta);
	echo "<tr class='";
	if($data[7] != "")
	{echo "success";}else if($rowcount !=0){echo "warning";}
	echo "' id='list-1-".$data[0]."'>";
	
	echo "<td style='width:5%'>".$data[0]."</td>";
	echo "<td style='width:10%'><a href='#' onclick='sel(\"".$data[8]."\");'>".$data[1]."</a> <a target='_blank' href='../index.php?pass_val=".$data[8]."'><span class='label label-info' style='text-align:right;'> 登入</span></a></td>";
	echo "<td style='width:15%'>".$data[2]."<br>".$c_name[$data[2]]."</td>";
	echo "<td style='width:15%'>".$data[3]."<br>".$c_name[$data[3]]."</td>";
	echo "<td style='width:15%'>".$data[4]."<br>".$c_name[$data[4]]."</td>";
	echo "<td style='width:15%'>".$data[5]."<br>".$c_name[$data[5]]."</td>";
	echo "<td style='width:15%'>".$data[6]."<br>".$c_name[$data[6]]."</td>";
	if($data[7] != "")
	{
		echo "<td style='width:10%'><span class='glyphicon glyphicon-ok'></span> ".$data[7]."</td>";
	}else{
		
  		if($rowcount ==0)
  		{
  			echo "<td style='width:10%'><span class='glyphicon glyphicon-remove'></span></td>";
  		}else{
  			echo "<td style='width:10%'><span class='glyphicon glyphicon-pause'></span></td>";
  		}
	}
	
	
	echo "</tr>";
}?>
</table>
</div>
<h1>課程選課人數</h1>
<div id="list-2">

<h2>時段一</h2>
<table class="table table-bordered table-striped">
	<tr><td>時段</td><td>編號</td><td>課程</td><td>老師</td><td>已選人數</td><td>最大人數</td></tr>
<?php $sql = "SELECT course.id,course.name,course.instr,course.max,course.time FROM `course` where course.time =\"1\" ORDER BY id ASC;";$result = mysql_query($sql);while($data = mysql_fetch_array($result))
{		echo "<tr>";
    	echo "<td style='width:5%'>".$data[4]."</td>";
		echo "<td style='width:15%'>".$data[0]."</td>";
		echo "<td style='width:20%'>".$data[1]." <a href='courselist.php?no=".$data[0]."'><span class='label label-success'>名單</span></a></td>";
		echo "<td style='width:15%'>".$data[2]."</td>";
		
		$sqla = "SELECT * FROM `result` WHERE `course1` = \"".$data[0]."\";";
		$resulta = mysql_query($sqla);
  		$rowcount = mysql_num_rows($resulta);
  		echo "<td style='width:10%'>".$rowcount." <span class='label label-success'>".floor(($rowcount/$data[3])*100)." %</span></td>";
		echo "<td style='width:10%'>".$data[3]."</td>";

		echo "</tr>";
}?>
</table>

<h2>時段二</h2>
<table class="table table-bordered table-striped">
	<tr><td>時段</td><td>編號</td><td>課程</td><td>老師</td><td>已選人數</td><td>最大人數</td></tr>
<?php $sql = "SELECT course.id,course.name,course.instr,course.max,course.time FROM `course` where course.time =\"2\" ORDER BY id ASC;";$result = mysql_query($sql);while($data = mysql_fetch_array($result))
{		echo "<tr>";
    	echo "<td style='width:5%'>".$data[4]."</td>";
		echo "<td style='width:15%'>".$data[0]."</td>";
		echo "<td style='width:20%'>".$data[1]." <a href='courselist.php?no=".$data[0]."'><span class='label label-success'>名單</span></a></td>";
		echo "<td style='width:15%'>".$data[2]."</td>";
		
		$sqla = "SELECT * FROM `result` WHERE `course2` = \"".$data[0]."\";";
		$resulta = mysql_query($sqla);
  		$rowcount = mysql_num_rows($resulta);
  		echo "<td style='width:10%'>".$rowcount." <span class='label label-success'>".floor(($rowcount/$data[3])*100)." %</span></td>";
		echo "<td style='width:10%'>".$data[3]."</td>";

		echo "</tr>";
}?>
</table>

<h2>時段三</h2>
<table class="table table-bordered table-striped">
	<tr><td>時段</td><td>編號</td><td>課程</td><td>老師</td><td>已選人數</td><td>最大人數</td></tr>
<?php $sql = "SELECT course.id,course.name,course.instr,course.max,course.time FROM `course` where course.time =\"3\" ORDER BY id ASC;";$result = mysql_query($sql);while($data = mysql_fetch_array($result))
{		echo "<tr>";
    	echo "<td style='width:5%'>".$data[4]."</td>";
		echo "<td style='width:15%'>".$data[0]."</td>";
		echo "<td style='width:20%'>".$data[1]." <a href='courselist.php?no=".$data[0]."'><span class='label label-success'>名單</span></a></td>";
		echo "<td style='width:15%'>".$data[2]."</td>";
		
		$sqla = "SELECT * FROM `result` WHERE `course3` = \"".$data[0]."\";";
		$resulta = mysql_query($sqla);
  		$rowcount = mysql_num_rows($resulta);
  		echo "<td style='width:10%'>".$rowcount." <span class='label label-success'>".floor(($rowcount/$data[3])*100)." %</span></td>";
		echo "<td style='width:10%'>".$data[3]."</td>";

		echo "</tr>";
}?>
</table>

<h2>一類實作1</h2>
<table class="table table-bordered table-striped">
	<tr><td>時段</td><td>編號</td><td>課程</td><td>老師</td><td>已選人數</td><td>最大人數</td></tr>
<?php $sql = "SELECT course.id,course.name,course.instr,course.max,course.time FROM `course` where course.time =\"A\" ORDER BY id ASC;";$result = mysql_query($sql);while($data = mysql_fetch_array($result))
{		echo "<tr>";
    	echo "<td style='width:5%'>".$data[4]."</td>";
		echo "<td style='width:15%'>".$data[0]."</td>";
		echo "<td style='width:20%'>".$data[1]." <a href='courselist.php?no=".$data[0]."'><span class='label label-success'>名單</span></a></td>";
		echo "<td style='width:15%'>".$data[2]."</td>";
		
		$sqla = "SELECT * FROM `result` WHERE `courseA` = \"".$data[0]."\";";
		$resulta = mysql_query($sqla);
  		$rowcount = mysql_num_rows($resulta);
  		echo "<td style='width:10%'>".$rowcount." <span class='label label-success'>".floor(($rowcount/$data[3])*100)." %</span></td>";
		echo "<td style='width:10%'>".$data[3]."</td>";

		echo "</tr>";
}?>
</table>

<h2>一類實作2</h2>
<table class="table table-bordered table-striped">
	<tr><td>時段</td><td>編號</td><td>課程</td><td>老師</td><td>已選人數</td><td>最大人數</td></tr>
<?php $sql = "SELECT course.id,course.name,course.instr,course.max,course.time FROM `course` where course.time =\"B\" ORDER BY id ASC;";$result = mysql_query($sql);while($data = mysql_fetch_array($result))
{		echo "<tr>";
    	echo "<td style='width:5%'>".$data[4]."</td>";
		echo "<td style='width:15%'>".$data[0]."</td>";
		echo "<td style='width:20%'>".$data[1]." <a href='courselist.php?no=".$data[0]."'><span class='label label-success'>名單</span></a></td>";
		echo "<td style='width:15%'>".$data[2]."</td>";
		
		$sqla = "SELECT * FROM `result` WHERE `courseB` = \"".$data[0]."\";";
		$resulta = mysql_query($sqla);
  		$rowcount = mysql_num_rows($resulta);
  		echo "<td style='width:10%'>".$rowcount." <span class='label label-success'>".floor(($rowcount/$data[3])*100)." %</span></td>";
		echo "<td style='width:10%'>".$data[3]."</td>";

		echo "</tr>";
}?>
</table>

<h2>二三類實作</h2>
<table class="table table-bordered table-striped">
	<tr><td>時段</td><td>編號</td><td>課程</td><td>老師</td><td>已選人數</td><td>最大人數</td></tr>
<?php $sql = "SELECT course.id,course.name,course.instr,course.max,course.time FROM `course` where course.time =\"C\" ORDER BY id ASC;";$result = mysql_query($sql);while($data = mysql_fetch_array($result))
{		echo "<tr>";
    	echo "<td style='width:5%'>".$data[4]."</td>";
		echo "<td style='width:15%'>".$data[0]."</td>";
		echo "<td style='width:20%'>".$data[1]." <a href='courselist.php?no=".$data[0]."'><span class='label label-success'>名單</span></a></td>";
		echo "<td style='width:15%'>".$data[2]."</td>";
		
		$sqla = "SELECT * FROM `result` WHERE `courseA` = \"".$data[0]."\";";
		$resulta = mysql_query($sqla);
  		$rowcount = mysql_num_rows($resulta);
  		echo "<td style='width:10%'>".$rowcount." <span class='label label-success'>".floor(($rowcount/$data[3])*100)." %</span></td>";
		echo "<td style='width:10%'>".$data[3]."</td>";

		echo "</tr>";
}?>
</table>

<h2>業師</h2>
<table class="table table-bordered table-striped">
	<tr><td>時段</td><td>編號</td><td>課程</td><td>老師</td><td>已選人數</td><td>最大人數</td></tr>
<?php $sql = "SELECT course.id,course.name,course.instr,course.max,course.time FROM `course` where course.time =\"D\" ORDER BY id ASC;";$result = mysql_query($sql);while($data = mysql_fetch_array($result))
{		echo "<tr>";
    	echo "<td style='width:5%'>".$data[4]."</td>";
		echo "<td style='width:15%'>".$data[0]."</td>";
		echo "<td style='width:20%'>".$data[1]." <a href='courselist.php?no=".$data[0]."'><span class='label label-success'>名單</span></a></td>";
		echo "<td style='width:15%'>".$data[2]."</td>";
		
		$sqla = "SELECT * FROM `result` WHERE `courseB` = \"".$data[0]."\";";
		$resulta = mysql_query($sqla);
  		$rowcount = mysql_num_rows($resulta);
  		echo "<td style='width:10%'>".$rowcount." <span class='label label-success'>".floor(($rowcount/$data[3])*100)." %</span></td>";
		echo "<td style='width:10%'>".$data[3]."</td>";

		echo "</tr>";
}?>
</table>

</div>
    	
    	
<h1>進階操作</h1>
<div id="list-3">
<form id="form1" name="form1" action="delete.php">
<table class="table table-bordered table-striped">
	<tr>
		<td>學員ＩＤ</td><td>刪除志願序</td><!--<td>刪除選課資料</td>-->
	</tr>
	<tr>
		<td style="width:33%">
			<div class="input-group">
				<span class="input-group-addon">ＩＤ</span>
				<input type="text" class="form-control" name="user_id1" id="user_id1" placeholder="請點選名單姓名" readonly>
			</div>
		</td>
		<td style="width:33%">
			<div class="btn-group btn-group" style="margin-top:10px;" role="group" aria-label="submit1">
				<div class="btn-group" role="group" aria-label="submit1">
					<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> 刪除志願序</button>
				</div>
			</div>
		</td>
		<!--
		<td style="width:33%">
			<div class="btn-group btn-group" style="margin-top:10px;" role="group" aria-label="submit2">
				<div class="btn-group" role="group" aria-label="submit2">
					<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> 刪除選課資料</button>
				</div>
			</div>
		</td>
		-->
	</tr>

</table>
</form>
<form id="form2" name="form2" action="delete2.php">
<table class="table table-bordered table-striped">
	<tr>
		<td>學員ＩＤ</td><!--<td>刪除志願序</td>--><td>刪除選課資料</td>
	</tr>
	<tr>
		<td style="width:33%">
			<div class="input-group">
				<span class="input-group-addon">ＩＤ</span>
				<input type="text" class="form-control" name="user_id2" id="user_id2" placeholder="請點選名單姓名" readonly>
			</div>
		</td>
		<!--<td style="width:33%">
			<div class="btn-group btn-group" style="margin-top:10px;" role="group" aria-label="submit1">
				<div class="btn-group" role="group" aria-label="submit1">
					<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> 刪除志願序</button>
				</div>
			</div>
		</td>-->
		
		<td style="width:33%">
			<div class="btn-group btn-group" style="margin-top:10px;" role="group" aria-label="submit2">
				<div class="btn-group" role="group" aria-label="submit2">
					<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> 刪除選課資料</button>
				</div>
			</div>
		</td>
		
	</tr>

</table>
</form>
</div>

    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    <?php }
    else if($id == "cul" && $pw == "0932020255")
    {
    	$_SESSION["admin"] = "1";
    	header('Location: index.php');
		exit;
    }else
    {?>
	<div class="jumbotron">
		<div class="container">
			<h2>第五屆大學生活體驗營 ｜ 選課管理後台</h2>
			<p>營隊工作人員請由此登入，查看學員選課狀況與選課名單<br>有任何操作問題請聯繫：0931-751-352 或 02-2363-1066 #20608</p>
			<div class="col-md-6 col-md-offset-3 col-sd-12 col-xs-12">
			<form method="post">
				<div class="input-group">
					<span class="input-group-addon">帳號</span>
					<input type="text" class="form-control" name="id" placeholder="請輸入帳號">
				</div>
				<div class="input-group">
					<span class="input-group-addon">密碼</span>
					<input type="password" class="form-control" name="pw" placeholder="請輸入密碼">
				</div>
				<div class="btn-group btn-group" style="margin-top:10px;" role="group" aria-label="submit">
					<div class="btn-group" role="group" aria-label="submit">
						<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-chevron-right"></span> 登入</button>
					</div>
				</div>
			</form>
			</div>
		</div>
	</div>
    
	<?php }?>