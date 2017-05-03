<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Healthy Consultation</title>
	<!--<link rel="stylesheet" href="  CSS/bootstrap.min.css">-->
	<link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/layout.css">
	<link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/global.css">
	<link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/number-pb.css">

	<script src="  /RequestDisPatcher/JS/jquery-3.2.0.min.js"></script>
	<script src="  /RequestDisPatcher/JS/birthday.js"></script>
	<script src="  /RequestDisPatcher/JS/radialIndicator.js"></script>
	<script src="  /RequestDisPatcher/JS/jquery.velocity.min.js"></script>
	<script src="  /RequestDisPatcher/JS/number-pb.js"></script>
	<script src="  /RequestDisPatcher/JS/DateFormat.js"></script>
	<script src="  /RequestDisPatcher/JS/jquery.cookie.js"></script>


	<script src="  /RequestDisPatcher/JS/xcConfirm.js"></script>
	<link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/xcConfirm.css"/>
    <link rel="stylesheet" type="text/css" href=" /RequestDisPatcher/ CSS/laydate.css">
    <script type="text/javascript" src="  /RequestDisPatcher/JS/laydate.js"></script>
    <style>
        #chartdiv ,#chartdiv1,#chartdiv2,#chartdiv3{
            width: 590px;
            height	:300px;
        }
        .chooseTime{
            background:#979695 !important;
        }
		li{

			cursor: default;
		}
		.chooseTime1{
			background:#979695 !important;
		}
    </style>
	<script>
		var userInfo = document.cookie.match(new RegExp("(^| )userData=([^;]*)(;|$)"));
		if(userInfo==null){
			window.location.href = "login.php";//location.href实现客户端页面的跳转
		};
		function getQueryString(name) {
			var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
			var r = window.location.search.substr(1).match(reg);
			if (r != null) return unescape(r[2]);
			return null;
		}

		var info = JSON.parse(userInfo[2]);
		var token = info.token;
		var otheremail=getQueryString('email');

        function today(){
            var today=new Date();
            var h=today.getFullYear();
            var m=today.getMonth()+1;
            var d=today.getDate();
			return h+"/"+m+"/"+d;
        }

        function weekago(){
            var today=new Date(new Date().getTime() - 1000 * 60 * 60 * 24 * 7);
            var h=today.getFullYear();
            var m=today.getMonth()+1;
            var d=today.getDate();
            return h+"/"+m+"/"+d;
        }




		function bindListener(){
			$(".oneDayLists ul li").unbind().each(function(index,item){
				$(item).on("click",function(event){
					$(this).toggleClass('chooseTime1');

					$(this).siblings().removeClass('chooseTime1');
				});
			});
		}

		function change() {

			$(".oneDayLists ul li").remove();

			if(otheremail==null) {
                document.cookie="remember_one_selectime="+$('#changetimer').val();
				$.ajax({
					type: "post",
					url: "  request/dispatcher.do",
					data: {
						url: "http://101.37.100.209:9002/device/getInfo",
						params: "token=" + token + "&time=" + $('#changetimer').val()
					},
					success: function (data) {

						console.log(data);

						$.each(data.Data, function (i, item) {

							var sleeptime = ((item.lightSleepTime + item.deepSleepTime) / (60 * 60)).toFixed(1);

//						var sleeptime=MillisecondToDate((item.lightSleepTime+item.deepSleepTime)*1000);
							var date = new Date(parseInt(item.creatTime));
							var date_fmt = date.format("yyyy-MM-dd");
							$(".oneDayLists ul").append('<li> <span>' + date_fmt + '</span><span>' + sleeptime + '  h</span><span>' + item.score + '</span></li>');
							bindListener();
							if($(".left_nav").height() > $(".right_show").height()){
								$(".right_show").height($(".left_nav").height()+30);
								$('.holder').css('min-height',$(".left_nav").height());
							}
							else{
								$(".left_nav").height($(".right_show").height()+100);
								$('.holder').css('min-height',$(".right_show").height());
							}
						});
					},
					error: function (data) {
						var txt = data.Message;
						window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.confirm);
					}

				});
			}else{
                document.cookie="remember_one_other_selectime="+$('#changetimer').val();
				$.ajax({
					type: "post",
					url: "  request/dispatcher.do",
					data: {
						url: "http://101.37.100.209:9002/device/getOtherInfo",
						params: "token=" + token + "&time=" + $('#changetimer').val()+ "&email=" + otheremail
					},
					success: function (data) {
						$.each(data.Data, function (i, item) {
							var sleeptime = ((item.lightSleepTime + item.deepSleepTime) / (60 * 60)).toFixed(1);
							var date = new Date(parseInt(item.creatTime));
							var date_fmt = date.format("yyyy-MM-dd");
							$(".oneDayLists ul").append('<li> <span>' + date_fmt + '</span><span>' + sleeptime + '  h</span><span>' + item.score + '</span></li>');
							if($(".left_nav").height() > $(".right_show").height()){
								$(".right_show").height($(".left_nav").height()+30);
								$('.holder').css('min-height',$(".left_nav").height());
							}
							else{
								$(".left_nav").height($(".right_show").height()+100);
								$('.holder').css('min-height',$(".right_show").height());
							}
							bindListener();

						});

					},
					error: function (data) {
						var txt = data.Message;
						window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.confirm);
					}

				});

			}
		}
		function changes() {
			var startTime=$('#changetimesleft').val();
			var endTime=$('#changetimesright').val();

			var beginDate=$("#startTime").val();
			var endDate=$("#endTime").val();
			var d1 = new Date(startTime.replace(/\-/g, "\/"));
			var d2 = new Date(endTime.replace(/\-/g, "\/"));

			if(beginDate!=""&&endDate!=""&&d1 >=d2)
			{
				var txt="Start time can not be greater than the end time!";
				window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);
				return false;
			}


			if(otheremail==null){


				$.ajax({
					type: "post",
					url: "  request/dispatcher.do",
					data: {
						url: "http://101.37.100.209:9002/device/getData",
						params: "token=" + token+"&endTime="+endTime+"&startTime="+startTime
					},
					success: function (data) {
						console.log(data);
						$(".daysLists ul li").remove();
						$.each(data.Data, function(i, item) {

							var sleeptime = ((item.lightSleepTime + item.deepSleepTime) / (60 * 60)).toFixed(1);
							var date = new Date(parseInt(item.creatTime));
							var date_fmt=date.format("yyyy-MM-dd");
							$(".daysLists ul").append('<li > <span>'+date_fmt+'</span><span>'+sleeptime+' h</span><span>'+item.score+'</span></li>');
							//bindListeners();
							if($(".left_nav").height() > $(".right_show").height()){
								$(".right_show").height($(".left_nav").height()+30);
								$('.holder').css('min-height',$(".left_nav").height());
							}
							else{
								$(".left_nav").height($(".right_show").height()+100);
								$('.holder').css('min-height',$(".right_show").height());
							}

						});
						if($(".left_nav").height() > $(".right_show").height()){
							$(".right_show").height($(".left_nav").height());
							$('.holder').css('min-height',$(".left_nav").height());
						}
						else{
							$(".left_nav").height($(".right_show").height());
							$('.holder').css('min-height',$(".right_show").height());
						}

						console.log($(".left_nav").height());
						console.log($(".right_show").height());

					},
					error: function (data) {
						var txt=data.Message;
						window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.confirm);
					}

				});

			}else{

				$.ajax({
					type: "post",
					url: "  request/dispatcher.do",
					data: {
						url: "http://101.37.100.209:9002/device/getOtherData",
						params: "token=" + token+"&endTime="+endTime+"&startTime="+startTime+"&email="+otheremail
					},
					success: function (data) {
						console.log(data);
						$(".daysLists ul li").remove();
						$.each(data.Data, function(i, item) {

							var sleeptime = ((item.lightSleepTime + item.deepSleepTime) / (60 * 60)).toFixed(1);
							var date = new Date(parseInt(item.creatTime));
							var date_fmt=date.format("yyyy-MM-dd");
							$(".daysLists ul").append('<li onclick=saveTime("'+date_fmt+'") id="'+date_fmt+'"> <span>'+date_fmt+'</span><span>'+sleeptime+' h</span><span>'+item.score+'</span></li>');
							//bindListeners();
							if($(".left_nav").height() > $(".right_show").height()){
								$(".right_show").height($(".left_nav").height()+30);
								$('.holder').css('min-height',$(".left_nav").height());
							}
							else{
								$(".left_nav").height($(".right_show").height()+100);
								$('.holder').css('min-height',$(".right_show").height());
							}
						});
						if($(".left_nav").height() > $(".right_show").height()){
							$(".right_show").height($(".left_nav").height());
							$('.holder').css('min-height',$(".left_nav").height());
						}
						else{
							$(".left_nav").height($(".right_show").height());
							$('.holder').css('min-height',$(".right_show").height());
						}

						console.log($(".left_nav").height());
						console.log($(".right_show").height());

					},
					error: function (data) {
						var txt=data.Message;
						window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.confirm);
					}

				});


			}
		}

		//处理多次选择的时间问题
		function saveTime(time_str){
			//$(this).toggleClass('chooseTime');
			var i;
			var time = new Array();
			for(i =0;i<3;i++){
				time[i]= document.cookie.match(new RegExp("(^| )select_time"+i+"=([^;]*)(;|$)"));
				if(time[i][2] ==null || time[i][2] =='' || time[i][2] ==""){
					break;
				}
			}



			if(i==0){
				document.cookie="select_time0="+time_str;
				document.getElementById(time_str).style="background:#979695 !important;";
			}else if(i==1){
				if(time[0][2]!=time_str){
					document.cookie="select_time1="+time_str;
					document.getElementById(time_str).style="background:#979695 !important;";
				}else{
					document.cookie="select_time0="+"";
					document.getElementById(time_str).style="background:#F8F8F8 !important;";
				}
			}else{
				if(time[0][2]==time_str){
					var time1 =  document.cookie.match(new RegExp("(^| )select_time1=([^;]*)(;|$)"));
					document.cookie="select_time0="+time1[2];
					document.cookie="select_time1="+"";
					document.getElementById(time_str).style="background:#F8F8F8 !important;";
				}else if(time[1][2]==time_str){
					document.cookie="select_time1="+"";
					document.getElementById(time_str).style="background:#F8F8F8 !important;";
				}else{
					var time0 =  document.cookie.match(new RegExp("(^| )select_time0=([^;]*)(;|$)"));
					var time1 = document.cookie.match(new RegExp("(^| )select_time1=([^;]*)(;|$)"));
					var time0_real = new Date(time0[2]);
					var time1_real = new Date(time1[2]);
					var timex_xx = new Date();
					var time_real = new Date(time_str)
					if(time0_real.getTime() > time1_real.getTime()){
						if(time0_real.getTime()<time_real.getTime()){
							document.cookie="select_time0="+time_str;
							document.getElementById(time0[2]).style="background:#F8F8F8 !important;";
							document.getElementById(time1[2]).style="background:#979695 !important;";
							document.getElementById(time_str).style="background:#979695 !important;";
						}else{
							document.cookie="select_time1="+time_str;
							document.getElementById(time0[2]).style="background:#979695 !important;";
							document.getElementById(time1[2]).style="background:#F8F8F8 !important;";
							document.getElementById(time_str).style="background:#979695 !important;";
						}
					}else if(time0_real.getTime() < time1_real.getTime()){
						if(time1_real.getTime()<time_real.getTime()){
							document.cookie="select_time0="+time_str;
							document.cookie="select_time1="+time0[2];
							document.getElementById(time0[2]).style="background:#979695 !important;";
							document.getElementById(time1[2]).style="background:#F8F8F8 !important;";
							document.getElementById(time_str).style="background:#979695 !important;";
						}else {
							document.cookie="select_time0="+time1[2];
							document.cookie="select_time1="+time_str;
							document.getElementById(time0[2]).style="background:#F8F8F8 !important;";
							document.getElementById(time1[2]).style="background:#979695 !important;";
							document.getElementById(time_str).style="background:#979695 !important;";
						}
					}else{
						document.cookie="select_time1="+'';
					}
				}
			}

			var time0_last =  document.cookie.match(new RegExp("(^| )select_time0=([^;]*)(;|$)"));


			var time1_last = document.cookie.match(new RegExp("(^| )select_time1=([^;]*)(;|$)"));



			if(time1_last[2]!=null && time1_last[2]!='' && time1_last[2]!=""){
				var time0_last_real = new Date(time0_last[2]);
				var time1_last_real = new Date(time1_last[2]);

				if(time0_last_real.getTime()<time1_last_real.getTime()){
					document.cookie="select_time0="+time1_last[2];
					document.cookie="select_time1="+time0_last[2];
					var time_time;
					var days = 0;
					while(time1_last[2] != (time_time = addTime(time0_last[2],days++))){
						document.getElementById(time_time).style="background:#979695 !important;";
					}
					for(days = 1; days<15; days++){
						time_time = addTime(time1_last[2],days);
						if(document.getElementById(time_time)!=null){
							document.getElementById(time_time).style="background:#F8F8F8 !important;";
						}
					}
					for(days = -1; days>-15; days--){
						time_time = addTime(time0_last[2],days);
						if(document.getElementById(time_time)!=null){
							document.getElementById(time_time).style="background:#F8F8F8 !important;";
						}
					}

				}else{
					var time_time;
					var days = 0;
					while(time0_last[2] != (time_time = addTime(time1_last[2],days++))){
						document.getElementById(time_time).style="background:#979695  !important;";
					}
					for(days = 1; days<15; days++){
						time_time = addTime(time0_last[2],days);
						if(document.getElementById(time_time)!=null){
							document.getElementById(time_time).style="background:#F8F8F8 !important;";
						}
					}
					for(days = -1; days>-15; days--){
						time_time = addTime(time1_last[2],days);
						if(document.getElementById(time_time)!=null){
							document.getElementById(time_time).style="background:#F8F8F8 !important;";
						}
					}
				}
			}
		}

		//将time 加上days天返回
		function addTime(time,days){

			var time_real = new Date(time);
			time_real = time_real.valueOf();
			time_real = time_real + days* 24 * 60 * 60 * 1000;
			time_real = new Date(time_real);
			var years = time_real.getFullYear();
			var months = (time_real.getMonth()+1) < 10 ? ('0'+(time_real.getMonth()+1)):(''+(time_real.getMonth()+1));
			var days = time_real.getDate() < 10 ? ('0'+time_real.getDate()):(''+time_real.getDate());

			return years+'-'+months+'-'+days;
		}
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

		function bindListeners(){


			$(".daysLists ul li").unbind().each(function(index,item){
				$(item).on("click",function(event){
					$(this).toggleClass('chooseTime');
//					window.location.href='sleepreport.html?time='+selectOneTime;

				});


			});

		}


		//-------------------------------

        $(document).ready(function() {
			document.getElementById("changetimer").value=today();
            document.getElementById("changetimesright").value=today();
            document.getElementById("changetimesleft").value=weekago();


            //清除cookie
            for(i =0;i<3;i++){
                document.cookie="select_time"+i+"="+"";
            }
			var userInfo = document.cookie.match(new RegExp("(^| )userData=([^;]*)(;|$)"));
			if(userInfo=='null'){
				window.location.href = "login.php";//location.href实现客户端页面的跳转
			};
			var info = JSON.parse(userInfo[2]);
			var Info = info['userInfo'];
            var Info = info['userInfo'];
            var first = Info.firstName;
            var middle = Info.middleName;
            var last = Info.lastName;
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


//			$("#search_time").birthday();
//			$("#search_times").birthday();
//			$("#search_times2").birthday();

            var myDate = new Date();
            //获取当前年
            var year = myDate.getFullYear();
            //获取当前月
            var month = myDate.getMonth() + 1;
            var day = myDate.getDate();

            if(month<10){
                var month='0'+month;
            }else{
                var month=month;
            };

            if(day<10){
                var day='0'+day;
            }else{
                var day=day;
            };
			var time=month+'/'+day+'/'+year;

            var remember_one_selectime =  document.cookie.match(new RegExp("(^| )remember_one_selectime=([^;]*)(;|$)"));
//			console.log(remember_one_selectime[2]);
            if(otheremail==null){


				$('#noemail').show();
				$('#hasemail').hide();

//页面加载后单次查询列表显示
                if(remember_one_selectime!=null){
					console.log(remember_one_selectime[2]);
                    var txttoarray=remember_one_selectime[2].split('/');

					console.log(txttoarray);

                    document.getElementById("changetimeyear").value=txttoarray[2];
                    document.getElementById("changetimemonth").value=txttoarray[0];
                    document.getElementById("changetime").value=txttoarray[1];

                    $.ajax({
                        type: "post",
                        url: "  request/dispatcher.do",
                        data: {
                            url: "http://101.37.100.209:9002/device/getInfo",
                            params: "token=" + token+"&time="+remember_one_selectime[2]
                        },
                        success: function (data) {
                            $.each(data.Data, function(i, item) {
                                var sleeptime = ((item.lightSleepTime + item.deepSleepTime) / (60 * 60)).toFixed(1);
                                var date = new Date(parseInt(item.creatTime));
                                var date_fmt=date.format("yyyy-MM-dd");
                                $(".oneDayLists ul").append('<li data-name="'+item.creatTime+'"> <span>'+date_fmt+'</span><span>'+sleeptime+'  h</span><span>'+item.score+'</span></li>');
                                bindListener();
								if($(".left_nav").height() > $(".right_show").height()){
									$(".right_show").height($(".left_nav").height()+30);
									$('.holder').css('min-height',$(".left_nav").height());
								}
								else{
									$(".left_nav").height($(".right_show").height()+100);
									$('.holder').css('min-height',$(".right_show").height());
								}
                            });

                        },
                        error: function (data) {
                            var txt=data.Message;
                            window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.confirm);
                        }

                    });




                }else{

                    document.getElementById("changetime").value=time;
                    var txttoarray1=$('#changetime').val().split('/');
                    document.getElementById("changetimeyear").value=txttoarray1[2];
                    document.getElementById("changetimemonth").value=txttoarray1[0];
                    document.getElementById("changetime").value=txttoarray1[1];

                    $.ajax({
                        type: "post",
                        url: "  request/dispatcher.do",
                        data: {
                            url: "http://101.37.100.209:9002/device/getInfo",
                            params: "token=" + token+"&time="+time
                        },
                        success: function (data) {
                            $.each(data.Data, function(i, item) {
                                var sleeptime = ((item.lightSleepTime + item.deepSleepTime) / (60 * 60)).toFixed(1);
                                var date = new Date(parseInt(item.creatTime));
                                var date_fmt=date.format("yyyy-MM-dd");
                                $(".oneDayLists ul").append('<li data-name="'+item.creatTime+'"> <span>'+date_fmt+'</span><span>'+sleeptime+'  h</span><span>'+item.score+'</span></li>');
                                bindListener();
								if($(".left_nav").height() > $(".right_show").height()){
									$(".right_show").height($(".left_nav").height()+30);
									$('.holder').css('min-height',$(".left_nav").height());
								}
								else{
									$(".left_nav").height($(".right_show").height()+100);
									$('.holder').css('min-height',$(".right_show").height());
								}
                            });

                        },
                        error: function (data) {
                            var txt=data.Message;
                            window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.confirm);
                        }

                    });

                };

//页面加载后多次查询列表显示
				var remember_one_changetimesleft =  document.cookie.match(new RegExp("(^| )remember_one_changetimesleft=([^;]*)(;|$)"));
				var remember_one_changetimesright =  document.cookie.match(new RegExp("(^| )remember_one_changetimesright=([^;]*)(;|$)"));



				if(remember_one_changetimesleft!=null) {
					var txttoarrayleft=remember_one_changetimesleft[2].split('/');;
					var txttoarrayright=remember_one_changetimesright[2].split('/');;



					var laydatefomcatleft=txttoarrayleft[1]+'/'+txttoarrayleft[2]+'/'+txttoarrayleft[0];


					var laydatefomcatright=txttoarrayright[1]+'/'+txttoarrayright[2]+'/'+txttoarrayright[0];

					$('#changetimesright').val(remember_one_changetimesright[2]);
					$('#changetimesleft').val(remember_one_changetimesleft[2]);


					$.ajax({
						type: "post",
						url: "  request/dispatcher.do",
						data: {
							url: "http://101.37.100.209:9002/device/getData",
							params: "token=" + token+"&endTime="+laydatefomcatright+"&startTime="+laydatefomcatleft
						},
						success: function (data) {
							console.log(data);
							$(".daysLists ul li").remove();
							var bakgroundli="style='background: #979695'";
							$.each(data.Data, function(i, item) {

								var sleeptime = ((item.lightSleepTime + item.deepSleepTime) / (60 * 60)).toFixed(1);
								var date = new Date(parseInt(item.creatTime));
								var date_fmt=date.format("yyyy-MM-dd");
								$(".daysLists ul").append('<li  data-name="'+item.creatTime+'" class="chooseTime" > <span>'+date_fmt+'</span><span>'+sleeptime+' h</span><span>'+item.score+'</span></li>');

								bindListeners();
								if($(".left_nav").height() > $(".right_show").height()){
									$(".right_show").height($(".left_nav").height()+30);
									$('.holder').css('min-height',$(".left_nav").height());
								}
								else{
									$(".left_nav").height($(".right_show").height()+100);
									$('.holder').css('min-height',$(".right_show").height());
								}
							});
						},
						error: function (data) {
							var txt=data.Message;
							window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.confirm);
						}

					});

				}else{

					var txttoarrayleft=weekago().split('/');
					var txttoarrayright=today().split('/');



					var laydatefomcatleft=txttoarrayleft[1]+'/'+txttoarrayleft[2]+'/'+txttoarrayleft[0];


					var laydatefomcatright=txttoarrayright[1]+'/'+txttoarrayright[2]+'/'+txttoarrayright[0];

					$('#changetimesright').val(today());
					$('#changetimesleft').val(weekago());

					console.log(laydatefomcatright);

					$.ajax({
						type: "post",
						url: "  request/dispatcher.do",
						data: {
							url: "http://101.37.100.209:9002/device/getData",
							params: "token=" + token+"&endTime="+laydatefomcatright+"&startTime="+laydatefomcatleft
						},
						success: function (data) {
							console.log(data);
							$(".daysLists ul li").remove();
							var bakgroundli="style='background: #979695'";
							$.each(data.Data, function(i, item) {

								var sleeptime = ((item.lightSleepTime + item.deepSleepTime) / (60 * 60)).toFixed(1);
								var date = new Date(parseInt(item.creatTime));
								var date_fmt=date.format("yyyy-MM-dd");
								$(".daysLists ul").append('<li  data-name="'+item.creatTime+'" class="chooseTime" > <span>'+date_fmt+'</span><span>'+sleeptime+' h</span><span>'+item.score+'</span></li>');

								bindListeners();
								if($(".left_nav").height() > $(".right_show").height()){
									$(".right_show").height($(".left_nav").height()+30);
									$('.holder').css('min-height',$(".left_nav").height());
								}
								else{
									$(".left_nav").height($(".right_show").height()+100);
									$('.holder').css('min-height',$(".right_show").height());
								}
							});
						},
						error: function (data) {
							var txt=data.Message;
							window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.confirm);
						}

					});

				}

                $('#confirm').click(function () {

					var chooseonetimetirng='';
					$(".oneDayLists .chooseTime1").each(function() {
						chooseonetimetirng += $(this).data('name');
					})

					console.log(chooseonetimetirng);

                    var chooseTime1=$('span:first-child','.chooseTime1').text();
					document.cookie="chooseonetimetirng="+chooseonetimetirng;

                    if(chooseTime1!='') {
                        var chooseTime0 = chooseTime1.split('-');
                        var selecttime = chooseTime0[1] + '/' + chooseTime0[2] + '/' + chooseTime0[0];
                    }
                    if(chooseTime1==''){
						var selecttime=$('#changetimemonth').val()+'/'+$('#changetime').val()+'/'+$('#changetimeyear').val();
                    }

                    window.location.href='sleepreport.php?time='+selecttime;
                });
                $('#confirms').click(function () {
					var choosetimesstirng='';
							$(".chooseTime").each(function() {
								choosetimesstirng+=$(this).data('name')+',';
							});
					document.cookie="remember_one_chooselists="+choosetimesstirng;
					var remember_one_chooselists = document.cookie.match(new RegExp("(^| )remember_one_chooselists=([^;]*)(;|$)"));
					console.log(remember_one_chooselists[2]);

if($(".chooseTime").length<2){

	var txt='Select one period from the list';
	window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);

}else{
	window.location.href='SleepAnalysis.php';
}
					//从cookie里面取出选择的时间

//					window.location.href='sleepreport.html?time='+selecttime;
//						window.location.href='SleepAnalysis.html';


                })
            }
            else{
				$('#noemail').hide();
				$('#hasemail').show();
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
//页面加载后单次查询列表显示
                var remember_one_other_selectime =  document.cookie.match(new RegExp("(^| )remember_one_other_selectime=([^;]*)(;|$)"));


                if(remember_one_other_selectime!=null){

                    var txttoarray=remember_one_other_selectime[2].split('/');

					console.log(txttoarray);

                    document.getElementById("changetimeyear").value=txttoarray[2];
                    document.getElementById("changetimemonth").value=txttoarray[0];
                    document.getElementById("changetime").value=txttoarray[1];

                    $.ajax({
                        type: "post",
                        url: "  request/dispatcher.do",
                        data: {
                            url: "http://101.37.100.209:9002/device/getOtherInfo",
                            params: "token=" + token+"&time="+remember_one_other_selectime[2]+"&email="+otheremail
                        },

						//var num=((data.Data[0].sleepStart-data.Data[0].goToBed)/(data.Data[0].outOfBed-data.Data[0].goToBed))*100;

					//深度睡眠比例
                        success: function (data) {
                            console.log(data);
                            $.each(data.Data, function(i, item) {
                                var sleeptime = ((item.lightSleepTime + item.deepSleepTime) / (60 * 60)).toFixed(1);
                                var date = new Date(parseInt(item.creatTime));
                                var date_fmt=date.format("yyyy-MM-dd");
                                $(".oneDayLists ul").append('<li data-name="'+item.creatTime+'" data-="'+item.creatTime+'"> <span>'+date_fmt+'</span><span>'+sleeptime+'  h</span><span>'+item.score+'</span></li>');
                                bindListener();
								if($(".left_nav").height() > $(".right_show").height()){
									$(".right_show").height($(".left_nav").height()+30);
									$('.holder').css('min-height',$(".left_nav").height());
								}
								else{
									$(".left_nav").height($(".right_show").height()+100);
									$('.holder').css('min-height',$(".right_show").height());
								}
                            });
                        },
                        error: function (data) {
                            var txt=data.Message;
                            window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.confirm);
                        }

                    });
                }else{

                    document.getElementById("changetime").value=time;

                    var txttoarray1=$('#changetime').val().split('/');

                    document.getElementById("changetimeyear").value=txttoarray1[2];
                    document.getElementById("changetimemonth").value=txttoarray1[0];
                    document.getElementById("changetime").value=txttoarray1[1];


                    $.ajax({
                        type: "post",
                        url: "  request/dispatcher.do",
                        data: {
                            url: "http://101.37.100.209:9002/device/getOtherInfo",
                            params: "token=" + token+"&time="+time+"&email="+otheremail
                        },
                        success: function (data) {
                            $.each(data.Data, function(i, item) {

                                var sleeptime = ((item.lightSleepTime + item.deepSleepTime) / (60 * 60)).toFixed(1);
                                var date = new Date(parseInt(item.creatTime));
                                var date_fmt=date.format("yyyy-MM-dd");
                                $(".oneDayLists ul").append('<li data-name="'+item.creatTime+'"> <span>'+date_fmt+'</span><span>'+sleeptime+' h</span><span>'+item.score+'</span></li>');
                                bindListener();
								if($(".left_nav").height() > $(".right_show").height()){
									$(".right_show").height($(".left_nav").height()+30);
									$('.holder').css('min-height',$(".left_nav").height());
								}
								else{
									$(".left_nav").height($(".right_show").height()+100);
									$('.holder').css('min-height',$(".right_show").height());
								}

                            });
                        },
                        error: function (data) {
                            alert(data.Message);
//						var txt=data.Message;
//						window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.confirm);
                        }

                    });
                }

//页面加载后多次查询列表显示


				var remember_other_changetimesleft =  document.cookie.match(new RegExp("(^| )remember_other_changetimesleft=([^;]*)(;|$)"));
				var remember_other_changetimesright =  document.cookie.match(new RegExp("(^| )remember_other_changetimesright=([^;]*)(;|$)"));

				if(remember_other_changetimesleft!=null||remember_other_changetimesright!=null){
					var txttoarrayotherleft=remember_other_changetimesleft[2];
					var txttoarrayotherright=remember_other_changetimesright[2];

					$('#changetimesleft').val(txttoarrayotherleft);
					$('#changetimesright').val(txttoarrayotherright);


					var remember_other_changetimesleft1=txttoarrayotherleft.split('/');
					var remember_other_changetimesleftfomcat=remember_other_changetimesleft1[1]+'/'+remember_other_changetimesleft1[2]+'/'+remember_other_changetimesleft1[0];

					var remember_other_changetimesright1=txttoarrayotherright.split('/');
					var remember_other_changetimesrightfomcat=remember_other_changetimesright1[1]+'/'+remember_other_changetimesright1[2]+'/'+remember_other_changetimesright1[0];


					$.ajax({
						type: "post",
						url: "  request/dispatcher.do",
						data: {
							url: "http://101.37.100.209:9002/device/getOtherData",
							params: "token=" + token+"&endTime="+remember_other_changetimesrightfomcat+"&startTime="+remember_other_changetimesleftfomcat+"&email="+otheremail
						},
						success: function (data) {


							var Object={
								avgBreath:21,
								avgHeart:76,
								creatTime:1493283892544,
//						date:0,
								deepSleepTime:900,
								goToBed:1493278176724,
//						id:"5901b434c398f80860099afb",
								lightSleepTime:2100,
								outNum:1,
								outOfBed:1493283330943,
								score:80,
								sleepEnd:1493282705712,
								sleepStart:1493280457045,
								turnNum:95,
//						user:"1680785367385839132"
							}

							$(".daysLists ul li").remove();
							var bakgroundli="style='background: #979695'";
							$.each(data.Data, function(i, item) {
								var sleeptime = ((item.lightSleepTime + item.deepSleepTime) / (60 * 60)).toFixed(1);
								var date = new Date(parseInt(item.creatTime));
								var date_fmt=date.format("yyyy-MM-dd");
								$(".daysLists ul").append('<li  data-name="'+item.creatTime+'" class="chooseTime" > <span>'+date_fmt+'</span><span>'+sleeptime+' h</span><span>'+item.score+'</span></li>');
								bindListeners();
								if($(".left_nav").height() > $(".right_show").height()){
									$(".right_show").height($(".left_nav").height()+30);
									$('.holder').css('min-height',$(".left_nav").height());
								}
								else{
									$(".left_nav").height($(".right_show").height()+100);
									$('.holder').css('min-height',$(".right_show").height());
								}
							});

						},
						error: function (data) {
							var txt=data.Message;
							window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.confirm);
						}

					});
				}else{
					$('#changetimesleft').val(weekago());
					$('#changetimesright').val(today());



					var remember_other_changetimesleft1=weekago().split('/');
					var remember_other_changetimesleftfomcat=remember_other_changetimesleft1[1]+'/'+remember_other_changetimesleft1[2]+'/'+remember_other_changetimesleft1[0];

					var remember_other_changetimesright1=today().split('/');
					var remember_other_changetimesrightfomcat=remember_other_changetimesright1[1]+'/'+remember_other_changetimesright1[2]+'/'+remember_other_changetimesright1[0];



					$.ajax({
						type: "post",
						url: "  request/dispatcher.do",
						data: {
							url: "http://101.37.100.209:9002/device/getOtherData",
							params: "token=" + token+"&endTime="+remember_other_changetimesrightfomcat+"&startTime="+remember_other_changetimesleftfomcat+"&email="+otheremail
						},
						success: function (data) {
							$(".daysLists ul li").remove();
							var bakgroundli="style='background: #979695'";
							$.each(data.Data, function(i, item) {
								var sleeptime = ((item.lightSleepTime + item.deepSleepTime) / (60 * 60)).toFixed(1);
								var date = new Date(parseInt(item.creatTime));
								var date_fmt=date.format("yyyy-MM-dd");
								$(".daysLists ul").append('<li  data-name="'+item.creatTime+'" class="chooseTime" > <span>'+date_fmt+'</span><span>'+sleeptime+' h</span><span>'+item.score+'</span></li>');
								bindListeners();
								if($(".left_nav").height() > $(".right_show").height()){
									$(".right_show").height($(".left_nav").height()+30);
									$('.holder').css('min-height',$(".left_nav").height());
								}
								else{
									$(".left_nav").height($(".right_show").height()+100);
									$('.holder').css('min-height',$(".right_show").height());
								}
								//bindListeners();
							});

						},
						error: function (data) {
							var txt=data.Message;
							window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.confirm);
						}

					});
				}


				$('#confirm').click(function () {

					var chooseothertimestirng='';
					$(".oneDayLists .chooseTime1").each(function() {
						chooseothertimestirng += $(this).data('name');
					})


					var chooseTime1=$('span:first-child','.chooseTime1').text();
					document.cookie="chooseothertimestirng="+chooseothertimestirng;

					if(chooseTime1!='') {
						var chooseTime0 = chooseTime1.split('-');
						var selecttime = chooseTime0[1] + '/' + chooseTime0[2] + '/' + chooseTime0[0];
					}
					if(chooseTime1==''){
						var selecttime=$('#changetimemonth').val()+'/'+$('#changetime').val()+'/'+$('#changetimeyear').val();
					}

					window.location.href='sleepreport.php?time='+selecttime+'&otheremail='+otheremail+'&sn='+getQueryString('sn');
				})



                $('#confirms').click(function () {
					var choosetimesstirng='';
					$(".chooseTime").each(function() {
						choosetimesstirng+=$(this).data('name')+',';
					});
					document.cookie="remember_other_chooselists="+choosetimesstirng;


					if($(".chooseTime").length<2){

						var txt='Select one period from the list';
						window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);

					}else{
						window.location.href='SleepAnalysis.php?&email='+otheremail+'&sn='+getQueryString('sn');;
					}


                })

            }

        });
	</script>

	<script>




		var otheremail=getQueryString('email');

		var sn=getQueryString('sn');

		function otherrealdata() {
			window.location.href='real.php?&email='+otheremail+'&sn='+sn;
		}
	</script>

</head>
<body>
<div class="holder rep bag ">
	<div class="left_nav">
		<div class="header_text" style="    position: relative;top: -47px;">
			<div class="header_text_right">
				<span class="header_pic"><a href="modify.php" ><img src="" id="head"></a></span>
			</div>
		</div>
		<ul  id="noemail" style="display: none;">
			<a href="login.php"><li onclick="quit()"  >Logout</li></a>
			<a href="real.php"><li>Real-time Data</li></a>
			<a href="healthy.php"><li class="on">Health Archives</li></a>
			<a href="addProduct.php"><li>Add device</li></a>
			<a href="deleteProduct.php"><li>Delete device</li></a>
		</ul>
		<ul  id="hasemail" style="display: none;">
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
			<div class="show_detail_data">
				<div class="data_table search">
					<ul class="search_list">
						<li>One report</li>
						<li>Multiple reports</li>
					</ul>
					<div class="one" >
						<div class="reg_input reg_select1  search_time"  id="search_time">
							<input id="changetimeyear" readonly="readonly" /><span>Y</span>
							<input id="changetimemonth" readonly="readonly"/><span>M</span>
							<!--<input id="changetime" name="day" onchange="change()" />-->
							<input id="changetime" name="day" value=" " style="    cursor: pointer;" /><span>D</span>
						</div>
                        <input id="changetimer" name="day" value=""  style="    cursor: pointer;
    position: relative;
    opacity: 0;
    top: -70px;
    right: -415px;
    height: 25px;
    width: 107px;
    border: 1px solid;
"/>
						<!--<input type="button" id='confirm' class=" time_confirm" value="确认">-->

						<div style="margin-top: -25px">
							<ul class="search_list1 table">
								<li>Report date</li>
								<li>Sleep time</li>
								<li>Sleep score</li>
							</ul>
						</div>
						<div class="bottomLine"></div>
						<div class="oneDayLists">
							<ul></ul>
						</div>
						<!--<input type="button" id='confirm' class=" time_confirm" value="确认">-->
						<input type="button" id='confirm' class="submit_submit subSearch" value="Inquiry">
					</div>

					<div class="two">
						<div class="reg_input  reg_select1  ymd1 zhongwen">
							<!--<input id="changetimesleft"  onchange="changes()" />-->
							<input id="changetimesleft" value=" " style="    cursor: pointer;"  onchange="changes()"/>
						</div>
						<i></i>
						<div class="reg_input  reg_select1  ymd1 times2 zhongwen" >
							<!--<span>终</span><input id="changetimesright" value=" " /><span>日期</span>-->
							<input id="changetimesright" value=" " style="    cursor: pointer;"  onchange="changes()" />
						</div>
						<div>
							<ul class="search_list1 table">
								<li>Report date</li>
								<li>Sleep time</li>
								<li>Sleep score</li>
							</ul>
						</div>
						<div class="bottomLine"></div>
						<div class="daysLists">
							<ul></ul>
						</div>
						<input type="button" id='confirms' class="submit_submit subSearch" value="Inquiry">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="  JS/mine.js"></script>
<script>
	$('.right_show').css("padding-bottom",60);

	function show() {



		$(".chooseTime").unbind().each(function(index,item){
			$(item).on("click",function(event){
				$(this).toggleClass('chooseTime');
//					window.location.href='sleepreport.html?time='+selectOneTime;

			});


		});


		var choosetimesstirng='';
		$(".chooseTime").each(function(item) {
//		console.log($(this).data('name'));
			choosetimesstirng+=item.data('name')+',';
		});
		console.log(choosetimesstirng);
//		$(this).toggleClass('chooseTime');


	}

    !function(){

        laydate.skin('yahui');//切换皮肤，请查看skins下面皮肤库

        laydate({elem: '#changetimer',format: 'MM/DD/YYYY',choose: function(datas){ //选择日期完毕的回调

            console.log(datas);
            var selecttime=$('#changetimer').val();

            console.log(selecttime);
            var txttoarray=datas.split('/');

            document.getElementById("changetimeyear").value=txttoarray[0];
            document.getElementById("changetimemonth").value=txttoarray[1];
            document.getElementById("changetime").value=txttoarray[2];
			var laydatetimefomcat=txttoarray[1]+'/'+txttoarray[2]+'/'+txttoarray[0];
//				$("#yearOfBirth").find("option:selected").text('123');
            $(".oneDayLists ul li").remove();

            if(otheremail==null) {
				$('#noemail').show();
				$('#hasemail').hide();
                document.cookie="remember_one_selectime="+laydatetimefomcat;
                $.ajax({
                    type: "post",
                    url: "  request/dispatcher.do",
                    data: {
                        url: "http://101.37.100.209:9002/device/getInfo",
                        params: "token=" + token + "&time=" + laydatetimefomcat
                    },
                    success: function (data) {

                        console.log(data);

                        $.each(data.Data, function (i, item) {

                            var sleeptime = ((item.lightSleepTime + item.deepSleepTime) / (60 * 60)).toFixed(1);

//						var sleeptime=MillisecondToDate((item.lightSleepTime+item.deepSleepTime)*1000);
                            var date = new Date(parseInt(item.creatTime));
                            var date_fmt = date.format("yyyy-MM-dd");
                            $(".oneDayLists ul").append('<li> <span>' + date_fmt + '</span><span>' + sleeptime + '  h</span><span>' + item.score + '</span></li>');
                            bindListener();
							if($(".left_nav").height() > $(".right_show").height()){
								$(".right_show").height($(".left_nav").height()+30);
								$('.holder').css('min-height',$(".left_nav").height());
							}
							else{
								$(".left_nav").height($(".right_show").height()+100);
								$('.holder').css('min-height',$(".right_show").height());
							}
                        });
                    },
                    error: function (data) {
                        var txt = data.Message;
                        window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.confirm);
                    }

                });
            }else{
				$('#noemail').hide();
				$('#hasemail').show();

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
                document.cookie="remember_one_other_selectime="+laydatetimefomcat;
                $.ajax({
                    type: "post",
                    url: "  request/dispatcher.do",
                    data: {
                        url: "http://101.37.100.209:9002/device/getOtherInfo",
                        params: "token=" + token + "&time=" + laydatetimefomcat+ "&email=" + otheremail
                    },
                    success: function (data) {
                        $.each(data.Data, function (i, item) {
                            var sleeptime = ((item.lightSleepTime + item.deepSleepTime) / (60 * 60)).toFixed(1);
                            var date = new Date(parseInt(item.creatTime));
                            var date_fmt = date.format("yyyy-MM-dd");
                            $(".oneDayLists ul").append('<li> <span>' + date_fmt + '</span><span>' + sleeptime + '  h</span><span>' + item.score + '</span></li>');
                            bindListener();
							if($(".left_nav").height() > $(".right_show").height()){
								$(".right_show").height($(".left_nav").height()+30);
								$('.holder').css('min-height',$(".left_nav").height());
							}
							else{
								$(".left_nav").height($(".right_show").height()+100);
								$('.holder').css('min-height',$(".right_show").height());
							}
                        });
                    },
                    error: function (data) {
                        var txt = data.Message;
                        window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.confirm);
                    }

                });

            }

        }});//绑定元素

    }();

    !function(){

                laydate.skin('yahui');//切换皮肤，请查看skins下面皮肤库

                laydate({elem: '#changetimesleft',format: 'MM/DD/YYYY',choose: function(datas){ //选择日期完毕的回调
                    var startTime=$('#changetimesleft').val();
                    var endTime=$('#changetimesright').val();



					var txttoarrayleft=startTime.split('/');
					var txttoarrayright=endTime.split('/');



					var laydatefomcatleft=txttoarrayleft[1]+'/'+txttoarrayleft[2]+'/'+txttoarrayleft[0];


					var laydatefomcatright=txttoarrayright[1]+'/'+txttoarrayright[2]+'/'+txttoarrayright[0];







					var timestamp2 = Date.parse(new Date(startTime));
					timestamp2 = timestamp2 / 1000;

					var timestamp3 = Date.parse(new Date(endTime));
					timestamp3 = timestamp3 / 1000;

					var nowlength=Date.parse(new Date(timestamp3))-Date.parse(new Date(timestamp2));



					var limit=30*3*24*60*60;
					var beginDate=$("#startTime").val();
					var endDate=$("#endTime").val();
					var d1 = new Date(startTime.replace(/\-/g, "\/"));
					var d2 = new Date(endTime.replace(/\-/g, "\/"));

					if(beginDate!=""&&endDate!=""&&d1 >=d2)
					{
						var txt="Start time can not be greater than the end time！";
//						window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);

						window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning,{
							onOk:function(){
								$('#changetimesleft').val(weekago());
							}});


						return false;
					}


					if(Math.round(nowlength)>Math.round(limit)){
						var txt="Please select a date within three months";
						window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning,{
							onOk:function(){
								$('#changetimesleft').val(weekago());
							}});
						return false;

					}else{


						if(otheremail==null){

							document.cookie="remember_one_changetimesleft="+$('#changetimesleft').val();
							document.cookie="remember_one_changetimesright="+$('#changetimesright').val();

							var timeleft=$('#changetimesleft').val();
							var timeright=$('#changetimesright').val();


							$.ajax({
								type: "post",
								url: "  request/dispatcher.do",
								data: {
									url: "http://101.37.100.209:9002/device/getData",
									params: "token=" + token+"&endTime="+laydatefomcatright+"&startTime="+laydatefomcatleft
								},
								success: function (data) {
									console.log(data);
									$(".daysLists ul li").remove();
									var bakgroundli="style='background: #979695'";
									$.each(data.Data, function(i, item) {

										var sleeptime = ((item.lightSleepTime + item.deepSleepTime) / (60 * 60)).toFixed(1);
										var date = new Date(parseInt(item.creatTime));
										var date_fmt=date.format("yyyy-MM-dd");
										$(".daysLists ul").append('<li  data-name="'+item.creatTime+'" class="chooseTime" > <span>'+date_fmt+'</span><span>'+sleeptime+' h</span><span>'+item.score+'</span></li>');

										bindListeners();
										if($(".left_nav").height() > $(".right_show").height()){
											$(".right_show").height($(".left_nav").height()+30);
											$('.holder').css('min-height',$(".left_nav").height());
										}
										else{
											$(".left_nav").height($(".right_show").height()+100);
											$('.holder').css('min-height',$(".right_show").height());
										}
									});
								},
								error: function (data) {
									var txt=data.Message;
									window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.confirm);
								}

							});

						}else{

							document.cookie="remember_other_changetimesleft="+$('#changetimesleft').val();
							document.cookie="remember_other_changetimesright="+$('#changetimesright').val();
							$.ajax({
								type: "post",
								url: "  request/dispatcher.do",
								data: {
									url: "http://101.37.100.209:9002/device/getOtherData",
									params: "token=" + token+"&endTime="+laydatefomcatright+"&startTime="+laydatefomcatleft+"&email="+otheremail
								},
								success: function (data) {
									console.log(data);
									$(".daysLists ul li").remove();
									var bakgroundli="style='background: #979695'";
									$.each(data.Data, function(i, item) {

										var sleeptime = ((item.lightSleepTime + item.deepSleepTime) / (60 * 60)).toFixed(1);
										var date = new Date(parseInt(item.creatTime));
										var date_fmt=date.format("yyyy-MM-dd");
										$(".daysLists ul").append('<li  data-name="'+item.creatTime+'" class="chooseTime" > <span>'+date_fmt+'</span><span>'+sleeptime+' h</span><span>'+item.score+'</span></li>');

										bindListeners();
										if($(".left_nav").height() > $(".right_show").height()){
											$(".right_show").height($(".left_nav").height()+30);
											$('.holder').css('min-height',$(".left_nav").height());
										}
										else{
											$(".left_nav").height($(".right_show").height()+100);
											$('.holder').css('min-height',$(".right_show").height());
										}
									});
								},
								error: function (data) {
									var txt=data.Message;
									window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.confirm);
								}

							});


						}
					}


                }});//绑定元素

            }();

    !function(){


        laydate.skin('yahui');//切换皮肤，请查看skins下面皮肤库

        laydate({elem: '#changetimesright',format: 'MM/DD/YYYY',choose: function(datas){ //选择日期完毕的回调

			var startTime=$('#changetimesleft').val();
			var endTime=$('#changetimesright').val();



			var txttoarrayleft=startTime.split('/');
			var txttoarrayright=endTime.split('/');



			var laydatefomcatleft=txttoarrayleft[1]+'/'+txttoarrayleft[2]+'/'+txttoarrayleft[0];


			var laydatefomcatright=txttoarrayright[1]+'/'+txttoarrayright[2]+'/'+txttoarrayright[0];

            var beginDate=$("#startTime").val();
            var endDate=$("#endTime").val();
            var d1 = new Date(startTime.replace(/\-/g, "\/"));
            var d2 = new Date(endTime.replace(/\-/g, "\/"));




			var chooseTimearray = new Array();


			var timestamp2 = Date.parse(new Date(startTime));
			timestamp2 = timestamp2 / 1000;

			var timestamp3 = Date.parse(new Date(endTime));
			timestamp3 = timestamp3 / 1000;

			var nowlength=Date.parse(new Date(timestamp3))-Date.parse(new Date(timestamp2));

			if(beginDate!=""&&endDate!=""&&d1 >=d2)
			{
				var txt="Start time can not be greater than the end time！";
				window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning,{
					onOk:function(){
						$('#changetimesright').val(today());
					}});
				return false;
			}


			var limit=30*3*24*60*60;


			if(Math.round(nowlength)>Math.round(limit)){

				var txt="Please select a date within three months";
				window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning,{
					onOk:function(){
						$('#changetimesright').val(today());
					}});
				return false;

			}
			else{
				document.cookie="remember_other_changetimesleft="+$('#changetimesleft').val();
				document.cookie="remember_other_changetimesright="+$('#changetimesright').val();

				if(otheremail==null){



					document.cookie="remember_one_changetimesleft="+$('#changetimesleft').val();
					document.cookie="remember_one_changetimesright="+$('#changetimesright').val();

					$.ajax({
						type: "post",
						url: "  request/dispatcher.do",
						data: {
							url: "http://101.37.100.209:9002/device/getData",
							params: "token=" + token+"&endTime="+laydatefomcatright+"&startTime="+laydatefomcatleft
						},
						success: function (data) {
							console.log(data);
							$(".daysLists ul li").remove();
							 var bakgroundli="style='background: #979695'";
							$.each(data.Data, function(i, item) {

								var sleeptime = ((item.lightSleepTime + item.deepSleepTime) / (60 * 60)).toFixed(1);
								var date = new Date(parseInt(item.creatTime));
								var date_fmt=date.format("yyyy-MM-dd");
								$(".daysLists ul").append('<li   data-name="'+item.creatTime+'" class="chooseTime" > <span>'+date_fmt+'</span><span>'+sleeptime+' h</span><span>'+item.score+'</span></li>');

								bindListeners();
								if($(".left_nav").height() > $(".right_show").height()){
									$(".right_show").height($(".left_nav").height()+30);
									$('.holder').css('min-height',$(".left_nav").height());
								}
								else{
									$(".left_nav").height($(".right_show").height()+100);
									$('.holder').css('min-height',$(".right_show").height());
								}
							});
						},
						error: function (data) {
							var txt=data.Message;
							window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.confirm);
						}

					});

				}else{
					document.cookie="remember_other_changetimesleft="+$('#changetimesleft').val();
					document.cookie="remember_other_changetimesright="+$('#changetimesright').val();
					$.ajax({
						type: "post",
						url: "  request/dispatcher.do",
						data: {
							url: "http://101.37.100.209:9002/device/getOtherData",
							params: "token=" + token+"&endTime="+laydatefomcatright+"&startTime="+laydatefomcatleft+"&email="+otheremail
						},
						success: function (data) {
							console.log(data);
							$(".daysLists ul li").remove();
							var bakgroundli="style='background: #979695'";
							$.each(data.Data, function(i, item) {

								var sleeptime = ((item.lightSleepTime + item.deepSleepTime) / (60 * 60)).toFixed(1);
								var date = new Date(parseInt(item.creatTime));
								var date_fmt=date.format("yyyy-MM-dd");
								$(".daysLists ul").append('<li  data-name="'+item.creatTime+'" class="chooseTime" > <span>'+date_fmt+'</span><span>'+sleeptime+' h</span><span>'+item.score+'</span></li>');

								bindListeners();
								if($(".left_nav").height() > $(".right_show").height()){
									$(".right_show").height($(".left_nav").height()+30);
									$('.holder').css('min-height',$(".left_nav").height());
								}
								else{
									$(".left_nav").height($(".right_show").height()+100);
									$('.holder').css('min-height',$(".right_show").height());
								}
							});
						},
						error: function (data) {
							var txt=data.Message;
							window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.confirm);
						}

					});



				}
			}



        }});//绑定元素

    }();


</script>
</body>

</html>