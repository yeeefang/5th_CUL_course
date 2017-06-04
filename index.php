<?php
	header("Content-Type:text/html; charset=utf-8");
	session_start();
	$_SESSION['token'] = "";
	//XSRF-PROTECTION    --start
	if (empty($_SESSION['XSRF'])) {
    	if (function_exists('mcrypt_create_iv')) {
    	   $_SESSION['XSRF'] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
		} else {
			$_SESSION['XSRF'] = bin2hex(openssl_random_pseudo_bytes(32));
		}
	}
	$XSRF = $_SESSION['XSRF'];
	//XSRF-PROTECTION    --end	
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
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-80204569-1', 'auto');
  ga('send', 'pageview');

</script>
  </head>

  <body onload="$('#submit_btn').removeAttr('disabled');">
  	<div class="container-fluid">
  		<div class="row">
  			<div class="col-md-12 col-sd-12" style="overflow:hidden;text-align:center;background-color:#FFFFFF">
  				<img style="width:100%;max-height:200px;max-width:1168px;" src="image/cover.png"/>
  			</div>
  		</div>
  	</div>
  	<div class="container-fluid" style="margin-top: 30px;">
  		<form class="form-horizontal" role="form" method="POST" action="main.php" id="login_form1" onsubmit="$('#submit_btn').attr('disabled','disabled');">
  		
  			<div class="col-md-4 col-md-offset-4 col-sd-12 col-xs-12">
  				
				
  				<div class="row" style="margin-top:15px;margin-bottom:10px;">
					<h1 style="color: white;font-size:40px">網路選課系統</h1>
				</div>
				<?php
				$load = sys_getloadavg();
				if ($load[0] > 80) {?>
				<div class="row alert alert-warning" style="font-size:20px;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><strong>請注意！ </strong> 目前系統負載量較高(<?php echo $load[0];?>%)，請等待反應時間。</div>
				<?php }?>
				
				<?php
					if(isset($_GET['msg'])){?>
						<div class="row alert alert-info" id="noti_msg" style="font-size:20px;"><strong> <?php echo $_GET['msg'];?> </strong> </div>
					<?php }else if(isset($_GET['err_msg']))
					{?>
						<div class="row alert alert-danger" id="noti_msg" style="font-size:20px;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><strong>錯誤！ </strong> <?php echo $_GET['err_msg'];?></div>
					<?php }else{?>
						<div class="row alert alert-success" id="noti_msg" style="font-size:20px;"><strong>Hello！ </strong>請輸入身分證字號以登入系統</div>
				<?php }?>
				<noscript>
					<div class="row alert alert-danger" style="font-size:20px;"><strong>錯誤！ </strong> 不支援JavaScript！</div>
				</noscript>
				<!--<div class="form-group" style="margin-top:15px;color: white;font-size:16px">
					<label for="phone">手機號碼 Phone Num</label>
					<input class="input-txt" type="text" name="phone" id="phone" placeholder="0932020255" required="required" maxlength="10"/>
				</div>-->
				<div class="form-group" style="margin-top:15px;color: white;font-size:16px">
					<label for="id">身分證字號 ID Num.(不區分大小寫)</label>
					<input class="input-txt" type="password" name="id" id="id" placeholder="A123456789" required="required" maxlength="10" value='<?php echo $_GET["pass_val"];?>'/>
					<input type="hidden" name="XSRF" id="XSRF" required="required" value="<?php echo $XSRF;?>"/>
				</div>
				
				
				<div class="row">
					<a href="#" class="lf-lnk" data-toggle="modal" data-target="#forgetpw">
						<span class="lf-icon lf-icon--min"></span> 
						無法登入 / 我不知道這是什麼(?)
					</a>
				</div>
				<div class="row">
					<button type="button" id="submit_btn" class="lf-btn lf-btn--left" onclick="call_login()" disabled="disabled">登入 Sign In  </button>
				</div>
				
			</div>
		
		</form>
	</div>
  
	<script src="js/index.js"></script>
	<script src="js/md5.min.js"></script>
	<script>
		function checkID(id){
		var abbr = new Array(1,10,19,28,37,46,55,64,39,73,82,2,11,20,48,29,38,47,56,65,74,83,21,3,12,30);
		id = id.toUpperCase();
		if(id.search(/^[A-Z](1|2)\d{8}$/i) == -1)
		{
			return false;
		}
		else
		{
			id = id.split('');
			var total = abbr[id[0].charCodeAt(0)-65];
			for(var i=1;i<=8;i++)
			{
				total += eval(id[i] * (9-i));
			}
			total += eval(id[9]);
			if(total%10 == 0){
				return true;
			}
			else
			{
				return false;
			}
		}
	}
		
		
		function call_login(){
		//var phone = document.getElementById("phone").value;
		var id = document.getElementById("id").value;
		var msg = document.getElementById("noti_msg");
		/*if((phone.substr(0,2) != '09') ||(phone.length != 10)){
			alert('電話號碼的格式有誤！');
		}else */if(!checkID(id)){
			$("#noti_msg").removeClass("alert-info");
			$("#noti_msg").removeClass("alert-success");
			$("#noti_msg").addClass("alert-danger");
			msg.innerHTML = "身分證字號格式不正確！";
		}else{
			$("#noti_msg").removeClass("alert-danger");
			$("#noti_msg").removeClass("alert-success");
			$("#noti_msg").addClass("alert-info");
			msg.innerHTML = "登入中，請稍後...";
			document.getElementById("id").removeAttribute("maxlength");
			$('#id').val(hex_md5(id.toUpperCase()));
			$('#login_form1').submit();
		}
		
	}
	$("*").keypress(function(e) {
    code = e.keyCode ? e.keyCode : e.which; // in case of browser compatibility
    if(code == 13) {
        e.preventDefault();
        call_login();
        $("#noti_msg").removeClass("alert-danger");
			$("#noti_msg").removeClass("alert-success");
			$("#noti_msg").addClass("alert-info");
			msg.innerHTML = "登入中，請稍後...";
        }
    });
	</script>

<!-- Modal -->
<div class="modal fade" id="forgetpw" tabindex="-1" role="dialog" aria-labelledby="forgetpwLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="forgetpwLabel">登入幫助</h4>
      </div>
      <div class="modal-body">
        請以報名時所填的手機號碼與身分證字號(不區分英文字母大小寫)來登入選課系統。
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>

<style>
html,body {
  background-color: #5D92BA;
  font-family: "微軟正黑體", sans-serif;
}
.input-txt {
  width: 100%;
  padding: 20px 10px;
  background: #5D92BA;
  border: none;
  font-size: 1em;
  color: white;
  border-bottom: 1px dotted rgba(250, 250, 250, 0.4);
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  -moz-transition: background-color 0.5s ease-in-out;
  -o-transition: background-color 0.5s ease-in-out;
  -webkit-transition: background-color 0.5s ease-in-out;
  transition: background-color 0.5s ease-in-out;
}
.input-txt:-moz-placeholder {
  color: #81aac9;
}
.input-txt:-ms-input-placeholder {
  color: #81aac9;
}
.input-txt::-webkit-input-placeholder {
  color: #81aac9;
}
.input-txt:focus {
  background-color: #4478a0;
}
.lf-btn {
  padding: 15px 30px;
  border: none;
  background: white;
  color: #5D92BA;
}

.lf-btn--right {
  float: right;
}

.lf-icon {
  display: inline-block;
}
.lf-icon--min {
  font-size: .9em;
}
.lf-lnk {
  font-size: .8em;
  line-height: 3em;
  color: white;
  text-decoration: none;
}
</style>
  </body>
  <script>
	console.log("嗨！歡迎來到這裡的勇者，想必你會看到這些文字，肯定對資訊工程相當有興趣吧！我是台灣大學資訊工程學系的Jerry，營期會隨機出現，歡迎來找我玩~~");
</script>

</html>
