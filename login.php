<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>Login</title>
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="expires" content="0">
	<meta http-equiv="keywords" content="keyword1,keyword2,keyword3">
	<meta http-equiv="description" content="This is my page">
	  <script src="  /RequestDisPatcher/JS/jquery-3.2.0.min.js"></script>
	  <script src="  /RequestDisPatcher/JS/xcConfirm.js"></script>
	  <link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/xcConfirm.css"/>
	<link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/layout.css">
	<link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/global.css">
	<link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/font-awesome.min.css">

<script type="text/javascript">
	function checkLogin(){
		var x1 = $('#Email').val();
		var x2 = $('#password').val();
		if(x1==null||x1==""||x2==null||x2==""){
			alert("Email or Password should not Be Empty!");
			return false;
		}
	}
	$(document).ready(function(){
		$(".login_submit").click(function(){
			checkLogin();
			var x1 = $('#Email').val();
			var x2 = $('#password').val();
			if(x1==null||x1==""||x2==null||x2==""){

				var txt="Email or Password should not Be Empty!";
				window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);
			}else{




				$.ajax({
				type:"POST",
				url:"  request/dispatcher.do",
				data:{
					url:"http://127.0.0.1:9001/login/login",
					Email:$('#Email').val(),
					params:"email="+$('#Email').val()+"&password="+$('#password').val()
				},
				dataType:"json",
				success:function(data){

//					1、成功，1001、用户不存在，1000、邮箱或者密码错误


					console.log(data);
if(data.Code==1){
							document.cookie="userData="+JSON.stringify(data.Data);
							document.cookie="dluEmail="+$('#Email').val();
							document.cookie="dlumima="+$('#password').val();
							document.cookie="token="+JSON.stringify(data.Data.token);
	window.location.href="homepage.php";
}else if(data.Code==1001){
	var txt="User does not exist";
	window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);
}
else if(data.Code==1000) {
	var txt="Email or Password Error";
	window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);
}
					},
				error:function(data,Code){
					var txt="Unkonw Error.Please Try Again!";
					window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);

					}
				});
			}
		});
			var myEmail = document.cookie.match(new RegExp("(^| )dluEmail=([^;]*)(;|$)"));
			var myPassword = document.cookie.match(new RegExp("(^| )dlumima=([^;]*)(;|$)"));
			$('#Email').val(myEmail[2]);
			$('#password').val(myPassword[2]);
	});
</script>

</head>
<body>
  <div class="login">
	  <div class="login_panel">
		  <div class="panel_text">
			  <h2>Sign In</h2>
		  </div>
		  <div class="panel_input email">
			  <input type="text" placeholder="E-mail" id="Email" value="" />
		  </div>
		  <div class="panel_input pwd">
			  <input type="password" placeholder="Password" id="password" />
		  </div>
		  <div class="panel_input_text">
			    <input class="login_submit" type="button" value="Log In" ><a href="forget.php"><span>Forget Password</span></a>
		  </div>
		  <div class="panel_foot">
			  <div class="form_register">
				  <a href="register.php" class="register_front" id="register_page">REGISTER AN ACCOUNT</a>
			  </div>
		  </div>
	  </div>
  </div>
  </body>
</html>
