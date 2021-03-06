<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>ChuangDian</title>
	<link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/layout.css">
	<link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/global.css">
	<link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/font-awesome.min.css">
	<script src="  /RequestDisPatcher/JS/jquery-3.2.0.min.js"></script>
	<script type="text/javascript">
		var userInfo = document.cookie.match(new RegExp("(^| )userData=([^;]*)(;|$)"));

		if(userInfo==null){
			window.location.href = "login.php";//location.href实现客户端页面的跳转
		};
		$(document).ready(function(){
			var userInfo = document.cookie.match(new RegExp("(^| )userData=([^;]*)(;|$)"));
			var info = JSON.parse(userInfo[2]);
			var Info=info['userInfo'];
			var first = Info.firstName;
			var middle = Info.middleName;
			var last = Info.lastName;
			var device = Info.device;
			var name;
			var token = info.token;


			if(token==''){
				location.href='login.html';

			};

			if(middle==null||middle==""){
				name = first+" "+last;
			}else{
				name = first+" "+middle+" "+last;
			}
			$("#user_name").text(name);

			var gender = info.gender;

			var gender = Info.gender;

			var image=Info.image;

			if(image=='null'){
				if(gender==1){

					$('#head').attr('src','Heads/header_man.png');

				}else if(gender==0){

					$('#head').attr('src','Heads/header_woman.png');

				}

			}else{
				$('#head').attr('src',image);
			}

			//未绑定设备
			if(device == null || device.length == 0){
				document.getElementById("realData").style = "cursor:not-allowed;background-image:url('  images/real.png')";
				document.getElementById("realData").href = "javascript:void(0)";
				document.getElementById("realData").title = "No Device.Can not View!";
				document.getElementById("healthyData").style = "cursor:not-allowed;background-image:url('  images/healthy.png')";
				document.getElementById("healthyData").href = "javascript:void(0)";
				document.getElementById("healthyData").title = "No Device.Can not View!";
				document.getElementById("deleteProduct").style = "cursor:not-allowed;background-image:url('  images/delete.png')";
				document.getElementById("deleteProduct").href = "javascript:void(0)";
				document.getElementById("deleteProduct").title = "No Device.Can not View!";
			}

			if(image==null){
				if(gender==1){

					$('#head').attr('src','Heads/header_man.png');

				}else if(gender==0){

					$('#head').attr('src','Heads/header_woman.png');

				}

			}else{
				$('#head').attr('src',image);
			}
		});
	</script>
</head>

<body>
<div class="holder">
	<div class="header">
		<div class="header_scroll">
			<h2>isleep</h2>
		</div>
		<div class="header_text">
			<div class="header_text_left">
				<a href="homepage.php"><span class="home" style="		top: 33px;
				float: left;
				right: -13px;"></span></a>
			</div>
			<div class="header_text_right">
				<span class="header_pic"><a href="modify.php" ><img  id="head"></a></span>
				<a href="modify.php"><span>Personal Information</span></a><a href="login.php"><span onclick="quit()" >Logout</span></a>
			</div>
		</div>
	</div>
	<div class="content_icon">
		<ul class="content_icon_list zhineng">
			<li><a href="real.php" id = "realData"><span>Real-time Data</span></a></li>
			<li><a href="healthy.php" id="healthyData"><span>Health Archives</span></a></li>
			<li><a href="addProduct.php" id="addProduct"><span>Add device</span></a></li>
			<li><a href="deleteProduct.php" id ="deleteProduct"><span>Delete device</span></a></li>
		</ul>
	</div>
</div>
</body>
</html>