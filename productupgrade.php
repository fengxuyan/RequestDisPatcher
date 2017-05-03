<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Product Upgrade</title>
	<script src="  /RequestDisPatcher/JS/jquery-3.2.0.min.js"></script>

	<link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/layout.css">
	<link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/global.css">
	<link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/font-awesome.min.css">

	<script>
		var userInfo = document.cookie.match(new RegExp("(^| )userData=([^;]*)(;|$)"));

		if(userInfo==null){
			window.location.href = "login.php";//location.href实现客户端页面的跳转
		};
		function quit() {
			$.ajax({
				type:"post",
				url:"  request/dispatcher.do",
				data: {
					url:"http://127.0.0.1:9001/login/logout",
					params:"token="+token
				},
				success: function (data) {
					var txt=data.Message;
					window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.info);
//
				},
				error: function (data) {
					var txt=data.Message;
					window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.info);
				}
			});
		}
		$(document).ready(function() {
			var userInfo = document.cookie.match(new RegExp("(^| )userData=([^;]*)(;|$)"));
			var info = JSON.parse(userInfo[2]);
			var Info = info['userInfo'];
			var first = Info.firstName;
			var middle = Info.middleName;
			var last = Info.lastName;
			var gender = Info.gender;
			var token = Info.token;
			var image = Info.image;
			var device = Info.device;

			//位绑定设备
			if(device == null || device.length == 0){
				$("#products").remove();
				$("#no_product").remove();
				$("#product_list").append("<div id='no_product' style='text-align:center;font-size:2.5em;'>No Product!</div>");
			}

			if (image == null) {
				if (gender == 1) {

					$('#head').attr('src', 'Heads/header_man.png');

				} else if (gender == 0) {

					$('#head').attr('src', 'Heads/header_woman.png');

				}

			} else {
				$('#head').attr('src', image);
			}

		})
	</script>
</head>
<body >
<div class="holder proupdate" >
	<div class="left_nav">
		<div class="header_text">
			<div class="header_text_right">
				<span class="header_pic"><a href="modify.php" ><img src="Heads/default.jpg" id="head"></a></span>
			</div>
		</div>
		<ul>
			<a href="login.php"><li onclick="quit()"  >Logout</li></a>
			<a href="concern.php"><li>Family care</li></a>
			<a href="productupgrade.php"><li  class="on">Value-Added Services</li></a>
			<a href="javascript:void(0)" ><span title="Yet open, please wait patiently"><li>Doctors' Hall</li></span></a>
		</ul>
	</div>
	<div class="right_show">
		<h4 class="titl">isleep</h4>
		<a href="homepage.php"><span class="home"></span></a>
		<div class="show_detail">
			<div class="show_detail_data  proupdate">
				<h3 style="font-weight: bold;
    font-size: 18px;">NEWS</h3>
				<div class="data_table">
					<div class="mesg">
						<h4>news news news!</h4>
						<p>

					</div>
				</div>
			</div>
			<div class="show_detail_data proupdate">
				<h3 style="font-weight: bold;
    font-size: 18px;">New arrivals</h3>
				<div class="data_table">
					<!--<img id="image" alt="" src="images/head_test.jpg"><span>新闻标题</span>-->
					<p class="newProductLists">

					</p>
				</div>
				<div class="data_table">
					<!--<img id="image" alt="" src="images/head_test.jpg"><span>新闻标题</span>-->
					<p class="newProductLists">

					</p>
				</div>
			</div>
			<div class="show_detail_data proupdate detail_update" id="product_list">
				<h3 style="font-weight: bold;
    font-size: 18px;">Value-Added Services</h3>
				<h4 class="firsth4">Your Devices：</h4>
				<div class="data_table " id="products">
					<div id="cd">
						<div id="cd_1">
							<h4>Smart Mattress Pad<span >* Advanced version</span>	<a href="#">
								<input type="button" value="Renewal fee" id="upgrade_select" style=""></a></h4>
						</div>
					</div>
					<div id="zt">
						<div id="zt_1">
							<h4 style="color:#8A847F">Smart Pillow<span style="font-size: 16px">* Advanced version</span>
								<a href="#"><input style="background:#b0aba7" type="button" value="Renewal fee" id="upgrade_select"></a></h4>
						</div>
					</div>
					<div id="sh">
						<div id="sh_1">
							<h4 style="color:#8A847F">Smart Bracelet<span>* Advanced version</span><a href="#">
								<input type="button" style="background:#b0aba7" value="Renewal fee" id="upgrade_select"></a></h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(".right_show").css("padding-bottom",30);
		$(".right_show").css("border-bottom",'1px solid #ddd');
	</script>
	<script src="  JS/mine.js"></script>
</div>
</body>
</html>