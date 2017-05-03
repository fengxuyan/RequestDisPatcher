<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Add Product</title>
	<script src="  /RequestDisPatcher/JS/jquery-3.2.0.min.js"></script>

	<script src="  /RequestDisPatcher/JS/xcConfirm.js"></script>
	<link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/xcConfirm.css"/>
	<link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/layout.css">
	<link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/global.css">
	<link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/font-awesome.min.css">
	<style>
		.foot_btn{
			margin-top: 40px !important;
		}
		</style>
<script type="text/javascript">
	function quit() {
		var userInfo = document.cookie.match(new RegExp("(^| )userData=([^;]*)(;|$)"));
		$.ajax({
			type:"post",
			url:"  request/dispatcher.do",
			data: {
				url:"http://127.0.0.1:9001/login/logout",
				params:"token="+token
			},
			success: function (data) {
				userInfo='';

//
			},
			error: function (data) {
				var txt=data.Message;
				window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.info);
			}
		});
	}
	var userInfo = document.cookie.match(new RegExp("(^| )userData=([^;]*)(;|$)"));

	if(userInfo==null){
		window.location.href = "login.php";//location.href实现客户端页面的跳转
	};
$(document).ready(function(){
	var userInfo = document.cookie.match(new RegExp("(^| )userData=([^;]*)(;|$)"));
	var info = JSON.parse(userInfo[2]);
	var Info = info['userInfo'];
	var first = Info.firstName;
	var middle = Info.middleName;
	var last = Info.lastName;
	var gender = Info.gender;
	var token = info.token;
	var  image=Info.image;

	if(image==null){
		if(gender==1){

			$('#head').attr('src','Heads/header_man.png');

		}else if(gender==0){

			$('#head').attr('src','Heads/header_woman.png');

		}

	}else{
		$('#head').attr('src',image);
	}
	var device=Info.device;


	$.each(device, function(i, item) {

		$("#SN").val(item);
	});


	$("#delete_product").click(function(){
		$.ajax({
			type:"post",
			dataType:"json",
			url:"  request/dispatcher.do",
			data: {
				url:"http://101.37.100.209:9002/device/delete",
				params:"token="+token+"&sn="+$('#SN').val()
			},
			success: function (data) {
				console.log(data);
				if(data.Code==1){
					var txt='Unbundled success';
					window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.confirm);
				}else if(data.Code==0){
					var txt='Unbundled failed';
					window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.confirm);
				}
			},
			error: function (data) {
				var txt=data.Message;
				window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.confirm);
			}
		});


	});
});
	function js_method_healthy() {
		var userInfo = document.cookie.match(new RegExp("(^| )userData=([^;]*)(;|$)"));
		var info = JSON.parse(userInfo[2]);
		var Info = info['userInfo'];
		var first = Info.firstName;
		var middle = Info.middleName;
		var last = Info.lastName;
		var gender = Info.gender;
		var image = Info.image;

		var device = Info.device;
		if (device == null) {
			$(this).css('cursor', 'default');
			var txt = "请添加设备";
			window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);
//			return false;


		} else {
			location.href = "healthy.php";

		}
	}

	function js_method_real() {
		var userInfo = document.cookie.match(new RegExp("(^| )userData=([^;]*)(;|$)"));
		var info = JSON.parse(userInfo[2]);
		var Info = info['userInfo'];
		var first = Info.firstName;
		var middle = Info.middleName;
		var last = Info.lastName;
		var gender = Info.gender;
		var image=Info.image;

		var device=Info.device;
		if(device==null){
			$(this).css('cursor','default');
			var txt="请添加设备";
			window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);
//			return false;


		}else{
			location.href = "real.php";

		}

	}


	function js_method_delete() {
		var userInfo = document.cookie.match(new RegExp("(^| )userData=([^;]*)(;|$)"));
		var info = JSON.parse(userInfo[2]);
		var Info = info['userInfo'];
		var first = Info.firstName;
		var middle = Info.middleName;
		var last = Info.lastName;
		var gender = Info.gender;
		var image=Info.image;

		var device=Info.device;
		if(device==null){
			$(this).css('cursor','default');
			var txt="请添加设备";
			window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);
//			return false;


		}else{
			location.href = "deleteProduct.php";

		}

	}

</script>
</head>
<body>
<div class="holder">
	<div class="left_nav" >
		<div class="header_text">
			<div class="header_text_right">
				<span class="header_pic"><a href="modify.php" ><img src="Heads/default.jpg" id="head"></a></span>
			</div>
		</div>
		<ul>
			<a href="login.php"><li onclick="quit()"  >Logout</li></a>
			<a onclick="js_method_real()"><li>Real-time Data</li></a>
			<a onclick="js_method_healthy()"><li>Health Archives</li></a>
			<a href="addProduct.php"><li >Add device</li></a>
			<a onclick="js_method_delete()"><li class="on">Delete device</li></a>
		</ul>
	</div>

	<div class="right_show" style="overflow: hidden">
		<h4 class="titl">isleep</h4>
		<a href="homepage.php"><span class="home"></span></a>
		<div class="show_detail">
			<div class="show_detail_data">
				<div class="addpro">
					<h4 style="font-weight: bold; font-size: 18px;">Delete device</h4>
				</div>
				<h4 class="addpro number" >The SN of your smart
					mattress pad
				</h4>
				<!--<h4 class="addpro number dis">显示当前用户信息中该类设备SN</h4>-->
				<div class="panel_input reg_input mod_input">
					<input type="text" placeholder="input SN" id="SN" value=""  disabled="disabled"/>
				</div>
			</div>
		</div>
		<div class="foot_btn fo" >
			<input type="button" name="Submit" onclick="javascript:history.back(-1);" value="Back" class="submit_back">
			<input type="button" value="Submit" class="submit_submit" id="delete_product">
		</div>
	</div>
	</div>
	<!--<script src="  JS/mine.js"></script>-->
<script>
	$('.right_show').css("height",$(window).height());
	$('.left_nav').css("height",$(window).height());
</script>
</body>
</html>