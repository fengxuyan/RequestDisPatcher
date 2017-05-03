<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<base href="<%=basePath%>">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Forget Password</title>
	<!--<link rel="stylesheet" href="  CSS/bootstrap.min.css">-->
	<script src="  /RequestDisPatcher/JS/jquery-3.2.0.min.js"></script>
	<script src="  /RequestDisPatcher/JS/xcConfirm.js"></script>


	<link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/xcConfirm.css"/>
	<link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/layout.css">
	<link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/global.css">
	<link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/font-awesome.min.css">
<script type="text/javascript">


	var myEmail = document.cookie.match(new RegExp("(^| )dluEmail=([^;]*)(;|$)"));



$(document).ready(function(){
	$('#email').val(myEmail[2]);
	$("#submit").click(function(){
		var Email = document.getElementById("email").value;
		$.ajax({
			type:"post",
			url:"  request/dispatcher.do",
			data:{
				url:"http://127.0.0.1:9001/login/forget",
				params:"email="+Email
			},
			dataType:"json",
			success:function(data){
				console.log(data);


					if(data.Code==1){
//						window.location.href="  login.html";
						window.location.href="  verifi.php?email="+Email;
					}else if(data.Code==1001){
						var txt="The email address does not exist";
						window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);
					}
				},
			error:function(){
				var txt="Unkonw Error.Please Try Again!";
				window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.info);
				}
		});
	});
});
	function goback() {
//		location.href = "homepage.html";
		history.go(-1);
	}
</script>
</head>
<body>
<div class="holder">
	<div class="header">
		<div class="header_scroll">
			<h2>isleep</h2>
		</div>
		<div class="header_text" style=" height: 78px;">
			<h2 class="title" >Forget Password</h2>
		</div>
	</div>
	<div>
		<div class="foPwdTxt">
			<h2 class="title Email">Enter your e-mail address to get your password.</h2>
		</div>
		<div class="foPwdTxt">
			<h2 class="title Email">E-mail</h2>
		</div>
		<div class="panel_input" style="border:2px solid #8A847F;    border-radius: 26px;height:49px !important;">
			<input type="text" placeholder="Email" name="Email" class="email" id="email" value="">
		</div>
		<div class="foot_btn fo" style=" margin-top: 60px;">
			<input type="button" name="Submit" onclick="goback()" value="Back" class="submit_back">
			<input type="button" value="Submit" class="submit_submit" id="submit">
		</div>
	</div>
</div>
</body>

<!--<link rel="stylesheet" type="text/css" href="/SleepMonitor/CSS/forget.css">-->
</html>