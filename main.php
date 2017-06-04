<?php
	session_start();
	header("Content-Type:text/html; charset=utf-8");
	date_default_timezone_set("Asia/Taipei");
	//$phone = $_REQUEST['phone'];
	
	if(isset($_SESSION['token']) && $_SESSION['token']!= ""){
		$id = $_SESSION['token'];
	}
	else if(!isset($_REQUEST['id']))
	{
		header('Location: index.php?action=logout&err_msg=請先登入！');
		exit;
	}else{
		$id = $_REQUEST['id'];
		if (!empty($_POST['XSRF'])) {
    		if (hash_equals($_POST['XSRF'], $_SESSION['XSRF'])) {
				// Proceed to process the form data
			} else {
				 // Log this as a warning and keep an eye on these attempts
				header('Location: index.php?action=logout&err_msg=[XSRF]跨站請求偽造防護！檢驗值不正確');
				exit;
			}
		}else{
			header('Location: index.php?action=logout&err_msg=[XSRF]跨站請求偽造防護！沒有檢驗值');
			exit;
		}
	}
	if (!preg_match("/^([0-9A-Za-z]+)$/", $id)) {
    	header('Location: index.php?action=logout&err_msg=[SQL Injection防護]不合法的字元！');
		exit;
	}
	$dbhost = 'localhost';
    $dbuser = '';
    $dbpass = '';
    $dbname = 'cul';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');
    mysql_query("SET NAMES 'utf8'");
    mysql_select_db($dbname);
    $sql = "SELECT * FROM `user` WHERE `md5_ID` = \"$id\";";
    $result = mysql_query($sql);
    if (!(mysql_num_rows($result) == '1'))
    {
    	header('Location: index.php?action=logout&err_msg=找不到學員資料！');
		exit;
    }else{
		$data = mysql_fetch_array($result);
    	$_SESSION['token'] = $id;
    	if (function_exists('mcrypt_create_iv')) {
    		setcookie('XSFR',md5(bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM))."@cul5th"),time()+3600);
		} else {
			setcookie('XSFR',md5(bin2hex(openssl_random_pseudo_bytes(32))."@cul5th"),time()+3600);
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
  	<div class="container-fluid" style="margin-top: 30px;">
  		<div class="col-md-4 col-md-offset-4 col-sd-12 col-xs-12">
  			<div class="row margin-10px">
				<div class="input-group">
					<span class="input-group-addon">姓名</span>
					<input type="text" class="form-control" value="<?php echo $data["name"];?>" disabled>
				</div>
			</div>
			
			<div class="row margin-10px">
				<div class="input-group">
					<span class="input-group-addon">身分</span>
					<input type="text" class="form-control" value="學員" disabled>
				</div>
			</div>
			
			<div class="row margin-10px">
				<div class="input-group">
					<span class="input-group-addon">類別</span>
					<input type="text" class="form-control" value="<?php if($data["squad"] <= 10){echo "一類";}else{echo "二三類";}?>" disabled>
				</div>
			</div>
			<div class="row margin-10px">
				<div class="input-group">
					<span class="input-group-addon">小隊</span>
					<input type="text" class="form-control" value="<?php echo $data["squad"];?>" disabled>
				</div>
			</div>
			<hr>
			<div class="row margin-10px">
				<div class="input-group">
					<span class="input-group-addon">選課狀態</span>
					<?php
					$sql = "SELECT * FROM `wish` WHERE `user` = \"".$data['ID']."\";";
					$result = mysql_query($sql);
  					$rowcount = mysql_num_rows($result);
  					if($rowcount >0){$str = "已選課";}else{$str = "尚未選課";}
  					?>
					<input type="text" class="form-control" value="<?php echo $str;?>" disabled>
				</div>
			</div>
			<div class="row margin-10px">
				<div class="input-group">
					<span class="input-group-addon">選課權限</span>
					<?php
					$sql = "SELECT `open_select` FROM `settings` WHERE `no` = \"1\";";
					$result = mysql_query($sql);
					$open_sel = mysql_fetch_array($result);
  					?>
					<input type="text" class="form-control" value="<?php if($open_sel[0]){echo "開放選課";}else{echo "鎖定(未開放選課)";}?>" disabled>
				</div>
			</div>
			<div class="row">
				<a href='mycourse.php'><button type='button' id='course_btn' class='lf-btn lf-btn--right'>開始選課 >>  </button></a>
				<a href="index.php?action=logout&msg=已經登出，再見！"><button type="button" id="login_btn" class="lf-btn lf-btn--left" onclick=""><<　登出  </button></a>
			</div>
			
			
			
			
