<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Healthy Consultation</title>

	<link rel="stylesheet" type="text/css" href=" /RequestDisPatcher/CSS/layout.css">
	<link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/global.css">
	<link rel="stylesheet" type="text/css" href=" /RequestDisPatcher/CSS/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href=" /RequestDisPatcher/CSS/number-pb.css">
	<script src="  /RequestDisPatcher/JS/jquery-3.2.0.min.js"></script>
	<script src=" /RequestDisPatcher/JS/xcConfirm.js"></script>
	<link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/xcConfirm.css"/>


	<script src="  /RequestDisPatcher/JS/birthday.js"></script>
	<script src="  /RequestDisPatcher/JS/radialIndicator.js"></script>
	<script src=" /RequestDisPatcher/JS/jquery.velocity.min.js"></script>
	<script src="  /RequestDisPatcher/JS/number-pb.js"></script>
	<script src="  /RequestDisPatcher/JS/DateFormat.js"></script>

	<style>
		#chartdiv ,#chartdiv1,#chartdiv2,#chartdiv3{
			width: 590px;
			height	:300px;
		}

		.number-pb .number-pb-num {
			position: absolute;
			/* background-color: #fff; */
			/* left: 4px; */
			top: 30px;
			/* padding: 16px 12px; */
			width: 54px;
			left: 19%;
			background: none !important;
			font-family:华文细黑,STHeiti,MingLiu;
		}

		.showgotoBed{
			font-size: 16px;

		}

		.showgotoBed.outOfBed{
			top: 33px;
			font-size: 16px;
			position: relative;
			font-weight: normal !important;
			line-height: 19px!important;
			font-family: 华文细黑,STHeiti,MingLiu;
			margin-right: 12px;
			display: inline-block;
			float: right;
		}
		.showgotoBed.tosleep{
			top: 37px;
			font-size: 16px;
			position: relative;
			font-weight: normal !important;
			line-height: 19px!important;
			font-family: 华文细黑,STHeiti,MingLiu;
			margin-left: 58px;
			display: inline-block;
			float: left;
			color: #000;
		}
		.showgotoBed.gotobed{
			top: 35px;
			position: relative;
			font-weight: normal !important;
			line-height: 19px!important;
			font-family: 华文细黑,STHeiti,MingLiu;
			/* margin-left: 1px; */
			display: inline-block;
			float: left;
			font-size: 16px;
		}


		.qc{
			position: absolute;
			z-index: 4;

			left:-21px !important;
		}


	</style>

</head>
<script>
    var userInfo = document.cookie.match(new RegExp("(^| )userData=([^;]*)(;|$)"));

    if(userInfo==null){
        window.location.href = "login.php";//location.href实现客户端页面的跳转
    };
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

    function getQueryString(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return unescape(r[2]);
        return null;
    }
    // dateeng(月份,日期)
    function dateeng(dn) {
        var dt = new Date();
        var m=new Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Spt","Oct","Nov","Dec");
        var w=new Array("Monday","Tuseday","Wednesday","Thursday","Friday","Saturday","Sunday");
        var d=new Array("st","nd","rd","th");


        var dns;
        if(((dn)<1) ||((dn)>3)){
            dns=d[3];
        }
        else
        {
            dns=d[(dn)-1];
            if((dn==11)||(dn==12)){
                dns=d[3];
            }
        }


        return (dn+dns);
    }

    $(".right_show").css("border-bottom", '1px solid #ddd');
    $(".right_show").css("padding-bottom", 30);


    var otheremail=getQueryString('otheremail');


	var sn=getQueryString('sn');

	function otherrealdata() {
		window.location.href='real.php?&email='+otheremail+'&sn='+sn;
	}

</script>
<body>
<div class="holder rep ">
	<div class="left_nav">
		<div class="header_text">
			<div class="header_text_right">
				<span class="header_pic"><a href="modify.php" ><img src="Heads/default.jpg" id="head"></a></span>
			</div>
		</div>
        <ul  id="noemail">
            <a href="login.php"><li onclick="quit()"  >Logout</li></a>
            <a href="real.php"><li onclick="otherrealdata()">Real-time Data</li></a>
            <a href="healthy.php"><li class="on">Health Archives</li></a>
            <a href="addProduct.php"><li>Add device</li></a>
            <a href="deleteProduct.php"><li>Delete device</li></a>
        </ul>
        <ul  id="hasemail">
            <a href="login.php"><li onclick="quit()"  >Logout</li></a>
            <a><li  onclick="otherrealdata()">Real-time Data</li></a>
            <a><li class="on">Health Archives</li></a>
            <li></li>
            <li></li>
        </ul>

	</div>
	<div class="right_show">
		<h4 class="titl">isleep</h4>
		<a href="homepage.php"><span class="home"></span></a>
		<div class="show_detail">
			<div class="show_detail_data" style="    padding-top: 40px;">
				<div class="data_table search">
					<!--<ul class="search_list report" >-->
						<!--<li class="clickC">One report</li>-->
						<!--<li>Multiple reports</li>-->
					<!--</ul>-->
					<div class="report">
						<div class="report_detail">
							<h4 class="" style=" font-size: 23px;padding-top: 0px;">Tracking report </h4>
							<h5 style="display: block; padding-bottom: 31px; padding-top: 18px; font-size: 13px; ">Tracking date：</h5>
							<div class="circle">
								<ul>
									<li><span class="showxl" style="    font-size: 20px;"></span><span style="font-size: 11px">bpm</span><span>Average Heart Rate</span></li>
									<li><span class="showhxl"  style="    font-size: 20px;"></span><span style="font-size: 11px">bpm</span><span>Average Respiration</span></li>
									<li>
										<div id="indicatorContainer4">
										</div>
										<span class="pf">Sleep score</span>
									</li>
									<li><span class="showfscs"  style="    font-size: 20px;"></span><span style="font-size: 11px">Times</span><span>Sleep-turning times</span></li>
									<li><span class="showqycs"  style="    font-size: 20px;"></span><span style="font-size: 11px;">Times</span><span>Bed exits</span></li>
								</ul>
							</div>
							<div class="line" style=" margin-bottom: 40px;">
								<ul>
									<li>
										<i class="sc"><span style="    top: 12px;left: 4px;text-align: center;">Go to bed</span></i>

										<section id="sample-pb">
											<article>
												<div class="number-pb rumian">
													<div class="number-pb-shown ">
														<i class="icon_sleepright"><span style="       color: #fff; top: 8px;left: 0px;
    text-align: center;">Fall sleep</span></i>
													</div>

												</div>
											</article>
										</section>
										<i class="qc"><span style="    top: 18px;
    left: 5px;">Get up</span></i>
									</li>
									<li>
										<section id="sample-pb1">
											<article>
												<div class="number-pb">
													<div class="number-pb-shown">
														<i class="icon_sleepright"><span style="      color: #fff;  top: 8px;left: 0px;
    text-align: center;">Deep sleep</span></i>
													</div>
													<!--<div class="number-pb-num">深睡</div>-->
												</div>
											</article>
										</section>

									</li>
									<li>
										<section id="sample-pb2">
											<article>
												<div class="number-pb">
													<div class="number-pb-shown">
														<i class="icon_sleepright"><span style="     color: #fff;   top: 8px;left: 0px;
    text-align: center;">Light Sleep</span></i>
													</div>
													<!--<div class="number-pb-num">浅睡</div>-->
												</div>
											</article>
										</section>

									</li>
									<li>
										<section id="sample-pb3">
											<article>
												<div class="number-pb">
													<div class="number-pb-shown"><i class="icon_sleepright"><span style="  top: 15px;left: 1px;text-align: center;    color: #fff;">Total</span></i></div>
													<!--<div class="number-pb-num">总长</div>-->
												</div>
											</article>
										</section>
									</li>
								</ul>
							</div>
							<input type="button" onclick="javascript:history.back(-1);" value="Back" class="submit_submit back">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
//    function checktoken() {
//        var userInfo = document.cookie.match(new RegExp("(^| )userData=([^;]*)(;|$)"));
//        var info = JSON.parse(userInfo[2]);
//        var token = info.token;
//        $.ajax({
//            type:"post",
//            url:"  request/dispatcher.do",
//            data: {
//                url:"http://127.0.0.1:9001/login/checkToken",
//                params:"token="+token
//            },
//            success: function (data) {
////					1、未失效，1006、已失效
//                if(data.Code==1) {
//                    return true;
//                }
//                else if(data.Code==1006){
//                    return false;
//                }
//            },
//            error: function (data) {
//            }
//        });
//    }
//    if(!checktoken()){
//
//        window.location.href = "login.html";//location.href实现客户端页面的跳转
//
//
//    };

function falser() {
	return false;
}

	$(document).ready(function() {
		var userInfo = document.cookie.match(new RegExp("(^| )userData=([^;]*)(;|$)"));
//            console.log(userInfo);
		var info = JSON.parse(userInfo[2]);
		var Info = info['userInfo'];
		var token = info.token;
		var gender = info.gender;

		var gender = Info.gender;

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


		var chooseonetimetirng = document.cookie.match(new RegExp("(^| )chooseonetimetirng=([^;]*)(;|$)"));

		if(chooseonetimetirng!=null){
			var one_check = chooseonetimetirng[2];
		}

		var chooseothertimestirng = document.cookie.match(new RegExp("(^| )chooseothertimestirng=([^;]*)(;|$)"));

		if(chooseothertimestirng!=null){
			var other_check = chooseothertimestirng[2];
		}





        var date = new Date(parseInt(one_check));
        var one_check_fmt= date.format("yyyy-MM-dd");

        var date2 = new Date(parseInt(other_check));
        var other_check_fmt= date2.format("yyyy-MM-dd");



        var timetoshow=one_check_fmt.split('-');

        var timetoshow1=other_check_fmt.split('-');
		console.log(otheremail);
		if(otheremail==null){
			console.log(otheremail);
            $('#noemail').show();
            $('#hasemail').hide();

		$.ajax({
			type: "post",
			dataType: "json",
			url: "  request/dispatcher.do",
			data: {
				url: "http://101.37.100.209:9002/device/getSleepInfoBysjc",
				params: "token=" + token + "&time=" + one_check
			},
			success: function (data) {

				var monthsInEng = ['Jan', 'Feb', 'Mar','Apr', 'May', 'June','July', 'Aug', 'Sept','Oct', 'Nov', 'Dec'];

				var index=timetoshow[1];
				var dayindex=timetoshow[2];

				var a=dateeng(dayindex);

				$('.report_detail h5').append('<span>'+monthsInEng[index-1]+' '+a+'</span>');
				var radialObj4 = $('#indicatorContainer4').radialIndicator({
					barColor: {
						0: '#8A847F',
						33: '#8A847F',
						66: '#8A847F',
						100: '#8A847F'
					},
					radius:60,
					fontColor: '#000',
					percentage: true
				}).data('radialIndicator');
				radialObj4.animate(data.Data[0].score);

				$('.showxl').text(data.Data[0].avgHeart);
				$('.showhxl').text(data.Data[0].avgBreath);
				$('.showfscs').text(data.Data[0].turnNum);
				$('.showqycs').text(data.Data[0].outNum);



				var allSleepTime=((data.Data[0].lightSleepTime + data.Data[0].deepSleepTime) / (60 * 60)).toFixed(1);

				var deepSleepTime=((data.Data[0].deepSleepTime) / (60 * 60)).toFixed(1);

				var lightSleepTime=((data.Data[0].lightSleepTime) / (60 * 60)).toFixed(1);



				$('#sample-pb1').append('<p>Deep Sleep amount: '+ deepSleepTime +' h</p>');
				$('#sample-pb2').append('<p>Light Sleep amount: '+ lightSleepTime +' h</p>');
				$('#sample-pb3').append('<p>Sleep time: '+ allSleepTime +' h</p>');

				//上床到开始睡眠比例

//				var num=((data.Data[0].goToBed)*1000/(data.Data[0].sleepEnd-data.Data[0].sleepStart))*100;

				var num=((data.Data[0].sleepStart-data.Data[0].goToBed)/(data.Data[0].outOfBed-data.Data[0].goToBed))*100;

				//深度睡眠比例
				var num1=((data.Data[0].deepSleepTime)/(data.Data[0].lightSleepTime+data.Data[0].deepSleepTime))*100;


				//浅度睡眠比例
				var num2=((data.Data[0].lightSleepTime)/(data.Data[0].lightSleepTime+data.Data[0].deepSleepTime))*100;

				var date_sleepStart = new Date(parseInt(data.Data[0].sleepStart));
				var date_fmt_sleepStart=date_sleepStart.format(" hh:mm");

				$('.number-pb.rumian').append('<span class="showgotoBed tosleep">'+date_fmt_sleepStart+'</span>');


				var date_goToBed = new Date(parseInt(data.Data[0].goToBed));
				var date_fmt_goToBed=date_goToBed.format(" hh:mm");
				$('.sc').append('<span class="showgotoBed gotobed">'+date_fmt_goToBed+'</span>');


				var date_outOfBed = new Date(parseInt(data.Data[0].outOfBed));
				var date_fmt_outOfBed=date_outOfBed.format(" hh:mm");
				$('.qc').append('<span class="showgotoBed outOfBed">'+date_fmt_outOfBed+'</span>');

if(data.Data[0].score!=0){
	var num=20;
	var num3 = 100;
	var controlBar = $('#sample-pb .number-pb').NumberProgressBar({
		duration: 3000,
		percentage: num
	});

	var controlBar3 = $('#sample-pb3 .number-pb').NumberProgressBar({
		duration: 3000,
		percentage: num3
	});

}else{


	var num = 0;

	var num3 = 0;
	var controlBar = $('#sample-pb .number-pb').NumberProgressBar({
		duration: 3000,
		percentage: num
	});

	var controlBar3 = $('#sample-pb3 .number-pb').NumberProgressBar({
		duration: 3000,
		percentage: num3
	});

}



				var controlBar1 = $('#sample-pb1 .number-pb').NumberProgressBar({
					duration: 3000,
					percentage: num1
				});

				var controlBar2 = $('#sample-pb2 .number-pb').NumberProgressBar({
					duration: 3000,
					percentage: num2
				});


			},
			error: function (data) {
				var txt="Unkonw Error.Please Try Again!";
				window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.confirm);
			}
		});
}else{
            $('#noemail').hide();
            $('#hasemail').show();

			console.log(otheremail);

			$('.header_pic a').attr('href',"javascript:void(0)");

            $.ajax({
                type:"POST",
                url:"  request/dispatcher.do",
                data:{
                    url:"http://127.0.0.1:9001/login/query",
                    params:"email="+otheremail
                },
                dataType:"json",
                success:function(data) {
                    $('#head').attr('src',data.Data.image);



                },
                error: function (jqXHR, textStatus, errorThrown,Code) {
                    var txt="Unkonw Error.Please Try Again!";
                    window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);
                }
            })







	$.ajax({
		type: "post",
		dataType: "json",
		url: "  request/dispatcher.do",
		data: {
            url: "http://101.37.100.209:9002/device/getOtherSleepInfoBysjc",
            params: "token=" + token + "&time=" + other_check+"&email=" + otheremail
		},
		success: function (data) {

			var monthsInEng = ['Jan', 'Feb', 'Mar','Apr', 'May', 'June','July', 'Aug', 'Sept','Oct', 'Nov', 'Dec'];




            var index=timetoshow1[1];
            var dayindex=timetoshow1[2];

			var a=dateeng(dayindex);

			$('.report_detail h5').append('<span>'+monthsInEng[index-1]+' '+a+'</span>');
			var radialObj4 = $('#indicatorContainer4').radialIndicator({
				barColor: {
					0: '#8A847F',
					33: '#8A847F',
					66: '#8A847F',
					100: '#8A847F'
				},
				radius:60,
				fontColor: '#000',
				percentage: true
			}).data('radialIndicator');
			radialObj4.animate(data.Data[0].score);

			$('.showxl').text(data.Data[0].avgHeart);
			$('.showhxl').text(data.Data[0].avgBreath);
			$('.showfscs').text(data.Data[0].turnNum);
			$('.showqycs').text(data.Data[0].outNum);



			var allSleepTime=((data.Data[0].lightSleepTime + data.Data[0].deepSleepTime) / (60 * 60)).toFixed(1);

			var deepSleepTime=((data.Data[0].deepSleepTime) / (60 * 60)).toFixed(1);

			var lightSleepTime=((data.Data[0].lightSleepTime) / (60 * 60)).toFixed(1);



			$('#sample-pb1').append('<p>Deep Sleep amount: '+ deepSleepTime +' h</p>');
			$('#sample-pb2').append('<p>Light Sleep amount: '+ lightSleepTime +' h</p>');
			$('#sample-pb3').append('<p>Sleep time: '+ allSleepTime +' h</p>');

			//上床到开始睡眠比例

//				var num=((data.Data[0].goToBed)*1000/(data.Data[0].sleepEnd-data.Data[0].sleepStart))*100;

			var num=((data.Data[0].sleepStart-data.Data[0].goToBed)/(data.Data[0].outOfBed-data.Data[0].goToBed))*100;

			//深度睡眠比例
			var num1=((data.Data[0].deepSleepTime)/(data.Data[0].lightSleepTime+data.Data[0].deepSleepTime))*100;


			//浅度睡眠比例
			var num2=((data.Data[0].lightSleepTime)/(data.Data[0].lightSleepTime+data.Data[0].deepSleepTime))*100;

			var date_sleepStart = new Date(parseInt(data.Data[0].sleepStart));
			var date_fmt_sleepStart=date_sleepStart.format(" hh:mm");

			$('.number-pb.rumian').append('<span class="showgotoBed tosleep">'+date_fmt_sleepStart+'</span>');


			var date_goToBed = new Date(parseInt(data.Data[0].goToBed));
			var date_fmt_goToBed=date_goToBed.format(" hh:mm");
			$('.sc').append('<span class="showgotoBed gotobed">'+date_fmt_goToBed+'</span>');


			var date_outOfBed = new Date(parseInt(data.Data[0].outOfBed));
			var date_fmt_outOfBed=date_outOfBed.format(" hh:mm");
			$('.qc').append('<span class="showgotoBed outOfBed">'+date_fmt_outOfBed+'</span>');

			if(data.Data[0].score!=0){
				var num=20;
				var num3 = 100;
				var controlBar = $('#sample-pb .number-pb').NumberProgressBar({
					duration: 3000,
					percentage: num
				});

				var controlBar3 = $('#sample-pb3 .number-pb').NumberProgressBar({
					duration: 3000,
					percentage: num3
				});

			}else{


				var num = 0;

				var num3 = 0;
				var controlBar = $('#sample-pb .number-pb').NumberProgressBar({
					duration: 3000,
					percentage: num
				});

				var controlBar3 = $('#sample-pb3 .number-pb').NumberProgressBar({
					duration: 3000,
					percentage: num3
				});

			}



			var controlBar1 = $('#sample-pb1 .number-pb').NumberProgressBar({
				duration: 3000,
				percentage: num1
			});

			var controlBar2 = $('#sample-pb2 .number-pb').NumberProgressBar({
				duration: 3000,
				percentage: num2
			});


		},
		error: function (data) {
			console.log(data);
			var txt = data.Message;
			window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.confirm);
		}
	});


}
	})



</script>
<script>
	$(function() {



		function animate(val) {
			if (val < 0) {
				num = 0;
			} else if (val > 100) {
				num = 100;
			} else {
				num = val
			}
			controlBar.reach(num);
			controlBar1.reach(num1);
			controlBar2.reach(num2);
			controlBar3.reach(num3);
		}
	});

	//Using Instance


</script>
<script src="  JS/mine.js"></script>
</body>

