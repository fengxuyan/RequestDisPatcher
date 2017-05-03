<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Real Data</title>
    <script src="/RequestDisPatcher/JS/jquery-3.2.0.min.js"></script>

    <link rel="stylesheet" type="text/css" href="/RequestDisPatcher/CSS/layout.css">
    <link rel="stylesheet" type="text/css" href="/RequestDisPatcher/CSS/global.css">
    <link rel="stylesheet" type="text/css" href="/RequestDisPatcher/CSS/font-awesome.min.css">
    <script src="/RequestDisPatcher/JS/xcConfirm.js"></script>
    <link rel="stylesheet" type="text/css" href="/RequestDisPatcher/CSS/xcConfirm.css"/>
    <script src="/RequestDisPatcher/JS/jquery-3.2.0.min.js"></script>
    <script src="/RequestDisPatcher/JS/jquery-ui.js"></script>
    <script src="/RequestDisPatcher/JS/number-pb.js"></script>
    <script src="/RequestDisPatcher/JS/jquery.cookie.js"></script>

    <style>
        .block_pic{
            overflow:hidden;
            width: 591px;
        }
        .lixian{
            background:#000;
            background-size: 10px 116px;
            display: inline-block;
            height:116px;
            width:6px;
            /*margin-left: -2px;*/
        }
        .wuren{
            border-left:dotted 2px #D5D5D5;
            /*background: url("images/noperson_block.png")!important; ;*/
            /*background-size: 10px 116px;*/
            display: inline-block;
            height:116px;
            width:3px;
            margin-left: -2px;
        }
        .wuren2{
            border-left:dotted 2px #D5D5D5;
            /*background: url("images/noperson_block.png")!important; ;*/
            /*background-size: 10px 116px;*/
            display: inline-block;
            height:116px;
            width:3px;
            margin-left: -2px;
        }
        .fanshen{
            background: url("images/onmove_block.png")!important; ;
            background-size: 12px 116px;
            display: inline-block;
            height:116px;
            width:3px;
            margin-left: -2px;
        }
        .youren{
            background: url("images/onbed_block.png")!important; ;
            background-size: 12px 116px;
            display: inline-block;
            height:116px;
            width:3px;
            margin-left: -2px;
        }
        .tidong{
            background: url("images/onmove_block.png")!important; ;
            background-size: 12px 116px;
            display: inline-block;
            height:116px;
            width:3px;
            margin-left: -2px;
        }
        .time.time1 span{
            float:right;
            padding-top: 7px;
            font-weight: normal;
            margin-left: 12px;
            margin-right: -68px;
        }
        #sj span{
            float:left;
            padding-top: 31px;
            font-weight: normal;
            /*margin-left: 12px;*/
            margin-left: -68px;
        }
    </style>
</head>
<script type="text/javascript">
    //	function checktoken() {
    //		var userInfo = document.cookie.match(new RegExp("(^| )userData=([^;]*)(;|$)"));
    //		var info = JSON.parse(userInfo[2]);
    //		var token = info.token;
    //		$.ajax({
    //			type:"post",
    //			url:"/RequestDisPatcher/request/dispatcher.do",
    //			data: {
    //				url:"http://127.0.0.1:9001/login/checkToken",
    //				params:"token="+token
    //			},
    //			success: function (data) {
    ////					1、未失效，1006、已失效
    //				if(data.Code==1) {
    //					return true;
    //				}
    //				else if(data.Code==1006){
    //					return false;
    //				}
    //			},
    //			error: function (data) {
    //			}
    //		});
    //	}
    //	if(!checktoken()){
    //
    //		window.location.href = "login.html";//location.href实现客户端页面的跳转
    //
    //
    //	};
    var userInfo = document.cookie.match(new RegExp("(^| )userData=([^;]*)(;|$)"));

    if(userInfo==null){
        window.location.href = "login.php";//location.href实现客户端页面的跳转
    };

    function myrefresh()
    {
        window.location.reload();
    }
    var userInfo = document.cookie.match(new RegExp("(^| )userData=([^;]*)(;|$)"));

    if(userInfo==null){
        window.location.href = "login.php";//location.href实现客户端页面的跳转
    };
    setTimeout('myrefresh()',500*60*30); //指定1秒刷新一次
    function quit() {
        var userInfo = document.cookie.match(new RegExp("(^| )userData=([^;]*)(;|$)"));
        $.ajax({
            type:"post",
            url:"/RequestDisPatcher/request/dispatcher.do",
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
    var otheremail=getQueryString('email');
    var sn=getQueryString('sn');
    console.log(getQueryString('email'));
    $(document).ready(function() {

        if(otheremail==null) {
            $('#noemail').show();
            $('#hasemail').hide();

        }else{

            $('#noemail').hide();
            $('#hasemail').show();
            $.ajax({
                type:"POST",
                url:"/RequestDisPatcher/request/dispatcher.do",
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


        }

        status=0;
        countfanshen=0;
        //进入页面或者刷新页面之后清除旧的cookie值
        var showpic_event=$.cookie('showpic_event');
        if((showpic_event!=undefined)&&(showpic_event!=null)&&(showpic_event!='')){
            $.cookie('showpic_event',null);
        }
        //清除心率的cookie
        document.cookie = "heart0="+'';
        document.cookie = "heart1="+'';
        document.cookie = "heart2="+'';
        //清除睡眠事件cookie
        document.cookie = "event0="+'';
        document.cookie = "event1="+'';
        document.cookie = "event2="+'';
        document.cookie = "event3="+'';
        document.cookie="sleep_event_ex="+'';
        //清除翻身次数记录
        document.cookie="fs_number="+'';
        setInterval("fetchData(otheremail)",10000);
        var userInfo = document.cookie.match(new RegExp("(^| )userData=([^;]*)(;|$)"));
        var info = JSON.parse(userInfo[2]);
        var Info = info['userInfo'];
        var first = Info.firstName;
        var middle = Info.middleName;
        var last = Info.lastName;
        var gender = Info.gender;
        var token = Info.token;
        var image=Info.image;
        if(image==null){
            if(gender==1){
                $('#head').attr('src','Heads/header_man.png');
            }else if(gender==0){
                $('#head').attr('src','Heads/header_woman.png');
            }
        }else{
            $('#head').attr('src',image);
        }
    })
    window.onload = fetchData(otheremail);
    // timeHandle();
    //拼接成新的数组
    function arrayHandle(array,obj){
        if(array.length==180){
            array1 = array.slice(1,179);
        }
        return array.concat(obj);
    }
    window.onload = function timeHandle(){
        var time = new Date();
        //获取当前年
        var year = myDate.getFullYear();
        //获取当前月
        var month = myDate.getMonth() + 1;
        //获取当前日S
        var time_getHours = (time.getHours() < 10 ? ('0' + time.getHours() ): ('' + time.getHours()));
        var time_getMinutes = (time.getMinutes() < 10 ? ('0' + time.getMinutes() ): ('' + time.getMinutes()));
        //var time_getSeconds = (time.getSeconds() < 10 ? ('0' + time.getSeconds()) : ('' + time.getSeconds()));
        var tnow =  time_getHours + ":" + time_getMinutes;
        var d1=new Date();
        var d2=new Date(d1.getTime()+1*60*30*500);
        var getMinutes = (d2.getMinutes() < 10 ? ('0' + d2.getMinutes() ): ('' + d2.getMinutes()));
        var getHours = (d2.getHours() < 10 ? ('0' + d2.getHours() ): ('' + d2.getHours()));
        //var getSeconds = (d2.getSeconds() < 10 ? ('0' + d2.getSeconds()) : ('' + d2.getSeconds()));
        var tnext=getHours+":"+getMinutes;
        console.log(tnext);
        document.getElementById("time1_append1").innerText = tnow;
        document.getElementById("time1_append2").innerText = tnext;
    }

    /*

     30分钟
     一个小间距为一分钟，十秒刷新一次
     一分钟画6ci，
     600px
     20px,一分钟
     20/6=3.3


     4*6*30=24*3*10=720px


     */

    function drawdot2() {
        var svg='<svg style="width:8px;height:120px;float:left;" xmlns="http://www.w3.org/2000/svg" version="1.1">  <g fill="none" stroke="#8A847F" stroke-width="2"> <path stroke-dasharray="2,12" d="M 4 8 4 120"></path> </g> </svg>';
        return svg;
    }
    function drawdot() {
        var svg=' <svg style="width:8px;height:130px;float:left;" xmlns="http://www.w3.org/2000/svg" version="1.1"> <g fill="none" stroke="#8A847F" stroke-width="2"> <path stroke-dasharray="2,12" d="M 4 1 4 130"></path> </g></svg></svg>';
        return svg;
    }
    function drawboxing(){
        var svg='<svg style="width:8px;height:120px;float:left;border:0;"version="1.1"xmlns="http://www.w3.org/2000/svg"> <rect width="8" height="120"style="fill:#C6BDB5;stroke-width:0;stroke:rgb(0,0,0)"/> <polyline points="0,20 8,13 "style="fill:none;stroke:#fff;stroke-width:0.7"/> <polyline points="0,40 8,33 "style="fill:none;stroke:#fff;stroke-width:0.7"/> <polyline points="0,60 8,53  "style="fill:none;stroke:#fff;stroke-width:0.7"/> <polyline points="0,80 8,73"style="fill:none;stroke:#fff;stroke-width:0.7"/> <polyline points="0,100 8,93  "style="fill:none;stroke:#fff;stroke-width:0.7"/>';
        return svg;
    }
    function drawboxing2(){
        var svg='<svg style="width:8px;height:120px;float:left;border:0;"version="1.1"xmlns="http://www.w3.org/2000/svg"> <rect width="8" height="120"style="fill:#C6BDB5;stroke-width:0;stroke:rgb(0,0,0)"/> 	 <polyline points="0,13 8,20 "style="fill:none;stroke:#fff;stroke-width:0.7"/> <polyline points="0,33 8,40 "style="fill:none;stroke:#fff;stroke-width:0.7"/> <polyline points="0,53 8,60  "style="fill:none;stroke:#fff;stroke-width:0.7"/> <polyline points="0,73 8,80 "style="fill:none;stroke:#fff;stroke-width:0.7"/> <polyline points="0,93 8,100  "style="fill:none;stroke:#fff;stroke-width:0.7"/>';
        return svg;
    }
    function drawhengxian() {
        var svg='<svg style="width:8px;height:120px;float:left;border:0;"version="1.1"xmlns="http://www.w3.org/2000/svg"> <rect width="8" height="120"style="fill:#8A847F;stroke-width:0;stroke:rgb(0,0,0)"/>  <path  d="M 0 20 L 8 20" stroke="#FFF" stroke-width="0.7" fill="none" />  <path  d="M 0 40 L 8 40" stroke="#FFF" stroke-width="0.7" fill="none" />  <path  d="M 0 60 L 8 60" stroke="#FFF" stroke-width="0.7" fill="none" />  <path  d="M 0 80 L 8 80" stroke="#FFF" stroke-width="0.7" fill="none" />  <path  d="M 0 100 L 8 100" stroke="#FFF" stroke-width="0.7" fill="none" />  </svg>';
        return svg;
    }
    function drawlixian() {
        var svg='<svg style="width:8px;height:120px;float:left;border:0;"version="1.1"xmlns="http://www.w3.org/2000/svg"> <rect width="8" height="120"style="fill:#595757;stroke-width:0;stroke:rgb(0,0,0)"/>';
        return svg;
    }
    function js_method_healthy() {
        var userInfo = document.cookie.match(new RegExp("(^| )userData=([^;]*)(;|$)"));
        var info = JSON.parse(userInfo[2]);
        var Info = info['userInfo'];
        var first = Info.firstName;
        var middle = Info.middleName;
        var last = Info.lastName;
        var gender = Info.gender;
        var image=Info.image;
        var device=Info.device;
        if(otheremail==null&&device==null){
            console.log(' see  this!');
            return false;
        }else{
            location.href = "healthy.html";
        }
    }
    function fetchData(otheremail){
        if ($.cookie('the_cookie') == '') {
            location.href = "login.php";//location.href实现客户端页面的跳转
        }
        var userInfo = document.cookie.match(new RegExp("(^| )userData=([^;]*)(;|$)"));
        var info = JSON.parse(userInfo[2]);
        var Info = info['userInfo'];
        var first = Info.firstName;
        var middle = Info.middleName;
        var last = Info.lastName;
        var gender = Info.gender;
        var image=Info.image;
        var device=Info.device;
        if(otheremail==null&&device==null){
//			var txt="没有数据";
//			window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.info);
            window.history.go(-1);
        }
        if(otheremail==null&&device!=null){
            $('#noemail').show();
            $('#hasemail').hide();

            $.ajax({
                type:"post",
                url:"/RequestDisPatcher/request/dispatcher.do",
                data: {
                    url:"http://101.37.100.209:9000/api/realdata",
                    params:"sn="+device[0]
                },
                success: function (data) {
//					var showpic_event1=$.cookie('showpic_event').split(',');
//					console.log("showpic_event1:"+showpic_event1);
//					var cookie_arr = [];//用来存放sleep_event;
//					if(showpic_event1=='null'){ //cookie中不存在以前的记录
//						cookie_arr = arrayHandle(cookie_arr,data.Data.event);
//					}else{
//						cookie_arr = arrayHandle(showpic_event1,data.Data.event);
//					}
//					$.cookie('showpic_event', cookie_arr.join(','));
//					$.cookie('showpic_eventer',data.Data.event);

                    console.log(data.Data.heart);

                    if(data.Data.heart==0){

                        $('.heart_pic').css('height','0px');
//						$('.heart_pic').css('background-image','url(images/600.gif) ');
                    }
                    if(0<data.Data.heart&&data.Data.heart<=60){
                        $('.heart_pic').css('height','120px');

                        $('.heart_pic').css('background-image','url(images/60.gif) ');
                    }
                    if(60<data.Data.heart&&data.Data.heart<=70){

                        $('.heart_pic').css('height','120px');
                        $('.heart_pic').css('background-image','url(images/70.gif) ');
                    }
                    if(70<data.Data.heart&&data.Data.heart<=80){

                        $('.heart_pic').css('height','120px');
                        $('.heart_pic').css('background-image','url(images/80.gif) ');
                    }
                    if(80<data.Data.heart&&data.Data.heart<=90){

                        $('.heart_pic').css('height','120px');
                        $('.heart_pic').css('background-image','url(images/90.gif) ');
                    }
                    if(90<data.Data.heart&&data.Data.heart<=100){
                        $('.heart_pic').css('height','120px');
                        $('.heart_pic').css('background-image','url(images/100.gif) ');
                    }
                    if(100<data.Data.heart&&data.Data.heart){

                        $('.heart_pic').css('height','120px');
                        $('.heart_pic').css('background-image','url(images/100.gif) ');
                    }

                    //清除追加内容
                    $('.showHeartNumber span').remove();
                    $('.showBreathNumber span').remove();

                    if( data.Data.heart!=0 && data.Data.breath==0){
                        data.Data.breath = data.Data.heart/4;
                    }

                    var heart=heartHandle(data.Data.heart);


                    //心跳不为零 呼吸率为零的时候 使用理论呼吸率


//					var calculatebreath;

                    var theorybreath=data.Data.heart/4;
                    if(data.Data.breath==0&&data.Data.heart!=0){
                        var calculatebreath=theorybreath;
                    }else{
                        var calculatebreath=theorybreath+(data.Data.breath-theorybreath)/3;
                    }


                    $('.showHeartNumber').append("<span>"+heart+"</span><span>bpm</span>");
                    $('.showBreathNumber').append("<span>"+Math.round(calculatebreath)+"</span><span>breaths/Min</span>");
                    /*
                     根据实时数据不同 根据状态绘制拼接block_pic 的背景图
                     ajax请求返回状态 根据状态append div div对应着背景图  刷新当前页面 超出最外面的框就隐藏
                     同时更改心率呼吸率
                     */
                    /*
                     //当前策略： 翻身算作体动
                     //如果连续监测到多次体动 绘制前两次的  然后绘制在床 当次数多达4次以上 则继续绘制体动
                     //当前策略  由于体动监测过于敏感 将体动算作在床  翻身算作体动
                     private final int MOVE = 10;            //体动
                     private final int NO_PERSON = 4;        //无人
                     private final int ON_BED = 2;           //有人
                     private final int TURN_OFF = 3;        //翻身
                     private final int OFF_LINE = 0;         //离线
                     */
                    var div1=$('.block_pic');
                    sleep_event = eventHandle(data.Data.event)
                    if(sleep_event==0){
                        div1.append(drawlixian());
                    }
                    else if(sleep_event==10){
                        div1.append(drawhengxian());
                    }
                    else if(sleep_event==2){
                        div1.append(drawhengxian());
                    }
                    else if(sleep_event==3){
                        if(status=='0'){
                            div1.append(drawboxing());
                            status=1;
                        }else if(status=='1'){
                            div1.append(drawboxing2());
                            status=0;
                        };
                    }
                    else if(sleep_event==4){
                        if(status=='0'){
                            div1.append(drawdot());
                            status=1;
                        }else if(status=='1'){
                            div1.append(drawdot2());
                            status=0;
                        };
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }else if(sn!=null) {

            $('#noemail').hide();
            $('#hasemail').show();


            $.ajax({
                type:"post",
                url:"/RequestDisPatcher/request/dispatcher.do",
                data: {
                    url:"http://101.37.100.209:9000/api/realdata",
                    params:"sn="+sn
                },
                success: function (data) {
                    var showpic_event1=$.cookie('showpic_event').split(',');
//					console.log("showpic_event1:"+showpic_event1);
                    var cookie_arr = [];//用来存放sleep_event;
                    if(showpic_event1=='null'){ //cookie中不存在以前的记录
                        cookie_arr = arrayHandle(cookie_arr,data.Data.event);
                    }else{
                        cookie_arr = arrayHandle(showpic_event1,data.Data.event);
                    }
                    $.cookie('showpic_event', cookie_arr.join(','));


                    console.log(data.Data.heart);



                    if(data.Data.heart==0){

                        $('.heart_pic').css('height','0px');
//						$('.heart_pic').css('background-image','url(images/600.gif) ');
                    }
                    if(0<data.Data.heart&&data.Data.heart<=60){
                        $('.heart_pic').css('height','120px');

                        $('.heart_pic').css('background-image','url(images/60.gif) ');
                    }
                    if(60<data.Data.heart&&data.Data.heart<=70){

                        $('.heart_pic').css('height','120px');
                        $('.heart_pic').css('background-image','url(images/70.gif) ');
                    }
                    if(70<data.Data.heart&&data.Data.heart<=80){

                        $('.heart_pic').css('height','120px');
                        $('.heart_pic').css('background-image','url(images/80.gif) ');
                    }
                    if(80<data.Data.heart&&data.Data.heart<=90){

                        $('.heart_pic').css('height','120px');
                        $('.heart_pic').css('background-image','url(images/90.gif) ');
                    }
                    if(90<data.Data.heart&&data.Data.heart<=100){
                        $('.heart_pic').css('height','120px');
                        $('.heart_pic').css('background-image','url(images/100.gif) ');
                    }
                    if(100<data.Data.heart&&data.Data.heart){

                        $('.heart_pic').css('height','120px');
                        $('.heart_pic').css('background-image','url(images/100.gif) ');
                    }
                    //清除前一次追加内容
                    $('.showHeartNumber span').remove();
                    $('.showBreathNumber span').remove();
                    if( data.Data.heart!=0 && data.Data.breath==0){
                        data.Data.breath = data.Data.heart/4;
                    }
                    var heart=heartHandle(data.Data.heart);

                    var theorybreath=data.Data.heart/4;
                    if(data.Data.breath==0&&data.Data.heart!=0){
                        var calculatebreath=theorybreath;
                    }else{
                        var calculatebreath=theorybreath+(data.Data.breath-theorybreath)/3;
                    }


                    $('.showHeartNumber').append("<span>"+heart+"</span><span>bpm</span>");
                    $('.showBreathNumber').append("<span>"+Math.round(calculatebreath)+"</span><span>breaths/Min</span>");


                    /*
                     根据实时数据不同 根据状态绘制拼接block_pic 的背景图
                     ajax请求返回状态 根据状态append div div对应着背景图  刷新当前页面 超出最外面的框就隐藏
                     同时更改心率呼吸率
                     */
                    var div1=$('.block_pic');
                    /*
                     //当前策略： 翻身算作体动
                     //如果连续监测到多次体动 绘制前两次的  然后绘制在床 当次数多达4次以上 则继续绘制体动
                     //当前策略  由于体动监测过于敏感 将体动算作在床  翻身算作体动
                     private final int MOVE = 10;            //体动
                     private final int NO_PERSON = 4;        //无人
                     private final int ON_BED = 2;           //有人
                     private final int TURN_OFF = 3;        //翻身
                     private final int OFF_LINE = 0;         //离线
                     */

                    sleep_event = eventHandle(data.Data.event)
                    if(sleep_event==0){
                        div1.append(drawlixian());
                    }
                    else if(sleep_event==10){
                        div1.append(drawhengxian());
                    }
                    else if(sleep_event==2){
                        div1.append(drawhengxian());
                    }
                    else if(sleep_event==3){
                        if(status=='0'){
                            div1.append(drawboxing());
                            status=1;
                        }else if(status=='1'){
                            div1.append(drawboxing2());
                            status=0;
                        };
                    }
                    else if(sleep_event==4){
                        if(status=='0'){
                            div1.append(drawdot());
                            status=1;
                        }else if(status=='1'){
                            div1.append(drawdot2());
                            status=0;
                        };
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }else{
        }
    }
    //对heart进行处理,没有heart值直接返回，有heart返回平均值
    function heartHandle(heart){
        if(heart==0){
            return heart;
        }

        var heart0 = document.cookie.match(new RegExp("(^| )heart0=([^;]*)(;|$)"));
        if(heart0[2] == null ||heart0[2] == '' ||heart0[2] == ""){
            document.cookie = "heart0="+heart;
            return heart;
        }
        var heart1 = document.cookie.match(new RegExp("(^| )heart1=([^;]*)(;|$)"));
        if(heart1[2] == null ||heart1[2] == '' ||heart1[2] == ""){
            document.cookie = "heart1="+heart;
            return Math.round( (Math.round(heart0[2])+heart)/2);
        }
        var heart2 = document.cookie.match(new RegExp("(^| )heart2=([^;]*)(;|$)"));
        if(heart2[2] == null ||heart2[2] == '' ||heart2[2] == ""){
            document.cookie = "heart2="+heart;
            return Math.round((Math.round(heart0[2])+Math.round(heart1[2])+heart)/3);
        }else{   //cookie已经存入3个heart，清除第一个heart重新保存
            document.cookie = "heart0="+heart1[2];
            document.cookie = "heart1="+heart2[2];
            document.cookie = "heart2="+heart;
            console.log(Math.round(heart1[2]));
            console.log((Math.round(heart1[2])+Math.round(heart2[2])+heart)/3);
            return Math.round((Math.round(heart1[2])+Math.round(heart2[2])+heart)/3);
        }
    }
    //睡眠事件处理
    function eventHandle(event) {

        var sleep_event_ex = document.cookie.match(new RegExp("(^| )sleep_event_ex=([^;]*)(;|$)"));

        if (event != 0 && event != 2 && event != 3 && event != 4 && event != 10) { //异常睡眠事件取前一个状态,没有前一个状态就返回空
            if (sleep_event_ex[2] == null || sleep_event_ex[2] == '' || sleep_event_ex[2] == "")
                return '';
            else {
                event = sleep_event_ex[2];
            }
        } else {
            document.cookie = "sleep_event_ex=" + event;
        }


        if(event != 3){
            document.cookie="fs_number="+'';
            document.cookie = "event0="+'';
            document.cookie = "event1="+'';
            document.cookie = "event2="+'';
            document.cookie = "event3="+'';
        }

        var fs_number = document.cookie.match(new RegExp("(^| )fs_number=([^;]*)(;|$)"));

        var event0 = document.cookie.match(new RegExp("(^| )event0=([^;]*)(;|$)"));

        if(event0[2] == null ||event0[2] == '' ||event0[2] == ""){
            if(event != 0 && event != 2 && event != 3 && event !=4 && event !=10){ //异常睡眠事件取前一个状态,没有前一个状态就返回空
                document.cookie = "event0="+'';
                return '';
            }
            if(event==3)
                document.cookie = "event0="+event;
            return event;
        }

        var event1 = document.cookie.match(new RegExp("(^| )event1=([^;]*)(;|$)"));

        if(event1[2] == null ||event1[2] == '' ||event1[2] == ""){

            if(event != 0 && event != 2 && event != 3 && event !=4 && event !=10){ //异常睡眠事件取前一个状态
                document.cookie = "event1="+event0[2];
                return event0[2];
            }
            if(event==3)
                document.cookie = "event1="+event;
            return event;
        }

        var event2 = document.cookie.match(new RegExp("(^| )event2=([^;]*)(;|$)"));

        if(event2[2] == null ||event2[2] == '' ||event2[2] == ""){

            if(fs_number[2] == null ||fs_number[2] == '' ||fs_number[2] == ""){ //之前未出现长时间连续翻身的情况
                if(event0[2]== 3 && event1[2]== 3 && event==3){ //两次翻身，第三次翻身置为在床
                    event = 2;
                    document.cookie = "event2="+event;
                    //document.cookie="fs_number="+"heheda";// 只允许出现2个翻身，之后可随意
                }
            }

            if(event != 0 && event != 2 && event != 3 && event !=4 && event !=10){ //异常睡眠事件取前一个状态
                document.cookie = "event2="+event1[2];
                return event1[2];
            }
            if(event==3)
                document.cookie = "event2="+event;
            return event;
        }

        var event3 = document.cookie.match(new RegExp("(^| )event3=([^;]*)(;|$)"));

        if(event3[2] == null ||event3[2] == '' ||event3[2] == ""){

            if(fs_number[2] == null ||fs_number[2] == '' ||fs_number[2] == ""){ //之前未出现长时间连续翻身的情况
                if(event0[2]== 3 && event1[2]== 3 && event==3){ //两次翻身，第四次翻身置为在床
                    event = 2;
                    document.cookie = "event3="+event;
                    document.cookie="fs_number="+"heheda";// 第一次只允许出现2个翻身，之后可随意
                }
            }

            if(event != 0 && event != 2 && event != 3 && event !=4 && event !=10){ //异常睡眠事件取前一个状态
                document.cookie = "event3="+event2[2];
                return event2[2];
            }
            if(event==3)
                document.cookie = "event3="+event;
            else{
                document.cookie = "event0="+'';
                document.cookie = "event1="+'';
                document.cookie = "event2="+'';
                document.cookie = "event3="+'';
            }
            return event;
        }else{ //cookie存四个睡眠事件，超过就清除前面的
            document.cookie = "event0="+event1[2];
            document.cookie = "event1="+event2[2];
            document.cookie = "event2="+event3[2];
            if(event != 0 && event != 2 && event != 3 && event !=4 && event !=10){ //异常睡眠事件取前一个状态
                document.cookie = "event3="+event3[2];
                return event3[2];
            }
            if(event==3)
                document.cookie = "event3="+event;
            return event;
        }

    }


</script>
<script>


    var otheremail=getQueryString('email');
    console.log(otheremail);

    var sn=getQueryString('sn');
    function otherrealdata() {
        window.location.href='healthy.php?&email='+otheremail+'&sn='+sn;
    }

</script>
<body>
<div class="holder">
    <div class="left_nav">
        <div class="header_text">
            <div class="header_text_right">
                <span class="header_pic"><a href="modify.php" ><img src="" id="head"></a></span>
            </div>
        </div>
        <ul  id="noemail" style="display: none;">
            <a href="login.php"><li onclick="quit()"  >Logout</li></a>
            <a href="real.php"><li class="on">Real-time Data</li></a>
            <a href="healthy.php"><li >Health Archives</li></a>
            <a href="addProduct.php"><li>Add device</li></a>
            <a href="deleteProduct.php"><li>Delete device</li></a>
        </ul>
        <ul  id="hasemail" style="display: none;">
            <a href="login.php"><li onclick="quit()"  >Logout</li></a>
            <a><li class="on"  >Real-time Data</li></a>
            <a><li onclick="otherrealdata()">Health Archives</li></a>
            <li></li>
            <li></li>
        </ul>
    </div>
    <div class="right_show">
        <h4 class="titl">isleep</h4>
        <a href="homepage.php"><span class="home"></span></a>
        <div class="show_detail">
            <div class="show_detail_data">
                <div class="data_table real_table">

                    <div class="left_heart_rate">

                        <div class="heart_txt"><span>Heart rate</span></div>
                        <div class="heart_pic">

                            <div class="showHeartNumber">
                                <!--<span>90</span>-->
                                <!--<span>bpm</span>-->
                            </div>

                        </div>

                    </div>


                    <div class="centerdiv"></div>


                    <div class="right_breath_rate">
                        <div class="breath_txt"><span>Respiration</span></div>
                        <div class="breath_pic">
                            <div class="showBreathNumber">
                                <!--<span>90</span>-->
                                <!--<span>bpm</span>-->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="clear"></div>

            <!--<iframe  src='show_detail_status.html' name="a" id="a">-->

            <div id="zt" class="show_detail_status">
                <ul class="status">
                    <li class="itmes"><span>Status</span></li>
                    <li>
                        <label for="ztai" id="status">
                            <input type="checkbox" name="ztai" value="ztai" />

                        </label>
                    </li>

                    <li>
                        <label for="ztai" id="onbed">
                            <input type="checkbox" name="ztai" value="ztai" />
                        </label>
                    </li>
                    <li>
                        <label for="ztai" id="nomove">
                            <input type="checkbox" name="ztai" value="ztai" />

                        </label>
                    </li>
                    <li>
                        <label for="ztai" id="noperson1">
                            <input type="checkbox" name="ztai" value="ztai" />
                        </label>
                    </li>

                </ul>
                <div class="status_txt">
                    <span class="i1"></span><span class="i11">Off-Line</span>
                    <span class="i2"></span><span class="i22">In bed</span>
                    <span class="i3"></span><span class="i33">Body moving</span>
                    <span class="i4"></span><span class="i44">Nobody</span>

                </div>

            </div>
            <div class="block_pic" style="width:720px;margin-left: 12px"></div>
            <div class="time" id="sj" style="   margin-left: 9px; background-size: 720px;">
                <span id='time1_append1'></span>
            </div>
            <div id='next' class="time time1">
                <span id='time1_append2' style="    margin-right: -67px;"></span>
            </div>
            <!--</iframe>-->
        </div>
    </div>
</div>
<script src="/RequestDisPatcher/JS/birthday.js"></script>
<script src="/RequestDisPatcher/JS/radialIndicator.js"></script>
<script src="/RequestDisPatcher/JS/jquery.velocity.min.js"></script>

<!--<script src="/RequestDisPatcher/JS/mine.js"></script>-->
<script src="/RequestDisPatcher/JS/real.js"></script>
<script>
    /**
     *
     * 获取当前时间
     *
     用js请求当前时间的状态
     然后绘制图片
     append
     *
     *
     */
    function p(s) {
        return s < 10 ? '0' + s: s;
    }
    var myDate = new Date();
    //获取当前年
    var year=myDate.getFullYear();
    //获取当前月
    var month=myDate.getMonth()+1;
    //获取当前日
    var date=myDate.getDate();
    var h=myDate.getHours();       //获取当前小时数(0-23)
    var m=myDate.getMinutes();     //获取当前分钟数(0-59)
    var s=myDate.getSeconds();
    var now=p(h)+':'+p(m)+":"+p(s);
    $('.right_show').css("height",$(window).height());
    $('.left_nav').css("height",$(window).height());
</script>
</body>
</html>