<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Register Account</title>
	<script src="  /RequestDisPatcher/JS/jquery-3.2.0.min.js"></script>

	<script src="  /RequestDisPatcher/JS/DateFormat.js"></script>
	<script src="  /RequestDisPatcher/JS/xcConfirm.js"></script>
	<script src="  /RequestDisPatcher/JS/ajaxfileupload.js"></script>

	<link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/xcConfirm.css"/>
	<link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/layout.css">
	<link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/global.css">
	<link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href=" /RequestDisPatcher/ CSS/laydate.css">
	<script type="text/javascript" src="  /RequestDisPatcher/JS/laydate.js"></script>

	<script src="  /RequestDisPatcher/JS/DateFormat.js"></script>
	<script src="  /RequestDisPatcher/JS/checkForm.js" type="text/javascript"></script>
	<script src="  /RequestDisPatcher/JS/jquery.cookie.js"></script>
	<script type="text/javascript">

		$(document).ready(function(){
			$("#submit_submit").click(function(){

				var choosebirth=$('#yearOfBirth').val();
				var birthday=choosebirth.split('/');
				var subbirthday=birthday[1]+'/'+birthday[2]+'/'+birthday[0];
				console.log(subbirthday);

				var flog = checkForm1();
				if(flog!=false){

					$.ajax({
								type: "post",
								dataType: "json",//返回数据的类型
								url: "  request/dispatcher.do",
								data:{
									url:"http://127.0.0.1:9001/login/register",
									params:"firstName="+$('#firstName').val()+"&password="+$('#password').val()+"&middleName="+$('#middleName').val()+"&lastName="+$('#lastName').val()+"&birth="+subbirthday+"&gender="+$('#gender').val()+"&mphone="+$('#phone').val()+"&address="+$('#address').val()+"&email="+$('#email').val()
								},//一同上传的数据

//						1、成功，1002邮箱已存在，0、服务器错误，1005、服务器错误


					success: function (data) {
									if(data.Code==0){
										var txt="Server  error";
										window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);
										return false;
									}else if(data.Code==1005){
										var txt="Server  error";
										window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);
										return false;

									}else if(data.Code==1002){
										var txt="The email address has been  registered";
										window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);
										return false;
									}else if(data.Code==1){
										var txt='Registration successfully';
										window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.success ,{
											onOk:function() {
												document.cookie="dluEmail="+$('#email').val();
												document.cookie="dlumima="+$('#password').val();
												window.location.href="  login.php";
											}})
									}
								}
							}

				)
				}
			});
		});

		function isEmail(str){
			var reg=/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((.[a-zA-Z0-9_-]{2,3}){1,2})$/;
			return reg.test(str);
		}6
		function checkpwd(str) {
			var reg=/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,12}$/;
			return reg.test(str);
		}
		function checkForm(){

			var x1= $('#firstName').val();
			if(x1=='')
			{
				var txt="Please input firstName";
				window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);
				return false;

			};


			var x2= $('#lastName').val();
			if(x2=='')
			{
				var txt="Please input lastName";
				window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);
				return false;

			};

			if($("#Changetimeyear").val()==''){
				var txt="Please input birthday";
				window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);
				return false;

			}

			var x3= $('#gender').val();
			if(x3=='')
			{
				var txt="Please input gender";
				window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);
				return false;
			};

			var x4= $('#phone').val();
			if(x4=='')
			{
				var txt="Please input phone";
				window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);
				return false;

			};
			var x5= $('#email').val();
			if(x5=='')
			{
				var txt="Please input email";
				window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);
				return false;

			};

			if(isEmail(x5)){
				var x7 = $('#password').val();
				if(x7=='')
				{
					var txt="Please input password";
					window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);
					return false;
				};


				if( !checkpwd(x7)){
					var txt="Password can only be the combination of numbers and letters. It may not be less than 6 or more than 16 bits";
					window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);
					return false;

				}

				var x9 = $('#repassword').val();
				if(x7!=x9){
					var txt="Please Check Your Password!Keep the Same";
					window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);
					return false;
				}

				var x10 =$('#checkService').prop('checked');
				if(!x10){
					var txt="Please Accept the Terms of Service,or You Can Read it";
					window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);
					return false;
				}


			}else{
				var txt="Email format error";
				window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);
				return false;
			}


		}
		function goback() {
			location.href='login.php';
		}

	</script>
</head>
<body>

<div class="holder reg_container">
	<div class="left_nav reg_nav" >
		<div class="header_text">
			<div class="header_text_right">
				<span class="header_pic"><img src="Heads/default.jpg" id="head"></span>
			</div>

		</div>

		<ul>
			<a href="javascript:scroll(0,0)"><li>First Name</li></a>
			<a href="#middleName"><li>Middle Name</li></a>
			<a href="#lastName"><li>Last Name</li></a>
			<a href="#birthday_container"><li>Birthday</li></a>
			<a href="#gender"><li>Gender</li></a>


			<a href="#phone"><li>Phone Number</li></a>
			<a href="#address"><li>Address</li></a>
			<a href="#email"><li>E-mail</li></a>
			<a href="#password"><li>Password</li></a>
			<a href="#repassword"><li>Confirm Password</li></a>

		</ul>
	</div>
	<div class="right_show">
		<h3 style="font-size: 20px;">Register</h3>
		<span onclick="goback()" style="cursor:pointer" class="glyphicon icon-caret-right"></span>
		<div class="show_detail register">
			<form name="re_form">
				<div class="form_txt">
					<p>Attention: The message with * must be filled out!</p>
				</div>
				<div class="panel_input reg_input res check">
					<input type="text" placeholder="First Name *" id="firstName" value="" />
				</div>
				<div class="panel_input reg_input res">
					<input type="text" placeholder="Middle Name" id="middleName" value="" />
				</div>
				<div class="panel_input reg_input res check">
					<input type="text" placeholder="Last Name *" id="lastName" value="" />
				</div>
				<span class="bir_txt btext">Birthday *</span>
				<div class="reg_input  res reg_select ymd check "  style="margin-bottom: 77px" id="">
					<!--<input id="Changetimeyear" readonly="readonly"  /><span> </span>-->
					<!--<input id="Changetimemonth" readonly="readonly" /><span> </span>-->
					<input id="yearOfBirth"  type="text"  value="1980/01/01" style="width: 100% !important;cursor: pointer"/>
					<!--<input id="yearOfBirth"  style="    text-align: center;-->
					<!--<span class="day123"> </span>-->
				</div>
				<div class="reg_input  res reg_select sex " style="    margin-top: -35px;
">
					<select style="outline:none !important; cursor: pointer;"  id="gender" name ="gender" onchange="changepic()">
						<option value ="" selected>Gender *</option>
						<option value="1" >Male</option>
						<option value="0" >Female</option>
					</select>
				</div>

				<div class="panel_input reg_input res check">
					<input type="text" placeholder="Phone Number *" id="phone" value="" />
				</div>

				<div class="panel_input reg_input res ">
					<input type="text" placeholder="Address" id="address" value="" />
				</div>

				<div class="panel_input reg_input res check">
					<input type="text" placeholder="E-mail *" id="email" value="" />
				</div>

				<div class="panel_input reg_input res check">
					<input type="password" placeholder="Password *" id="password" value="" />
				</div>

				<div class="panel_input reg_input  res check">
					<input type="password" placeholder="Confirm Password *" id="repassword" value="" />
				</div>

				<label class="checkService">
					<input type="checkbox" id="checkService" checked="checked">I agree to the Terms of Service
				</label>
				<div class="foot_btn">
					<input type="button" name="Submit" onclick="javascript:history.back(-1);" value="Back" class="submit_back">
					<input type="button" value="Submit" id="submit_submit" onclick="return checkForm();" class="submit_submit">
				</div>

			</form>
		</div>
	</div>

	<script type="text/javascript">

		!function(){

			laydate.skin('yahui');//切换皮肤，请查看skins下面皮肤库

			laydate({elem: '#yearOfBirth',format: 'MM/DD/YYYY',choose: function(datas){ //选择日期完毕的回调
			}});//绑定元素

		}();



	</script>
	<script>
	</script>
</div>
</body>
</html>