<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Add Product</title>
	<script src="  /RequestDisPatcher/JS/jquery-3.2.0.min.js"></script>
	<link rel="stylesheet" type="text/css" href=" /RequestDisPatcher/CSS/layout.css">
	<link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/global.css">
	<link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/font-awesome.min.css">
	<script src="  /RequestDisPatcher/JS/xcConfirm.js"></script>
	<link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/xcConfirm.css"/>

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
	var token = Info.token;
	var  image=Info.image;
	var token = info.token;


	if(token==''){
		location.href='login.php';

	};

	if(image==null){
		if(gender==1){

			$('#head').attr('src','Heads/header_man.png');

		}else if(gender==0){

			$('#head').attr('src','Heads/header_woman.png');

		}

	}else{
		$('#head').attr('src',image);
	}

	$.ajax({
		type:"post",
		url:"  request/dispatcher.do",
		data:{
			url:"http://127.0.0.1:9001/login/getInfo",
			params:"token="+token
		},
		dataType:"json",
		success:function(data){

		},
		error:function(data){

			alert("Unkonw Error.Please Try Again!");
		}
	});

	$("#add_product").click(function(){
		if($("#SN").val().length<20){
			var txt = 'No less than 20 digits';
			window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);

		}else{
			$.ajax({
				type:"post",
				url:"  request/dispatcher.do",
				data:{
					url:"http://127.0.0.1:9002/device/add",
					params:"token="+token+"&sn_all="+$("#SN").val()
				},
				dataType:"json",
//			1001、sn不存在，1002已经绑定成功，1009同一类型的设备重复绑定，1、绑定成功，0绑定失败

//
				success:function(data) {
					console.log(data);

					if (data.Code == 1001) {
						var txt = 'SN does not exist';
						window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);
					}else if(data.Code == 1002){
						var txt = 'Operate successfully';
						window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);
					}else if(data.Code == 1009){
						var txt = 'Bound the same type devices';
						window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);
					}else if(data.Code == 1){

						var txt = 'Bound successfully';
						window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);
					}else if(data.Code == 0){

						var txt = 'Bound failed';
						window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);
					}

				},
				error:function(data){
					console.log(data);
					var txt="Unkonw Error.Please Try Again!";
					window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);
				}
			});

		};

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
			var txt = "Not found your device";
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
				var txt="Not found your device";
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
			var txt="Not found your device";
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
			<a onclick="js_method_real()" ><li>Real-time Data</li></a>
			<a onclick="js_method_healthy()"><li>Health Archives</li></a>
			<a href="addProduct.php" ><li class="on">Add device</li></a>
			<a onclick="js_method_delete()"><li>Delete device</li></a>
		</ul>
	</div>
	<div class="right_show" style="overflow: hidden">
		<h4 class="titl">isleep</h4>
		<a href="homepage.php"><span class="home"></span></a>
		<div class="show_detail">
			<div class="show_detail_data">
				<div class="addpro">
					<h4 style="    font-weight: bold; font-size: 18px;">Add device</h4>
				</div>
				<div class="foPwdTxt">
					<div class="panel_input" >
						<input type="text" placeholder="Enter SN manually" id="SN" value=""  style="border: 2px solid #ddd;border-radius: 25px"/>
					</div>
				</div>
				<!--<div class="sao">-->
					<!--<a><img src="images/sao.png" /><span>扫一扫</span></a>-->
				<!--</div>-->
				<div class="foot_btn fo" >
					<input type="button" name="Submit" onclick="javascript:history.back(-1);" value="Back" class="submit_back">
					<input type="button" value="Submit" class="submit_submit" id="add_product">
				</div>
			</div>
		</div>
	</div>
	</div>
	<!--<script src="  JS/mine.js"></script>-->
<script>

		$('.right_show').css("height", $(window).height());
		$('.left_nav').css("height", $(window).height());

</script>
</body>
<!--<body id="add">-->
	<!--<div id="info">-->
	<!--<h3 style="margin-top: -10px;">Add Product</h3>-->
	<!--<h4 style="float:left;margin-top: -10px;">Please Input Your SN:</h4>-->
	<!--<input type="text" id="SN" placeholder="SN">-->
	<!--<input type="button" name="Submit" onclick="javascript:history.back(-1);" value="Back" id="back">-->
	<!--<input type="button" value="Submit" id="add_product">-->
	<!--</div>-->
<!--</body>-->
</html>