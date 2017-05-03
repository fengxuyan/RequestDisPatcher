<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Healthy Consultation</title>

    <link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/layout.css">
    <link rel="stylesheet" type="text/css" href=" /RequestDisPatcher/ CSS/global.css">
    <link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/number-pb.css">

    <script src="  /RequestDisPatcher/JS/jquery-3.2.0.min.js"></script>
    <script src="  /RequestDisPatcher/JS/highcharts.js"></script>
    <script src="  /RequestDisPatcher/JS/birthday.js"></script>
    <script src="  /RequestDisPatcher/JS/radialIndicator.js"></script>
    <script src=" /RequestDisPatcher/ JS/jquery.velocity.min.js"></script>
    <script src="  /RequestDisPatcher/JS/number-pb.js"></script>
    <script src="  /RequestDisPatcher/JS/jquery.cookie.js"></script>
    <script src="  /RequestDisPatcher/JS/DateFormat.js"></script>
    <style>
        #chartdiv ,#chartdiv1,#chartdiv2,#chartdiv3{
            width: 590px;
            height: 290px;
            border: 2px solid #ddd;
            border-radius: 12px;
            padding: 6px;
            margin-left: -9px;
        }
    </style>
</head>
<script type="text/javascript">
    var userInfo = document.cookie.match(new RegExp("(^| )userData=([^;]*)(;|$)"));

    if(userInfo==null){
        window.location.href = "login.html";//location.href实现客户端页面的跳转
    };

    $(document).ready(function(){
        var userInfo = document.cookie.match(new RegExp("(^| )userData=([^;]*)(;|$)"));
        var info = JSON.parse(userInfo[2]);
        var Info=info['userInfo'];
        var first = Info.firstName;
        var middle = Info.middleName;
        var last = Info.lastName;
        var name;
        console.log(Info);
        if(middle==null||middle==""){
            name = first+" "+last;
        }else{
            name = first+" "+middle+" "+last;
        }
        $("#user_name").text(name);

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
    });
    function getQueryString(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return unescape(r[2]);
        return null;
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
</script>
<script>


var otheremail=getQueryString('email');
console.log(otheremail);

    function otherrealdata() {
        window.location.href='real.html?&email='+otheremail+'&sn='+getQueryString('sn');
    }


function searchKeys(needle, haystack)
{
    var result = [];
    for (i in haystack)
    {
        if (haystack[i] == needle)
        {
            result.push(i);
        }
    }
    return result;
}



</script>
<body>
<div class="holder rep " >
    <div class="left_nav">
        <div class="header_text">
            <div class="header_text_right">
                <span class="header_pic"><a href="modify.html" ><img src="Heads/default.jpg" id="head"></a></span>
            </div>
        </div>
        <ul  id="noemail">
            <a href="login.html"><li onclick="quit()"  >Logout</li></a>
            <a href="real.html"><li onclick="otherrealdata()">Real-time Data</li></a>
            <a href="healthy.html"><li class="on">Health Archives</li></a>
            <a href="addProduct.html"><li>Add device</li></a>
            <a href="deleteProduct.html"><li>Delete device</li></a>
        </ul>
        <ul  id="hasemail">
            <a href="login.html"><li onclick="quit()"  >Logout</li></a>
            <a><li  onclick="otherrealdata()">Real-time Data</li></a>
           <a><li class="on">Health Archives</li></a>
           <li></li>
           <li></li>
        </ul>
    </div>
    <div class="right_show analysis">
        <h4 class="titl">isleep</h4>
        <a href="homepage.html"><span class="home"></span></a>
        <div class="show_detail">
            <div class="show_detail_data">
                <div class="data_table search">
                    <!--<ul class="search_list reportslist">-->
                        <!--<li>One report</li>-->
                        <!--<li >Multiple reports</li>-->
                    <!--</ul>-->
                    <div class="reports" style="margin-top: -30px;">
                        <div class="reports_detail">
                            <h4 class="" style=" font-size: 23px;padding-top: 0px;">Data analysis </h4>

                        </div>
                        <div class="statistics_table">
                            <p>Heart rate</p>
                            <div class="statistics-table0">
                                <div id="chartdiv"></div>
                            </div>
                            <p>Respiration</p>
                            <div class="statistics-table1">
                                <div id="chartdiv1"></div>
                            </div>
                            <p>Deep Sleep amount</p>
                            <div class="statistics-table2">
                                <div id="chartdiv2"></div>
                            </div>
                            <p>Sleep quality curve</p>
                            <div class="statistics-table3">
                                <div id="chartdiv3"></div>
                            </div>
                        </div>
                        <input type="button" onclick="javascript:history.back(-1);" value="Back" class="submit_submit back">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".right_show").css("border-bottom",'1px solid #ddd');
    $(".right_show").css("padding-bottom",30);

</script>

<script type="text/javascript">
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


    var otheremail=getQueryString('email');
    console.log(otheremail);

    // Get the CSV and create the chart
    var startTime=$.cookie('startTime')
    var endTime=$.cookie('endTime')
    console.log(startTime);
    console.log(endTime);
    var userInfo = document.cookie.match(new RegExp("(^| )userData=([^;]*)(;|$)"));
    //console.log(userInfo);
    var info = JSON.parse(userInfo[2]);
    console.log(info);
    var Info = info['userInfo'];
    var token = info.token;



    var tes1=new Array();

    function arrAverageNum2(arr){
        var sum = eval(arr.join("+"));
        return ~~(sum/arr.length*100)/100;
    }
    function indexOf(arr, item) {
        var i = 0;
        for(; i<arr.length;i++)
        {
            if(arr[i]===item)
                return i;
        }
        return -1;
    }

    var remember_one_chooselists = document.cookie.match(new RegExp("(^| )remember_one_chooselists=([^;]*)(;|$)"));

    if(remember_one_chooselists!=null){
        var one_chooselists = remember_one_chooselists[2].split(',');
        var datestart = new Date(parseInt(one_chooselists[0]));
        var dateend = new Date(parseInt(one_chooselists[one_chooselists.length-2]));
        var date_fmtstart=datestart.format("MM/dd/yyyy");
        var date_fmtend=dateend.format("MM/dd/yyyy");
        var startTimetoarray=date_fmtstart.split('/');
        var endTimetoarray=date_fmtend.split('/');
        var times=one_chooselists.length-1;
    }





    var remember_other_chooselists = document.cookie.match(new RegExp("(^| )remember_other_chooselists=([^;]*)(;|$)"));
    console.log(remember_other_chooselists);
    if(remember_other_chooselists!=null){
        var other_chooselists = remember_other_chooselists[2].split(',');
        var datestartother = new Date(parseInt(other_chooselists[0]));
        var dateendother = new Date(parseInt(other_chooselists[other_chooselists.length-2]));
        var date_fmtstartother=datestartother.format("MM/dd/yyyy");
        var date_fmtendother=dateendother.format("MM/dd/yyyy");
        var startTimetoarrayOther=date_fmtstartother.split('/');
        var endTimetoarrayOther=date_fmtendother.split('/');
        var timesOther=other_chooselists.length-1;
    }




if(otheremail!=null){

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




    $.ajax({
        type:"post",
        dataType:"json",
        url:"  request/dispatcher.do",
        data: {
            url:"http://101.37.100.209:9002/device/getOtherData",
            params:"token="+token+"&startTime="+date_fmtstartother+"&endTime="+date_fmtendother+"&email="+otheremail
        },
        success: function (data) {
            var monthsInEng = ['Jan', 'Feb', 'Mar','Apr', 'May', 'June','July', 'Aug', 'Sept','Oct', 'Nov', 'Dec'];

            var index=startTimetoarrayOther[0];
            var dayindex=startTimetoarrayOther[1];

            var a=dateeng(dayindex);

            var index1=endTimetoarrayOther[0];
            var dayindex1=endTimetoarrayOther[1];

            var a1=dateeng(dayindex1);


            $('.reports_detail').append('<p>Report date：'+monthsInEng[index-1]+' '+a+'-'+monthsInEng[index1-1]+' ' +a1+'</p> <p>Total Times：'+timesOther+'<span><i>Maximum</i><i>Average</i><i>Minimum</i></span></p>');


            var map = new Array();//一维数组
            for (var i = 0; i < data.Data.length; i++) {
                for(var j=0;j<other_chooselists.length;j++){
                    if( data.Data[i].creatTime==other_chooselists[j]){
                        map.push(data.Data[i].avgHeart);//一维数组
                    };
                }
            }

            var hightest=Math.max.apply(null, map);//最大值
            var minest=Math.min.apply(null, map);//最小值
            var avg=Math.round(arrAverageNum2(map));
            var fields = {data:map,color:'#000',name:'Heart rate',width:2};

            var b=indexOf(map,hightest);//最大值出现的位置

            var d=indexOf(map,minest);//最小值出现的位置

            var num=map.length-1; // 线段数是 点数-1
            var width=(num-b)*(563/num);
            var x=b*(563/num);
            var y=hightest;
            var x_min=d*(563/num);
            var y_min=minest;



            var map1 = new Array();//一维数组
            var map1 = new Array();//一维数组
            var avgBreath_list = new Array(data.Data.length);
            var count_count1 = 0;
            for (var i = 0; i < data.Data.length; i++) {
                for(var j=0;j<one_chooselists.length;j++){
                    if( data.Data[i].creatTime==one_chooselists[j]){
                        if(count_count1==0){
                            avgBreath_list[count_count1] = data.Data[i].avgBreath;
                            map1.push(data.Data[i].avgBreath);//一维数组
                            count_count1++;
                        }else{
                            avgBreath_list[count_count1] = data.Data[i].avgBreath;
                            if(avgBreath_list[count_count1-1]==data.Data[i].avgBreath){
                                if(count_count1==1){
                                    map1.push(data.Data[i].avgBreath+0.3);//一维数组
                                    map1.push(data.Data[i].avgBreath);//一维数组
                                }else if(avgBreath_list[count_count1-2]>data.Data[i].avgBreath){
                                    map1.push(data.Data[i].avgBreath-0.3);//一维数组
                                    map1.push(data.Data[i].avgBreath);//一维数组
                                }else if(avgBreath_list[count_count1-2]<data.Data[i].avgBreath){
                                    map1.push(data.Data[i].avgBreath+0.3);//一维数组
                                    map1.push(data.Data[i].avgBreath);//一维数组
                                }
                            }else{
                                map1.push(data.Data[i].avgBreath);//一维数组
                            }
                            count_count1++;
                        }
                    };
                }
            }



            var hightest1=Math.max.apply(null, map1).toFixed(0);//最大值
            var minest1=Math.min.apply(null, map1).toFixed(0);//最小值
            var avg1=arrAverageNum2(map1).toFixed(0);
            var fields1 = {data:map1,color:'#000',name:'Respiration',width:2};


            var map2 = new Array();//一维数组
            for (var i = 0; i < data.Data.length; i++) {

                for(var j=0;j<other_chooselists.length;j++){
                    if( data.Data[i].creatTime==other_chooselists[j]){
                        map2.push(((data.Data[i].deepSleepTime)/(60*60)));//一维数组
                    };
                }





            }


            var hightest2=Math.max.apply(null, map2).toFixed(1);//最大值
            var minest2=Math.min.apply(null, map2).toFixed(1);//最小值
            var avg2=arrAverageNum2(map2).toFixed(1);
            var fields2 = {data:map2,color:'#000',name:'Deep Sleep amount',width:2};

            console.log(hightest2);


            var map3 = new Array();//一维数组
            for (var i = 0; i < data.Data.length; i++) {

                for(var j=0;j<other_chooselists.length;j++){
                    if( data.Data[i].creatTime==other_chooselists[j]){
                        map3.push(data.Data[i].score);//一维数组
                    };
                }
            }




            var hightest3=Math.max.apply(null, map3).toFixed(0);//最大值
            var minest3=Math.min.apply(null, map3).toFixed(0);//最小值
            var avg3=arrAverageNum2(map3).toFixed(0);
            var fields3 = {data:map3,color:'#000',name:'Sleep quality curve',width:2};


            var map4 = new Array();//一维数组
            for (var i = 0; i < data.Data.length; i++) {
                for(var j=0;j<other_chooselists.length;j++){
                    if( data.Data[i].creatTime==other_chooselists[j]){
                        map4.push((data.Data[i].lightSleepTime+data.Data[i].deepSleepTime)/(60*60));//一维数组
                    };
                }

            }


            var hightest4=Math.max.apply(null, map4).toFixed(0);//最大值
            var minest4=Math.min.apply(null, map4).toFixed(0);//最小值
            var avg4=arrAverageNum2(map4).toFixed(0);

            var fields4 = {data:map4,color:'#6d4e31',name:'Sleep time',width:2};


                var chart = new Highcharts.Chart('chartdiv', {
                    chart:{
                        type:'spline',
                        tooltip: {
                            enabled : false
                        },
                        marginRight: 50,
                        marginLeft: 40,
                    },
                    tooltip: {
                        enabled : false
                    },
                    title: {
                        text: 'Heart rate',
//                    text: 'Respiration',
                        x: -30,
                        y: 40
                    },
                    subtitle: {
                    },
                    xAxis: {
                        visible: false,
                        enabled: false,
                        gridLineWidth:'0px',
                        labels: {
                            enabled: false
                        }
                    },
                    yAxis: {
                        tickPixelInterval: 50,
                        gridLineWidth:'0px',
                        visible: false,
                        enabled: false,
                    },
                    plotLines:[
                        {
                            label:{
                                text:avg+'(Average Value)',
//                                text:'Average Value',  //标签的内容
                                align:'right',                //标签的水平位置，水平居左,默认是水平居中center
                                x:10                         //标签相对于被定位的位置水平偏移的像素，重新定位，水平居左10px
                            },
                            color:'#ddd',
                            dashStyle:'Dot',
                            value:avg,
                            width:2
                        }
                    ],
                    legend: {
                        itemStyle: {

                            color: '#000000',
                            fontWeight: 'bold'
                        },
                        enabled: false,
                        layout: 'vertical',
                        backgroundColor: '#fff',
                        floating: true,
//                    align: 'right',
                        verticalAlign: 'top',
                        x: 170,
                        y: 45,
//                    labelFormat: '<span style="color:#a37c59">{name}</span>'
                    },
                    plotOptions: {
                        series: {
                            lineWidth: 1,
                            marker: {
                                enabled: false
                            }
                        }
                    },
                    series:
                            [
                                fields
                            ]
                    ,

                    credits:{
                        enabled:false // 禁用版权信息
                    }
                }, function (chart) {
                    chart.yAxis[0].addPlotLine({           //在x轴上增加
                        value:hightest,                           //在值为2的地方
                        width:1,                           //标示线的宽度为2px
                        dashStyle:'Dot',
                        color: '#000',                  //标示线的颜色
                        id: 'plot-line-1', //标示线的id，在删除该标示线的时候需要该id标示
                        zIndex:3,               //标示线的id，在删除该标示线的时候需要该id标示
                    })
                    ;

                    chart.renderer.image('images/healthy_reports_highest.png',535, (Math.round(hightest)), 15, 15).add().

                    renderer.text(Math.round(hightest), 555, (Math.round(hightest))+15).attr({}).
                    css({
                        fontSize: '23px',
                        color: '#000',
                        fontFamily:'华文细黑',
                    }).add().
                    renderer.text('bpm', 555,(Math.round(hightest))+30).attr({
                    }).
                    css({
                        fontSize: '13px',
                        color: '#000',
                        fontFamily:'华文细黑',
                    }).add();

                    chart.yAxis[0].addPlotLine({           //在x轴上增加
                        value:minest,                           //在值为2的地方
                        width:1,                           //标示线的宽度为2px
                        dashStyle:'Dot',
                        color: '#000',                  //标示线的颜色
                        id: 'plot-line-1', //标示线的id，在删除该标示线的时候需要该id标示
                        zIndex:3,               //标示线的id，在删除该标示线的时候需要该id标示
                    });
                    chart.renderer.image('images/healthy_reports_lowest.png', 535, Math.round(minest)+180, 15, 15).add().

                    renderer.text(Math.round(minest), 555, Math.round(minest)+195).attr({}).
                    css({
                        fontSize: '23px',
                        color: '#000',
                        fontFamily:'华文细黑',
                    }).add().
                    renderer.text('bpm', 555, Math.round(minest)+210).attr({
                    }).
                    css({
                        fontSize: '13px',
                        color: '#000',
                        fontFamily:'华文细黑',
                    }).add();


                    chart.yAxis[0].addPlotLine({           //在x轴上增加
                        value:avg,                           //在值为2的地方
                        width:1,                           //标示线的宽度为2px
                        dashStyle:'Dot',
                        color: '#000',                  //标示线的颜色
                        id: 'plot-line-1', //标示线的id，在删除该标示线的时候需要该id标示
                        zIndex:3,
                    });

                    chart.renderer.image('images/healthy_reports_average.png', 535, ((Math.round(minest)+180)+hightest)/2, 15, 15).add().

                    renderer.text(Math.round(avg), 555, ((Math.round(minest)+180)+hightest)/2+15).attr({}).
                    css({
                        fontSize: '23px',
                        color: '#000',
                        fontFamily:'华文细黑',
                    }).add().
                    renderer.text('bpm', 555, ((Math.round(minest)+180)+hightest)/2+20+10).attr({
                    }).
                    css({
                        fontSize: '13px',
                        color: '#000',
                        fontFamily:'华文细黑',
                    }).add();

                });


                var chart = new Highcharts.Chart('chartdiv1', {
                    chart:{
                        type:'spline',
                        tooltip: {
                            enabled : false
                        },
                        marginRight: 50,
                        marginLeft: 40,
                    },
                    tooltip: {
                        enabled : false
                    },
                    title: {
                        text: 'Respiration',
                        x: -30,
                        y: 40
                    },
                    subtitle: {
                    },

                    xAxis: {
                        visible: false,
                        enabled: false,
                        gridLineWidth:'0px',
                        labels: {
                            enabled: false
                        }
                    },
                    yAxis: {
                        visible: false,
                        enabled: false,
                    },
                    legend: {
                        itemStyle: {

                            color: '#000000',
                            fontWeight: 'bold'
                        },
                        enabled: false,
                        layout: 'vertical',
                        backgroundColor: '#fff',
                        floating: true,
//                    align: 'right',
                        verticalAlign: 'top',
                        x: 170,
                        y: 45,
//                    labelFormat: '<span style="color:#a37c59">{name}</span>'
                    },
                    plotOptions: {
                        series: {
                            lineWidth: 1
                        }
                    },
                    series:
                            [
                                fields1
                            ]
                    ,
                    plotOptions: {
                        series: {
                            lineWidth: 1,
                            marker: {
                                enabled: false
                            }
                        }
                    },
                    credits:{
                        enabled:false // 禁用版权信息
                    }
                }, function (chart) {
                    chart.yAxis[0].addPlotLine({           //在x轴上增加
                        value:hightest1,                           //在值为2的地方
                        width:1,                           //标示线的宽度为2px
                        dashStyle:'Dot',
                        color: '#000',                  //标示线的颜色
                        id: 'plot-line-1', //标示线的id，在删除该标示线的时候需要该id标示
                        zIndex:3,               //标示线的id，在删除该标示线的时候需要该id标示
                    });


//                var hightest1=Math.max.apply(null, map1).toFixed(0);//最大值
//                var minest1=Math.min.apply(null, map1).toFixed(0);//最小值
//                var avg1=arrAverageNum2(map1).toFixed(0);
//
                    console.log(Math.round(hightest1)+50);

                    chart.renderer.image('images/healthy_reports_highest.png', 535, Math.round(hightest1)+60, 15, 15).add().

                    renderer.text(Math.round(hightest1), 555,Math.round(hightest1)+75).attr({}).
                    css({
                        fontSize: '23px',
                        color: '#000',
                        fontFamily:'华文细黑',
                    }).add().
                    renderer.text('bpm',555, Math.round(hightest1)+90).attr({
                    }).
                    css({
                        fontSize: '13px',
                        color: '#000',
                        fontFamily:'华文细黑',
                    }).add();

                    chart.yAxis[0].addPlotLine({           //在x轴上增加
                        value:minest1,                           //在值为2的地方
                        width:1,                           //标示线的宽度为2px
                        dashStyle:'Dot',
                        color: '#000',                  //标示线的颜色
                        id: 'plot-line-1', //标示线的id，在删除该标示线的时候需要该id标示
                        zIndex:3,               //标示线的id，在删除该标示线的时候需要该id标示
                    });

                    chart.renderer.image('images/healthy_reports_lowest.png', 535, Math.round(minest1)+210, 15, 15).add().

                    renderer.text(Math.round(minest1), 555,Math.round(minest1)+225).attr({}).
                    css({
                        fontSize: '23px',
                        color: '#000',
                        fontFamily:'华文细黑',
                    }).add().
                    renderer.text('bpm', 555, Math.round(minest1)+240).attr({
                    }).
                    css({
                        fontSize: '13px',
                        color: '#000',
                        fontFamily:'华文细黑',
                    }).add();



                    chart.yAxis[0].addPlotLine({           //在x轴上增加
                        value:avg1,                           //在值为2的地方
                        width:1,                           //标示线的宽度为2px
                        dashStyle:'Dot',
                        color: '#000',                  //标示线的颜色
                        id: 'plot-line-1', //标示线的id，在删除该标示线的时候需要该id标示
                        zIndex:3,
                    });

                    chart.renderer.image('images/healthy_reports_average.png', 535,((Math.round(minest1)+210)+(Math.round(hightest1)+60))/2, 15, 15).add().
                    renderer.text(Math.round(avg1), 555, ((Math.round(minest1)+210)+(Math.round(hightest1)+60))/2+15).attr({}).
                    css({
                        fontSize: '23px',
                        color: '#000',
                        fontFamily:'华文细黑',
                    }).add().
                    renderer.text('bpm', 555, ((Math.round(minest1)+210)+(Math.round(hightest1)+60))/2+30).attr({
                    }).
                    css({
                        fontSize: '13px',
                        color: '#000',
                        fontFamily:'华文细黑',
                    }).add();
                });

            var chart = new Highcharts.Chart('chartdiv2', {
                chart:{
                    type:'spline',
                    tooltip: {
                        enabled : false
                    },
                    marginRight: 50,
                    marginLeft: 80,
                },
                tooltip: {
                    enabled : false
                },
                title: {
                    text: 'Deep Sleep amount',
                    x: -30,
                    y: 40
                },
                subtitle: {
                },
                xAxis: {
                    visible: false,
                    enabled: false,
                    labels: {
                        enabled: false
                    }
                },

                yAxis: {
//                    visible: false,
//                    enabled: false,
                    labels: {
                        style: {
                            dashStyle:'Dot',     //
                            fontSize:'15px',
                            fontFamily:'华文细黑,STHeiti,MingLiu'
                        },
                        formatter:function(){
                            return ""+this.value+"h";
                        }
                    },

                    gridLineWidth:'0px',
                    title: {
                        text: ''
                    },
                },
                legend: {
                    layout: 'vertical',
                    backgroundColor: '#fff',
                    floating: true,
                    align: 'right',
                    verticalAlign: 'top',
                    x: 10,
                    y: 15,
                    itemStyle: {
                        color: '#000000',
                        fontWeight: 'bold',

                    }
//                    labelFormat: '<span style="color:#a37c59">{name}</span>'
                },
                plotOptions: {
                    series: {
                        lineWidth: 1
                    }
                },
                plotOptions: {
                    series: {
                        lineWidth: 1,
                        marker: {
                            enabled: false
                        }
                    }
                },
                series:
                        [
                            fields2,fields4
                        ]
                ,
                credits:{
                    enabled:false // 禁用版权信息
                }
            }, function (chart) {
                chart.yAxis[0].addPlotLine({           //在x轴上增加
                    value:hightest2,                           //在值为2的地方
                    width:1,                           //标示线的宽度为2px
                    dashStyle:'Dot',
                    color: '#000',                  //标示线的颜色
                    id: 'plot-line-1', //标示线的id，在删除该标示线的时候需要该id标示
                    zIndex:3,               //标示线的id，在删除该标示线的时候需要该id标示
                });
                chart.renderer.image('images/smile.png', 0,120 , 25, 25).add().renderer.image('images/ok.png', 0, 180, 25, 25).add().renderer.image('images/bad.png', 0, 240, 25, 25).add();

                console.log(Math.round(hightest2));
                chart.renderer.image('images/healthy_reports_highest.png', 535, Math.round(hightest2)+190, 15, 15).add().
                renderer.text(hightest2+'h', 555, Math.round(hightest2)+200).attr({}).
                css({
                    fontSize: '16px',
                    color: '#000',
                    fontFamily:'华文细黑',
                }).add().
                renderer.text('', 555, Math.round(hightest2)+220+17).attr({
                }).
                css({
                    fontSize: '13px',
                    color: '#000',
                    fontFamily:'华文细黑',
                }).add();

                chart.yAxis[0].addPlotLine({           //在x轴上增加
                    value:minest2,                           //在值为2的地方
                    width:1,                           //标示线的宽度为2px
                    dashStyle:'Dot',
                    color: '#000',                  //标示线的颜色
                    id: 'plot-line-1', //标示线的id，在删除该标示线的时候需要该id标示
                    zIndex:3,               //标示线的id，在删除该标示线的时候需要该id标示
                });
                chart.renderer.image('images/healthy_reports_lowest.png', 535, Math.round(minest2)+230, 15, 15).add().

                renderer.text(minest2+'h', 555, Math.round(minest2)+240).attr({}).
                css({
                    fontSize: '16px',
                    color: '#000',
                    fontFamily:'华文细黑',
                }).add().
                renderer.text('', 555,Math.round(minest2)+220+15).attr({
                }).
                css({
                    fontSize: '13px',
                    color: '#000',
                    fontFamily:'华文细黑',
                }).add();


                chart.yAxis[0].addPlotLine({           //在x轴上增加
                    value:avg2,                           //在值为2的地方
                    width:1,                           //标示线的宽度为2px
                    dashStyle:'Dot',
                    color: '#000',                  //标示线的颜色
                    id: 'plot-line-1', //标示线的id，在删除该标示线的时候需要该id标示
                    zIndex:3,
                });

                chart.renderer.image('images/healthy_reports_average.png', 535,((Math.round(minest2)+230)+Math.round(hightest2)+190)/2, 15, 15).add().

                renderer.text(avg2+'h', 555, ((Math.round(minest2)+230)+Math.round(hightest2)+190)/2+10).attr({}).
                css({
                    fontSize: '16px',
                    color: '#000',
                    fontFamily:'华文细黑',
                }).add().
                renderer.text('', 555, ((Math.round(minest2)+250)+Math.round(hightest2)+200)/2+15).attr({
                }).
                css({
                    fontSize: '13px',
                    color: '#000',
                    fontFamily:'华文细黑',
                }).add();
                chart.renderer.path(['M', 75, 0, 'L', 75, 300])
                        .attr({
                            'stroke-width': 2,
                            stroke: 'black',
                            dashstyle: 'Dot'
                        }).add()
            });






            var chart = new Highcharts.Chart('chartdiv3', {
                chart:{
                    type:'spline',
                    tooltip: {
                        enabled : false
                    },
                    marginRight: 50,
                    marginLeft: 40,
                },
                tooltip: {
                    enabled : false
                },
                title: {
                    text: 'Sleep quality curve',
                    x: -30,
                    y: 40
                },
                subtitle: {
                },
                xAxis: {
                    visible: false,
                    enabled: false,
                    labels: {
                        enabled: false
                    }
                },
                yAxis: {
                    visible: false,
                    enabled: false,
                    style: {
                        dashStyle:'Dot',     //
                        fontSize:'15px',
                        fontFamily:'华文细黑,STHeiti,MingLiu'
                    },
                    gridLineWidth:'0px',
                    title: {
                        text: ''
                    },
                    plotLines:[
                        {
                            label:{
                                text:hightest3+'(Maximum Value)',    //标签的内容
                                align:'right',                //标签的水平位置，水平居左,默认是水平居中center
                                x:10                         //标签相对于被定位的位置水平偏移的像素，重新定位，水平居左10px
                            },
                            zIndex:26,
                            color:'#ddd',           //线的颜色，定义为红色
                            dashStyle:'Dot',     //默认值，这里定义为实线
                            value:hightest3,         //定义在那个值上显示标示线，这里是在x轴上刻度为3的值处垂直化一条线
                            width:2                //标示线的宽度，2px
                        },
                        {
                            label:{
                                text:minest3+'(Minimum Value)',   //标签的内容
                                align:'right',                //标签的水平位置，水平居左,默认是水平居中center
                                x:10                         //标签相对于被定位的位置水平偏移的像素，重新定位，水平居左10px
                            },
                            color:'#ddd',
                            dashStyle:'Dot',
                            value:minest3,
                            width:2,
                            zIndex:23
                        },
                        {

                            label:{
                                text:avg3+'(Average Value)',  //标签的内容
                                align:'right',                //标签的水平位置，水平居左,默认是水平居中center
                                x:10                         //标签相对于被定位的位置水平偏移的像素，重新定位，水平居左10px
                            },

                            color:'#ddd',
                            dashStyle:'Dot',
                            value:avg3,
                            width:2
                        }
                    ]
                },

                legend: {
                    enabled: false,
                    layout: 'vertical',
                    backgroundColor: '#fff',
                    floating: true,
                    align: 'left',
                    verticalAlign: 'top',
                    x: 30,
                    y: 45,
//                    labelFormat: '<span style="color:#a37c59">{name}</span>'
                },
                plotOptions: {
                    series: {
                        lineWidth: 1,
                        marker: {
                            enabled: false
                        }
                    }
                },
                series:
                        [
                            fields3
                        ]
                ,
                credits:{
                    enabled:false // 禁用版权信息
                }
            }, function (chart) {
                chart.yAxis[0].addPlotLine({           //在x轴上增加
                    value:hightest3,                           //在值为2的地方
                    width:1,                           //标示线的宽度为2px
                    dashStyle:'Dot',
                    color: '#000',                  //标示线的颜色
                    id: 'plot-line-1', //标示线的id，在删除该标示线的时候需要该id标示
                    zIndex:3,               //标示线的id，在删除该标示线的时候需要该id标示
                });

                chart.renderer.image('images/healthy_reports_highest.png', 535, Math.round(hightest3), 15, 15).add().

                renderer.text(Math.round(hightest3), 550, Math.round(hightest3)+15).attr({}).
                css({
                    fontSize: '23px',
                    color: '#000',
                    fontFamily:'华文细黑',
                }).add().
                renderer.text('', 555, Math.round(hightest3)).attr({
                }).
                css({
                    fontSize: '13px',
                    color: '#000',
                    fontFamily:'华文细黑',
                }).add();

                chart.yAxis[0].addPlotLine({           //在x轴上增加
                    value:minest3,                           //在值为2的地方
                    width:1,                           //标示线的宽度为2px
                    dashStyle:'Dot',
                    color: '#000',                  //标示线的颜色
                    id: 'plot-line-1', //标示线的id，在删除该标示线的时候需要该id标示
                    zIndex:3,               //标示线的id，在删除该标示线的时候需要该id标示
                });
                chart.renderer.image('images/healthy_reports_lowest.png', 535, Math.round(minest3)+160, 15, 15).add().

                renderer.text(Math.round(minest3), 545, Math.round(minest3)+175).attr({}).
                css({
                    fontSize: '23px',
                    color: '#000',
                    fontFamily:'华文细黑',
                }).add().
                renderer.text('', 555, Math.round(minest3)+190).attr({
                }).
                css({
                    fontSize: '13px',
                    color: '#000',
                    fontFamily:'华文细黑',
                }).add();




                chart.yAxis[0].addPlotLine({           //在x轴上增加
                    value:avg3,                           //在值为2的地方
                    width:1,                           //标示线的宽度为2px
                    dashStyle:'Dot',
                    color: '#000',                  //标示线的颜色
                    id: 'plot-line-1', //标示线的id，在删除该标示线的时候需要该id标示
                    zIndex:3,
                });

                chart.renderer.image('images/healthy_reports_average.png', 535,(Math.round(minest3)+170+(Math.round(hightest3)-20))/2 , 15, 15).add().

                renderer.text(Math.round(avg3), 555, (Math.round(minest3)+170+(Math.round(hightest3)-20))/2+15).attr({}).
                css({
                    fontSize: '23px',
                    color: '#000',
                    fontFamily:'华文细黑',
                }).add().
                renderer.text('', 555, ((260-y_min)+(Math.round(hightest3)))/2+30).attr({
                }).
                css({
                    fontSize: '13px',
                    color: '#000',
                    fontFamily:'华文细黑',
                }).add();

            });








        },
        error: function (data) {
            console.log(data);
        }
    });

}else{


    $('#noemail').show();
    $('#hasemail').hide();





    $.ajax({
        type:"post",
        dataType:"json",
        url:"  request/dispatcher.do",
        data: {
            url:"http://101.37.100.209:9002/device/getData",
            params:"token="+token+"&startTime="+date_fmtstart+"&endTime="+date_fmtend
        },
        success: function (data) {

            var monthsInEng = ['Jan', 'Feb', 'Mar','Apr', 'May', 'June','July', 'Aug', 'Sept','Oct', 'Nov', 'Dec'];
            var index=startTimetoarray[0];
            var dayindex=startTimetoarray[1];
            var a=dateeng(dayindex);

            var index1=endTimetoarray[0];
            var dayindex1=endTimetoarray[1];
            var a1=dateeng(dayindex1);

console.log(index);

            $('.reports_detail').append('<p>Report date：'+monthsInEng[index-1]+' '+a+'-'+monthsInEng[index1-1]+' ' +a1+'</p> <p>Total Times：'+times+'<span><i>Maximum</i><i>Average</i><i>Minimum</i></span></p>');



            var map = new Array();//一维数组
            for (var i = 0; i < data.Data.length; i++) {
                for(var j=0;j<one_chooselists.length;j++){
                if( data.Data[i].creatTime==one_chooselists[j]){
                    map.push(data.Data[i].avgHeart);//一维数组
                };
                }
            }


            var hightest=Math.max.apply(null, map);//最大值
            var minest=Math.min.apply(null, map);//最小值
            var avg=Math.round(arrAverageNum2(map));
            var fields = {data:map,color:'#000',name:'Heart rate',width:2};

            var b=indexOf(map,hightest);//最大值出现的位置

            var d=indexOf(map,minest);//最小值出现的位置

            var num=map.length-1; // 线段数是 点数-1
            var width=(num-b)*(563/num);
            var x=b*(563/num);
            var y=hightest;
            var x_min=d*(563/num);
            var y_min=minest;



            var map1 = new Array();//一维数组
            var map1 = new Array();//一维数组
            var avgBreath_list = new Array(data.Data.length);
            var count_count1 = 0;
            for (var i = 0; i < data.Data.length; i++) {
                for(var j=0;j<one_chooselists.length;j++){
                    if( data.Data[i].creatTime==one_chooselists[j]){
                        if(count_count1==0){
                            avgBreath_list[count_count1] = data.Data[i].avgBreath;
                            map1.push(data.Data[i].avgBreath);//一维数组
                            count_count1++;
                        }else{
                            avgBreath_list[count_count1] = data.Data[i].avgBreath;
                            if(avgBreath_list[count_count1-1]==data.Data[i].avgBreath){
                                if(count_count1==1){
                                    map1.push(data.Data[i].avgBreath+0.3);//一维数组
                                    map1.push(data.Data[i].avgBreath);//一维数组
                                }else if(avgBreath_list[count_count1-2]>data.Data[i].avgBreath){
                                    map1.push(data.Data[i].avgBreath-0.3);//一维数组
                                    map1.push(data.Data[i].avgBreath);//一维数组
                                }else if(avgBreath_list[count_count1-2]<data.Data[i].avgBreath){
                                    map1.push(data.Data[i].avgBreath+0.3);//一维数组
                                    map1.push(data.Data[i].avgBreath);//一维数组
                                }
                            }else{
                                map1.push(data.Data[i].avgBreath);//一维数组
                            }
                            count_count1++;
                        }
                    };
                }
            }
            var hightest1=Math.max.apply(null, map1).toFixed(0);//最大值
            var minest1=Math.min.apply(null, map1).toFixed(0);//最小值
            var avg1=arrAverageNum2(map1).toFixed(0);
            var fields1 = {data:map1,color:'#000',name:'Respiration',width:2};

            var map2 = new Array();//一维数组
            for (var i = 0; i < data.Data.length; i++) {
                for(var j=0;j<one_chooselists.length;j++){
                    if( data.Data[i].creatTime==one_chooselists[j]){
                        map2.push(((data.Data[i].deepSleepTime)/(60*60)));//一维数组
                    };
                }


            }
            var hightest2=Math.max.apply(null, map2).toFixed(1);//最大值
            var minest2=Math.min.apply(null, map2).toFixed(1);//最小值
            var avg2=arrAverageNum2(map2).toFixed(1);
            var fields2 = {data:map2,color:'#000',name:'Deep Sleep amount',width:2};


            var map3 = new Array();//一维数组
            for (var i = 0; i < data.Data.length; i++) {


                for(var j=0;j<one_chooselists.length;j++){
                    if( data.Data[i].creatTime==one_chooselists[j]){
                        map3.push(data.Data[i].score);//一维数组
                    };
                }
            }
            var hightest3=Math.max.apply(null, map3).toFixed(0);//最大值
            var minest3=Math.min.apply(null, map3).toFixed(0);//最小值
            var avg3=arrAverageNum2(map3).toFixed(0);
            var fields3 = {data:map3,color:'#000',name:'Sleep quality curve',width:2};


            var map4 = new Array();//一维数组
            for (var i = 0; i < data.Data.length; i++) {

                for(var j=0;j<one_chooselists.length;j++){
                    if( data.Data[i].creatTime==one_chooselists[j]){
                        map4.push((data.Data[i].lightSleepTime+data.Data[i].deepSleepTime)/(60*60));//一维数组
                    };
                }

            }
            var hightest4=Math.max.apply(null, map4).toFixed(0);//最大值
            var minest4=Math.min.apply(null, map4).toFixed(0);//最小值
            var avg4=arrAverageNum2(map4).toFixed(0);

            var fields4 = {data:map4,color:'#6d4e31',name:'Sleep time',width:2};



            var chart = new Highcharts.Chart('chartdiv', {
                chart:{
                    type:'spline',
                    tooltip: {
                        enabled : false
                    },
                    marginRight: 50,
                    marginLeft: 40,
                },
                tooltip: {
                    enabled : false
                },
                title: {
                    text: 'Heart rate',
//                    text: 'Respiration',
                    x: -30,
                    y: 40
                },
                subtitle: {
                },
                xAxis: {
                    visible: false,
                    enabled: false,
                    gridLineWidth:'0px',
                    labels: {
                        enabled: false
                    }
                },
                yAxis: {
                    tickPixelInterval: 50,
                    gridLineWidth:'0px',
                    visible: false,
                    enabled: false,
                },
                plotLines:[
                    {
                        label:{
                            text:avg+'(Average Value)',
//                                text:'Average Value',  //标签的内容
                            align:'right',                //标签的水平位置，水平居左,默认是水平居中center
                            x:10                         //标签相对于被定位的位置水平偏移的像素，重新定位，水平居左10px
                        },
                        color:'#ddd',
                        dashStyle:'Dot',
                        value:avg,
                        width:2
                    }
                ],
                legend: {
                    itemStyle: {

                        color: '#000000',
                        fontWeight: 'bold'
                    },
                    enabled: false,
                    layout: 'vertical',
                    backgroundColor: '#fff',
                    floating: true,
//                    align: 'right',
                    verticalAlign: 'top',
                    x: 170,
                    y: 45,
//                    labelFormat: '<span style="color:#a37c59">{name}</span>'
                },
                plotOptions: {
                    series: {
                        lineWidth: 1,
                        marker: {
                            enabled: false
                        }
                    }
                },
                series:
                        [
                            fields
                        ]
                ,

                credits:{
                    enabled:false // 禁用版权信息
                }
            }, function (chart) {
                chart.yAxis[0].addPlotLine({           //在x轴上增加
                    value:hightest,                           //在值为2的地方
                    width:1,                           //标示线的宽度为2px
                    dashStyle:'Dot',
                    color: '#000',                  //标示线的颜色
                    id: 'plot-line-1', //标示线的id，在删除该标示线的时候需要该id标示
                    zIndex:3,               //标示线的id，在删除该标示线的时候需要该id标示
                })
                ;

                chart.renderer.image('images/healthy_reports_highest.png',535, (Math.round(hightest)), 15, 15).add().

                renderer.text(Math.round(hightest), 555, (Math.round(hightest))+15).attr({}).
                css({
                    fontSize: '23px',
                    color: '#000',
                    fontFamily:'华文细黑',
                }).add().
                renderer.text('bpm', 555,(Math.round(hightest))+30).attr({
                }).
                css({
                    fontSize: '13px',
                    color: '#000',
                    fontFamily:'华文细黑',
                }).add();

                chart.yAxis[0].addPlotLine({           //在x轴上增加
                    value:minest,                           //在值为2的地方
                    width:1,                           //标示线的宽度为2px
                    dashStyle:'Dot',
                    color: '#000',                  //标示线的颜色
                    id: 'plot-line-1', //标示线的id，在删除该标示线的时候需要该id标示
                    zIndex:3,               //标示线的id，在删除该标示线的时候需要该id标示
                });
                chart.renderer.image('images/healthy_reports_lowest.png', 535, Math.round(minest)+180, 15, 15).add().

                renderer.text(Math.round(minest), 555, Math.round(minest)+195).attr({}).
                css({
                    fontSize: '23px',
                    color: '#000',
                    fontFamily:'华文细黑',
                }).add().
                renderer.text('bpm', 555, Math.round(minest)+210).attr({
                }).
                css({
                    fontSize: '13px',
                    color: '#000',
                    fontFamily:'华文细黑',
                }).add();


                chart.yAxis[0].addPlotLine({           //在x轴上增加
                    value:avg,                           //在值为2的地方
                    width:1,                           //标示线的宽度为2px
                    dashStyle:'Dot',
                    color: '#000',                  //标示线的颜色
                    id: 'plot-line-1', //标示线的id，在删除该标示线的时候需要该id标示
                    zIndex:3,
                });

                chart.renderer.image('images/healthy_reports_average.png', 535, ((Math.round(minest)+180)+hightest)/2, 15, 15).add().

                renderer.text(Math.round(avg), 555, ((Math.round(minest)+180)+hightest)/2+15).attr({}).
                css({
                    fontSize: '23px',
                    color: '#000',
                    fontFamily:'华文细黑',
                }).add().
                renderer.text('bpm', 555, ((Math.round(minest)+180)+hightest)/2+20+10).attr({
                }).
                css({
                    fontSize: '13px',
                    color: '#000',
                    fontFamily:'华文细黑',
                }).add();

            });


            var chart = new Highcharts.Chart('chartdiv1', {
                chart:{
                    type:'spline',
                    tooltip: {
                        enabled : false
                    },
                    marginRight: 50,
                    marginLeft: 40,
                },
                tooltip: {
                    enabled : false
                },
                title: {
                    text: 'Respiration',
                    x: -30,
                    y: 40
                },
                subtitle: {
                },

                xAxis: {
                    visible: false,
                    enabled: false,
                    gridLineWidth:'0px',
                    labels: {
                        enabled: false
                    }
                },
                yAxis: {
                    visible: false,
                    enabled: false,
                },
                legend: {
                    itemStyle: {

                        color: '#000000',
                        fontWeight: 'bold'
                    },
                    enabled: false,
                    layout: 'vertical',
                    backgroundColor: '#fff',
                    floating: true,
//                    align: 'right',
                    verticalAlign: 'top',
                    x: 170,
                    y: 45,
//                    labelFormat: '<span style="color:#a37c59">{name}</span>'
                },
                plotOptions: {
                    series: {
                        lineWidth: 1
                    }
                },
                series:
                        [
                            fields1
                        ]
                ,
                plotOptions: {
                    series: {
                        lineWidth: 1,
                        marker: {
                            enabled: false
                        }
                    }
                },
                credits:{
                    enabled:false // 禁用版权信息
                }
            }, function (chart) {
                chart.yAxis[0].addPlotLine({           //在x轴上增加
                    value:hightest1,                           //在值为2的地方
                    width:1,                           //标示线的宽度为2px
                    dashStyle:'Dot',
                    color: '#000',                  //标示线的颜色
                    id: 'plot-line-1', //标示线的id，在删除该标示线的时候需要该id标示
                    zIndex:3,               //标示线的id，在删除该标示线的时候需要该id标示
                });


//                var hightest1=Math.max.apply(null, map1).toFixed(0);//最大值
//                var minest1=Math.min.apply(null, map1).toFixed(0);//最小值
//                var avg1=arrAverageNum2(map1).toFixed(0);
//
                console.log(Math.round(hightest1)+50);

                chart.renderer.image('images/healthy_reports_highest.png', 535, Math.round(hightest1)+60, 15, 15).add().

                renderer.text(Math.round(hightest1), 555,Math.round(hightest1)+75).attr({}).
                css({
                    fontSize: '23px',
                    color: '#000',
                    fontFamily:'华文细黑',
                }).add().
                renderer.text('bpm',555, Math.round(hightest1)+90).attr({
                }).
                css({
                    fontSize: '13px',
                    color: '#000',
                    fontFamily:'华文细黑',
                }).add();

                chart.yAxis[0].addPlotLine({           //在x轴上增加
                    value:minest1,                           //在值为2的地方
                    width:1,                           //标示线的宽度为2px
                    dashStyle:'Dot',
                    color: '#000',                  //标示线的颜色
                    id: 'plot-line-1', //标示线的id，在删除该标示线的时候需要该id标示
                    zIndex:3,               //标示线的id，在删除该标示线的时候需要该id标示
                });

                chart.renderer.image('images/healthy_reports_lowest.png', 535, Math.round(minest1)+210, 15, 15).add().

                renderer.text(Math.round(minest1), 555,Math.round(minest1)+225).attr({}).
                css({
                    fontSize: '23px',
                    color: '#000',
                    fontFamily:'华文细黑',
                }).add().
                renderer.text('bpm', 555, Math.round(minest1)+240).attr({
                }).
                css({
                    fontSize: '13px',
                    color: '#000',
                    fontFamily:'华文细黑',
                }).add();



                chart.yAxis[0].addPlotLine({           //在x轴上增加
                    value:avg1,                           //在值为2的地方
                    width:1,                           //标示线的宽度为2px
                    dashStyle:'Dot',
                    color: '#000',                  //标示线的颜色
                    id: 'plot-line-1', //标示线的id，在删除该标示线的时候需要该id标示
                    zIndex:3,
                });

                chart.renderer.image('images/healthy_reports_average.png', 535,((Math.round(minest1)+210)+(Math.round(hightest1)+60))/2, 15, 15).add().
                renderer.text(Math.round(avg1), 555, ((Math.round(minest1)+210)+(Math.round(hightest1)+60))/2+15).attr({}).
                css({
                    fontSize: '23px',
                    color: '#000',
                    fontFamily:'华文细黑',
                }).add().
                renderer.text('bpm', 555, ((Math.round(minest1)+210)+(Math.round(hightest1)+60))/2+30).attr({
                }).
                css({
                    fontSize: '13px',
                    color: '#000',
                    fontFamily:'华文细黑',
                }).add();
            });

            var chart = new Highcharts.Chart('chartdiv2', {
                chart:{
                    type:'spline',
                    tooltip: {
                        enabled : false
                    },
                    marginRight: 50,
                    marginLeft: 80,
                },
                tooltip: {
                    enabled : false
                },
                title: {
                    text: 'Deep Sleep amount',
                    x: -30,
                    y: 40
                },
                subtitle: {
                },
                xAxis: {
                    visible: false,
                    enabled: false,
                    labels: {
                        enabled: false
                    }
                },

                yAxis: {
//                    visible: false,
//                    enabled: false,
                    labels: {
                        style: {
                            dashStyle:'Dot',     //
                            fontSize:'15px',
                            fontFamily:'华文细黑,STHeiti,MingLiu'
                        },
                        formatter:function(){
                            return ""+this.value+"h";
                        }
                    },

                    gridLineWidth:'0px',
                    title: {
                        text: ''
                    },
                },
                legend: {
                    layout: 'vertical',
                    backgroundColor: '#fff',
                    floating: true,
                    align: 'right',
                    verticalAlign: 'top',
                    x: 10,
                    y: 15,
                    itemStyle: {
                        color: '#000000',
                        fontWeight: 'bold',

                    }
//                    labelFormat: '<span style="color:#a37c59">{name}</span>'
                },
                plotOptions: {
                    series: {
                        lineWidth: 1
                    }
                },
                plotOptions: {
                    series: {
                        lineWidth: 1,
                        marker: {
                            enabled: false
                        }
                    }
                },
                series:
                        [
                            fields2,fields4
                        ]
                ,
                credits:{
                    enabled:false // 禁用版权信息
                }
            }, function (chart) {
                chart.yAxis[0].addPlotLine({           //在x轴上增加
                    value:hightest2,                           //在值为2的地方
                    width:1,                           //标示线的宽度为2px
                    dashStyle:'Dot',
                    color: '#000',                  //标示线的颜色
                    id: 'plot-line-1', //标示线的id，在删除该标示线的时候需要该id标示
                    zIndex:3,               //标示线的id，在删除该标示线的时候需要该id标示
                });
                chart.renderer.image('images/smile.png', 0,120 , 25, 25).add().renderer.image('images/ok.png', 0, 180, 25, 25).add().renderer.image('images/bad.png', 0, 240, 25, 25).add();

                console.log(Math.round(hightest2));
                chart.renderer.image('images/healthy_reports_highest.png', 535, Math.round(hightest2)+190, 15, 15).add().
                renderer.text(hightest2+'h', 555, Math.round(hightest2)+200).attr({}).
                css({
                    fontSize: '16px',
                    color: '#000',
                    fontFamily:'华文细黑',
                }).add().
                renderer.text('', 555, Math.round(hightest2)+220+17).attr({
                }).
                css({
                    fontSize: '13px',
                    color: '#000',
                    fontFamily:'华文细黑',
                }).add();

                chart.yAxis[0].addPlotLine({           //在x轴上增加
                    value:minest2,                           //在值为2的地方
                    width:1,                           //标示线的宽度为2px
                    dashStyle:'Dot',
                    color: '#000',                  //标示线的颜色
                    id: 'plot-line-1', //标示线的id，在删除该标示线的时候需要该id标示
                    zIndex:3,               //标示线的id，在删除该标示线的时候需要该id标示
                });
                chart.renderer.image('images/healthy_reports_lowest.png', 535, Math.round(minest2)+230, 15, 15).add().

                renderer.text(minest2+'h', 555, Math.round(minest2)+240).attr({}).
                css({
                    fontSize: '16px',
                    color: '#000',
                    fontFamily:'华文细黑',
                }).add().
                renderer.text('', 555,Math.round(minest2)+220+15).attr({
                }).
                css({
                    fontSize: '13px',
                    color: '#000',
                    fontFamily:'华文细黑',
                }).add();


                chart.yAxis[0].addPlotLine({           //在x轴上增加
                    value:avg2,                           //在值为2的地方
                    width:1,                           //标示线的宽度为2px
                    dashStyle:'Dot',
                    color: '#000',                  //标示线的颜色
                    id: 'plot-line-1', //标示线的id，在删除该标示线的时候需要该id标示
                    zIndex:3,
                });

                chart.renderer.image('images/healthy_reports_average.png', 535,((Math.round(minest2)+230)+Math.round(hightest2)+190)/2, 15, 15).add().

                renderer.text(avg2+'h', 555, ((Math.round(minest2)+230)+Math.round(hightest2)+190)/2+10).attr({}).
                css({
                    fontSize: '16px',
                    color: '#000',
                    fontFamily:'华文细黑',
                }).add().
                renderer.text('', 555, ((Math.round(minest2)+250)+Math.round(hightest2)+200)/2+15).attr({
                }).
                css({
                    fontSize: '13px',
                    color: '#000',
                    fontFamily:'华文细黑',
                }).add();
                chart.renderer.path(['M', 75, 0, 'L',75, 300])
                        .attr({
                            'stroke-width': 2,
                            stroke: 'black',
                            dashstyle: 'Dot'
                        }).add()
            });






            var chart = new Highcharts.Chart('chartdiv3', {
                chart:{
                    type:'spline',
                    tooltip: {
                        enabled : false
                    },
                    marginRight: 50,
                    marginLeft: 40,
                },
                tooltip: {
                    enabled : false
                },
                title: {
                    text: 'Sleep quality curve',
                    x: -30,
                    y: 40
                },
                subtitle: {
                },
                xAxis: {
                    visible: false,
                    enabled: false,
                    labels: {
                        enabled: false
                    }
                },
                yAxis: {
                    visible: false,
                    enabled: false,
                    style: {
                        dashStyle:'Dot',     //
                        fontSize:'15px',
                        fontFamily:'华文细黑,STHeiti,MingLiu'
                    },
                    gridLineWidth:'0px',
                    title: {
                        text: ''
                    },
                    plotLines:[
                        {
                            label:{
                                text:hightest3+'(Maximum Value)',    //标签的内容
                                align:'right',                //标签的水平位置，水平居左,默认是水平居中center
                                x:10                         //标签相对于被定位的位置水平偏移的像素，重新定位，水平居左10px
                            },
                            zIndex:26,
                            color:'#ddd',           //线的颜色，定义为红色
                            dashStyle:'Dot',     //默认值，这里定义为实线
                            value:hightest3,         //定义在那个值上显示标示线，这里是在x轴上刻度为3的值处垂直化一条线
                            width:2                //标示线的宽度，2px
                        },
                        {
                            label:{
                                text:minest3+'(Minimum Value)',   //标签的内容
                                align:'right',                //标签的水平位置，水平居左,默认是水平居中center
                                x:10                         //标签相对于被定位的位置水平偏移的像素，重新定位，水平居左10px
                            },
                            color:'#ddd',
                            dashStyle:'Dot',
                            value:minest3,
                            width:2,
                            zIndex:23
                        },
                        {

                            label:{
                                text:avg3+'(Average Value)',  //标签的内容
                                align:'right',                //标签的水平位置，水平居左,默认是水平居中center
                                x:10                         //标签相对于被定位的位置水平偏移的像素，重新定位，水平居左10px
                            },

                            color:'#ddd',
                            dashStyle:'Dot',
                            value:avg3,
                            width:2
                        }
                    ]
                },

                legend: {
                    enabled: false,
                    layout: 'vertical',
                    backgroundColor: '#fff',
                    floating: true,
                    align: 'left',
                    verticalAlign: 'top',
                    x: 30,
                    y: 45,
//                    labelFormat: '<span style="color:#a37c59">{name}</span>'
                },
                plotOptions: {
                    series: {
                        lineWidth: 1,
                        marker: {
                            enabled: false
                        }
                    }
                },
                series:
                        [
                            fields3
                        ]
                ,
                credits:{
                    enabled:false // 禁用版权信息
                }
            }, function (chart) {
                chart.yAxis[0].addPlotLine({           //在x轴上增加
                    value:hightest3,                           //在值为2的地方
                    width:1,                           //标示线的宽度为2px
                    dashStyle:'Dot',
                    color: '#000',                  //标示线的颜色
                    id: 'plot-line-1', //标示线的id，在删除该标示线的时候需要该id标示
                    zIndex:3,               //标示线的id，在删除该标示线的时候需要该id标示
                });

                chart.renderer.image('images/healthy_reports_highest.png', 535, Math.round(hightest3)-20, 15, 15).add().

                renderer.text(Math.round(hightest3), 550, Math.round(hightest3)-5).attr({}).
                css({
                    fontSize: '23px',
                    color: '#000',
                    fontFamily:'华文细黑',
                }).add().
                renderer.text('', 555, Math.round(hightest3)).attr({
                }).
                css({
                    fontSize: '13px',
                    color: '#000',
                    fontFamily:'华文细黑',
                }).add();

                chart.yAxis[0].addPlotLine({           //在x轴上增加
                    value:minest3,                           //在值为2的地方
                    width:1,                           //标示线的宽度为2px
                    dashStyle:'Dot',
                    color: '#000',                  //标示线的颜色
                    id: 'plot-line-1', //标示线的id，在删除该标示线的时候需要该id标示
                    zIndex:3,               //标示线的id，在删除该标示线的时候需要该id标示
                });
                chart.renderer.image('images/healthy_reports_lowest.png', 535, Math.round(minest3)+170, 15, 15).add().

                renderer.text(Math.round(minest3), 545, Math.round(minest3)+185).attr({}).
                css({
                    fontSize: '23px',
                    color: '#000',
                    fontFamily:'华文细黑',
                }).add().
                renderer.text('', 555, Math.round(minest3)+190).attr({
                }).
                css({
                    fontSize: '13px',
                    color: '#000',
                    fontFamily:'华文细黑',
                }).add();




                chart.yAxis[0].addPlotLine({           //在x轴上增加
                    value:avg3,                           //在值为2的地方
                    width:1,                           //标示线的宽度为2px
                    dashStyle:'Dot',
                    color: '#000',                  //标示线的颜色
                    id: 'plot-line-1', //标示线的id，在删除该标示线的时候需要该id标示
                    zIndex:3,
                });

                chart.renderer.image('images/healthy_reports_average.png', 535,(Math.round(minest3)+170+(Math.round(hightest3)-20))/2 , 15, 15).add().

                renderer.text(Math.round(avg3), 555, (Math.round(minest3)+170+(Math.round(hightest3)-20))/2+15).attr({}).
                css({
                    fontSize: '23px',
                    color: '#000',
                    fontFamily:'华文细黑',
                }).add().
                renderer.text('', 555, ((260-y_min)+(Math.round(hightest3)))/2+30).attr({
                }).
                css({
                    fontSize: '13px',
                    color: '#000',
                    fontFamily:'华文细黑',
                }).add();

            });







        },
        error: function (data) {
            console.log(data);
        }
    });


}
</script>
<script src="  JS/mine.js"></script>
</body>

