<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>HomePage</title>
	<script src=" /RequestDisPatcher/JS/jquery-3.2.0.min.js"></script>
	<!--<link rel="stylesheet" href=" CSS/bootstrap.min.css">-->
	<script src=" /RequestDisPatcher/JS/xcConfirm.js"></script>


	<link rel="stylesheet" type="text/css" href=" /RequestDisPatcher/CSS/xcConfirm.css"/>
	<link rel="stylesheet" type="text/css" href=" /RequestDisPatcher/CSS/layout.css">
	<link rel="stylesheet" type="text/css" href=" /RequestDisPatcher/CSS/global.css">
	<link rel="stylesheet" type="text/css" href=" /RequestDisPatcher/CSS/font-awesome.min.css">
	<script src=" /RequestDisPatcher/JS/jquery-3.2.0.min.js"></script>
	<script src=" /RequestDisPatcher/JS/mine.js"></script>
<script type="text/javascript">
	function quit() {
		$.ajax({
			type:"post",
			url:" request/dispatcher.do",
			data: {
				url:"http://127.0.0.1:9001/login/logout",
				params:"token="+token
			},
			success: function (data) {

			},
			error: function (data) {
			}
		});
	}
//	function checktoken() {
//		var userInfo = document.cookie.match(new RegExp("(^| )userData=([^;]*)(;|$)"));
//		var info = JSON.parse(userInfo[2]);
//		var token = info.token;
//			$.ajax({
//				type:"post",
//				url:" request/dispatcher.do",
//				data: {
//					url:"http://127.0.0.1:9001/login/checkToken",
//					params:"token="+token
//				},
//				success: function (data) {
////					1、未失效，1006、已失效
//					if(data.Code==1) {
//						return true;
//					}
//					else if(data.Code==1006){
//						return false;
//					}
//				},
//				error: function (data) {
//				}
//			});
//	}
//	if(!checktoken()){
//
////		window.location.href = "login.php";//location.href实现客户端页面的跳转
//
//
//	};
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

	var name;
	if(middle==null||middle==""){
		name = first+" "+last;
	}else{
		name = first+" "+middle+" "+last;
	}
	var type1 = info.type1sn;
	var type2 = info.type2sn;
	var type3 = info.type3sn;
	//添加名字
	$("#user_name").text(name);
	//确定是否有产品页面
	/* if((type1==null||type1=="")&&(type2==null||type2=="")&&(type3==null||type3=="")){
		document.getElementById("product").style="display:none";
		document.getElementById("info").style.height="220px";
	} */
});
	function comming() {
		var txt="Coming Soon";
		window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.info);
		return false;

	}
</script>
</head>
<body>
<div class="holder" style="margin-top: 0">
	<div class="header">
		<div class="header_scroll">
			<h2>isleep</h2>
		</div>
		<div class="header_text">
			<div class="header_text_right">
				<span class="header_pic"><a href="modify.php" ><img src="Heads/default.jpg" id="head"></a></span>
				<a href="modify.php"><span>Personal Information</span></a><a href="login.php"><span onclick="quit()" >Logout</span></a>
			</div>
		</div>
	</div>



	<div class="content_icon">
		<ul class="content_icon_list">
			<li><a href="chuangdian.php"><span>Smart mattress pad</span></a></li>
			<li><a href="javascript:void(0)" title="Yet open, please wait patiently" ><span>Smart Pillow</span></a></li>
			<li><a href="javascript:void(0)" title="Yet open, please wait patiently" ><span>Smart Bracelet</span></a></li>
			<li><a href="concern.php" ><span>Family care</span></a></li>
			<li><a href="productupgrade.php" ><span>Value-Added Services</span></a></li>
			<li><a href="javascript:void(0)" ><span title="Yet open, please wait patiently" >Doctors' Hall</span></a></li>
		</ul>
	</div>
</div>

</body>
</html>