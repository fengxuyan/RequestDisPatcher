<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Family Concern</title>
    <meta http-equiv="Cache-Control" content="no-transform" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=yes" />

    <script src="  /RequestDisPatcher/JS/jquery-3.2.0.min.js"></script>
    <script src="  /RequestDisPatcher/JS/xcConfirm.js"></script>
    <link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/xcConfirm.css"/>
    <link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/layout.css">
    <link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/global.css">
    <link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/font-awesome.min.css">
    <script type="text/javascript">
        var userInfo = document.cookie.match(new RegExp("(^| )userData=([^;]*)(;|$)"));

        if(userInfo==null){
            window.location.href = "login.php";//location.href实现客户端页面的跳转
        };
        $(document).ready(function(){
            var userInfo = document.cookie.match(new RegExp("(^| )userData=([^;]*)(;|$)"));
//            console.log(userInfo);
            var info = JSON.parse(userInfo[2]);
            console.log(info);
            var Info=info['userInfo'];
            var token = info.token;
            var myConcern;
            var concernMe;
            var applyConcern;
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
            function cancelconcernMe() {
                $(".concern2 .concern202 .concern_item2").unbind().each(function(index,item){
                            $('.itme1_rabish',item).on("click",function(event) {
                                var name=$('.name',item)[0].innerText;
                                var email=$('.email',item)[0].innerText;
                                var txt=  "No longer be cared by "+name+'?';
                                window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.confirm,{
                                    onOk:function(){

                                        $.ajax({
                                            type:"POST",
                                            url:"  request/dispatcher.do",
                                            data:{
                                                url:"http://127.0.0.1:9001/login/cancel",
                                                params:"email="+email+"&type="+'concernMe'+"&token="+token
                                            },
                                            dataType:"json",
                                            success:function(data) {
                                                if(data.Code==1){
                                                    $(item).remove();
                                                }else if(data.Code==0){
                                                    var txt='Operate failed';
                                                    window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);

                                                }else if(data.Code==1009){
                                                    var txt='Repeat adding users';
                                                    window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);

                                                }

                                            },
                                            error: function (jqXHR, textStatus, errorThrown,Code) {
                                                var txt="Unkonw Error.Please Try Again!";
                                                window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.info);
                                            }
                                        })

                                    }});
                            })
                        }
                )
            }


            function bindListener(){
                $('.concern_item1  .clickLi ').siblings().hide();

                $(".clickLi").unbind().each(function(index,item){

                    $(item).on("click",function(event){


                        $target=$(event.target);

                        var name1=$('.name',this).text();

                        var email=$('span:last-child',this).text();

                        $('.itme1_rabish',this).bind('click',function(){
//                            console.log( $(this).parents('.name').text());
//                            console.log( $(this).parents('.clickLi').text());
                            var txt='No longer care '+name1+'?';
                            window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.confirm,{
                                onOk:function(){
                                    $(item).parents('.concern_item1').remove();
                                    $.ajax({
                                        type:"POST",
                                        url:"  request/dispatcher.do",
                                        data:{
                                            url:"http://127.0.0.1:9001/login/cancel",
                                            params:"email="+email+"&type="+'myConcern'+"&token="+token
                                        },
                                        dataType:"json",
                                        success:function(data) {
                                            console.log(data);
//                                            $(item).parents('.concern_item1').remove();
//                                    location.reload();

                                        },
                                        error: function (jqXHR, textStatus, errorThrown,Code) {
                                            var txt="Unkonw Error.Please Try Again!";
                                            window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.info);
                                        }
                                    })

                                }});
                        });
                        $('i',this).toggleClass('itme1_arrow').toggleClass('itme2_arrow');
                        $(this).siblings().toggle('item1_product_list');

                        if($(".left_nav").height() > $(".right_show").height()){
                            $(".right_show").height($(".left_nav").height()+30);
                            $('.holder').css('min-height',$(".left_nav").height());
                        }
                        else{
                            $(".left_nav").height($(".right_show").height()+135);
                            $('.holder').css('min-height',$(".right_show").height());
                        }

                    });
                });
            }

            function yesORno(num){
                $(".concern2 .concern201 .concern_item2 ").unbind().each(function(index,item){

                    $('.cancel .submit_submit',item).on("click",function(event){
                        var email=$('.email',item)[0].innerText;
                        var name=$('.name',item)[0].innerText;
                        var image=$('.header_pic img',item)[0].src;
                        $('.concern_list li:last-child  i span').text(num-1);

                        if($('.concern_list li:last-child  i span').text()==0) {

                            $('.concern_list li:last-child  i').remove();

                        };
                        $(this).parents('.concern_item2').remove();
                        $.ajax({
                            type:"post",
                            url:"  request/dispatcher.do",
                            data: {
                                url:"http://101.37.100.209:9001/login/handle",
                                params:"token="+token+"&email="+email+"&handle=agree"
                            },
                            success: function (data) {


                                if(data.Code==1){
                                    $(this).parents('.concern_item2').remove();

                                    $(".concern2 .concern202").append('<ul class="concern_item2"> <div class="detail_pic"> <div class="header_pic"> <i class="itme1_arrow"></i>  <img src="'+image+'" id="head"> <span class="name">'+name+'</span> <span class="email">'+email+'</span> </div><i class="itme1_rabish"></i> </div> </ul>');
                                    if($(".left_nav").height() > $(".right_show").height()){
                                        $(".right_show").height($(".left_nav").height()+30);
                                        $('.holder').css('min-height',$(".left_nav").height());
                                    }
                                    else{
                                        $(".left_nav").height($(".right_show").height()+131);
                                        $('.holder').css('min-height',$(".right_show").height());
                                    }
                                    cancelconcernMe();
                                }else if(data.Code==0){
                                    var txt='Operate failed';
                                    window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);

                                }else if(data.Code==1009){
                                    var txt='Repeat adding users';
                                    window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);

                                }



                            },
                            error: function (data) {
                                var txt="Unkonw Error.Please Try Again!";
                                window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.info);
                            }
                        });


                    });

                    $('.cancel .submit_back',item).on("click",function(event){
                        var email=$('.email',item)[0].innerText;
                        $(this).parents('.concern_item2').remove();

                        $.ajax({
                            type:"post",
                            url:"  request/dispatcher.do",
                            data: {
                                url:"http://101.37.100.209:9001/login/handle",
                                params:"token="+token+"&email="+email+"&handle=disagree"
                            },
                            success: function (data) {


                                    if(data.Code==1){
                                        $('.concern_list li:last-child  i span').text(num-1);
                                        if($('.concern_list li:last-child  i span').text()==0) {

                                            $('.concern_list li:last-child  i').remove();

                                        };
                                        $(this).parents('.concern_item2').remove();
                                    }else if(data.Code==0){
                                        var txt='Operate failed';
                                        window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);

                                    }else if(data.Code==1009){
                                        var txt='Repeat adding users';
                                        window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);

                                    }

                                console.log(data);





                            },
                            error: function (data) {
                                var txt=data.Message;
                                window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.confirm);
                            }
                        });

                    });
                });

            }
            $.ajax({
                type:"post",
                url:"  request/dispatcher.do",
                data: {
                    url:"http://127.0.0.1:9001/login/getWait",
                    params:"token="+token
                },
                success: function (data) {
//                    console.log(data.Data.length);
                    var num=data.Data.length;
//                    $('.concern_item2').empty();
                    if(num>0){
                        $('.concern_list li:last-child  i').addClass("num");
                        $('.concern_list li:last-child  i span').text(num);
                    };
                    $.each(data.Data, function(i, item) {
                        if(item.image==null){
                            if(item.gender==1){
                                item.image='  Heads/header_man.png';
                            }else if(item.gender==0){
                                item.image='  Heads/header_woman.png';
                            }
                        }else{
                            item.image=item.image;
                        }

                        $(".concern2 .concern201").append('<ul class="concern_item2"><div class="detail_pic"> <div class="header_pic"> <i class="itme1_arrow"></i> <img src="'+item.image+'" id="head">  <span class="name" style="width:115px;">'+item.name+'</span> <span class="email">'+item.email+'</span> </div> <div class="cancel" style=" right: -40px;"> <input type="button" value="Approve" name="yes" class="submit_submit" style="cursor:pointer;width:50px;height: 30px;"><input type="button" name="no"  value="Refuse" class="submit_back" style="cursor:pointer;width:50px;height: 30px;">  </div> </div> </ul>');
                        if($(".left_nav").height() > $(".right_show").height()){
                            $(".right_show").height($(".left_nav").height()+30);
                            $('.holder').css('min-height',$(".left_nav").height());
                        }
                        else{
                            $(".left_nav").height($(".right_show").height()+90);
                            $('.holder').css('min-height',$(".right_show").height());
                        }
                    });
                    yesORno(num);

                },
                error: function (data) {
                    var txt="Unkonw Error.Please Try Again!";
                    window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.info);
                }
            });

            $.ajax({
                type:"post",
                url:"  request/dispatcher.do",
                data: {
                    url:"http://127.0.0.1:9001/login/getConcernMe",
                    params:"token="+token
                },
                success: function (data) {
                    console.log(data);
//                    $('.concern_item2').empty();
                    $.each(data.Data, function(i, item) {
                        if(item.image==null){
                            if(item.gender==1){
                                item.image='  Heads/header_man.png';
                            }else if(item.gender==0){
                                item.image='  Heads/header_woman.png';
                            }
                        };
                        $(".concern2 .concern202").append('<ul class="concern_item2"> <div class="detail_pic"> <div class="header_pic"> <i class="itme1_arrow"></i>  <img src="'+item.image+'" id="head"> <span class="name">'+item.name+'</span> <span class="email">'+item.email+'</span> </div><i class="itme1_rabish"></i> </div> </ul>');
                        if($(".left_nav").height() > $(".right_show").height()){
                            $(".right_show").height($(".left_nav").height()+30);
                            $('.holder').css('min-height',$(".left_nav").height());
                        }
                        else{
                            $(".left_nav").height($(".right_show").height()+131);
                            $('.holder').css('min-height',$(".right_show").height());
                        }
                    });
                    cancelconcernMe();

                },
                error: function (data) {
                    var txt="Unkonw Error.Please Try Again!";
                    window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.info);
                }
            });
            $.ajax({
                type:"post",
                url:"  request/dispatcher.do",
                data: {
                    url:"http://127.0.0.1:9001/login/getMyConcern",
                    params:"token="+token
                },
                success: function (data) {
                    console.log(data);
//                    $('.concern_item1').empty();
                    $.each(data.Data, function(i, item) {

                        if(item.image==null){
                                if(item.gender==1){
                                   item.image='  Heads/header_man.png';
                                }else if(item.gender==0){
                                    item.image='  Heads/header_woman.png';
                                }
                        };

                        var sn=item.device;
                        if(sn!=null){
                        if(sn.length==0){
                            $(".concern1").append('<ul class="concern_item1"> <div class="detail_pic"> <li class="clickLi"> <div class="header_pic"> <i class="itme1_arrow" ></i>  <img src="' + item.image + '" id="head">  <span class="name">' + item.name + '</span> <span class="email">' + item.email + '</span> </div> <i class="itme1_rabish"></i> </li> <li> <div class="item1_product_list"> <ul> <li><span >Smart mattress pad</span> <a href="#" style="background:#cdc8c3" title="No Device.Can not View!">Real-time Data</a> <a href="#" style="background:#cdc8c3" title="No Device.Can not View!">Health Archives</a> </li> <li><span >Smart Pillow</span> <a href="#" style="background:#cdc8c3" title="No Device.Can not View!">Real-time Data</a> <a href="#" title="No Device.Can not View!" style="background:#cdc8c3">Health Archives</a> </li> <li><span >Smart Bracele</span> <a style="background:#cdc8c3" href="#" title="No Device.Can not View!" style="background:#cdc8c3">Real-time Data</a> <a href="#" title="No Device.Can not View!" style="background:#cdc8c3">Health Archives</a> </li> </ul> </div> </li> </div> </ul>');
                            if($(".left_nav").height() > $(".right_show").height()){
                                $(".right_show").height($(".left_nav").height()+30);
                                $('.holder').css('min-height',$(".left_nav").height());
                            }
                            else{
                                $(".left_nav").height($(".right_show").height()+131);
                                $('.holder').css('min-height',$(".right_show").height());
                            }
                        }else{
                            $(".concern1").append('<ul class="concern_item1"> <div class="detail_pic"> <li class="clickLi"> <div class="header_pic"> <i class="itme1_arrow" ></i>  <img src="' + item.image + '" id="head">  <span class="name">' + item.name + '</span> <span class="email">' + item.email + '</span> </div> <i class="itme1_rabish"></i> </li> <li> <div class="item1_product_list"> <ul> <li><span>Smart mattress pad</span> <a href="real.php?&email='+item.email+'&sn='+sn+'">Real-time Data</a> <a href="healthy.php?&email='+item.email+'&sn='+sn+'">Health Archives</a> </li> <li><span>Smart Pillow</span> <a href="#" style="background:#cdc8c3"title="No Device.Can not View!">Real-time Data</a> <a href="#"  style="background:#cdc8c3" title="No Device.Can not View!">Health Archives</a> </li> <li><span >Smart Bracele</span> <a href="#" style="background:#cdc8c3" title="No Device.Can not View!">Real-time Data</a> <a href="#" style="background:#cdc8c3" title="No Device.Can not View!">Health Archives</a> </li> </ul> </div> </li> </div> </ul>');
                            if($(".left_nav").height() > $(".right_show").height()){
                                $(".right_show").height($(".left_nav").height()+30);
                                $('.holder').css('min-height',$(".left_nav").height());
                            }
                            else{
                                $(".left_nav").height($(".right_show").height()+131);
                                $('.holder').css('min-height',$(".right_show").height());
                            }

                        }
                        }else{

                            $(".concern1").append('<ul class="concern_item1"> <div class="detail_pic"> <li class="clickLi"> <div class="header_pic"> <i class="itme1_arrow" ></i>  <img src="' + item.image + '" id="head">  <span class="name">' + item.name + '</span> <span class="email">' + item.email + '</span> </div> <i class="itme1_rabish"></i> </li> <li> <div class="item1_product_list"> <ul> <li><span >Smart mattress pad</span> <a href="#" style="background:#cdc8c3">Real-time Data</a> <a href="#" style="background:#cdc8c3">Health Archives</a> </li> <li><span >Smart Pillow</span> <a href="#" style="background:#cdc8c3" title="No Device.Can not View!">Real-time Data</a> <a href="#" style="background:#cdc8c3" title="No Device.Can not View!">Health Archives</a> </li> <li><span >Smart Bracele</span> <a href="#" style="background:#cdc8c3" title="No Device.Can not View!">Real-time Data</a> <a href="#" style="background:#cdc8c3" title="No Device.Can not View!">Health Archives</a> </li> </ul> </div> </li> </div> </ul>');
                            if($(".left_nav").height() > $(".right_show").height()){
                                $(".right_show").height($(".left_nav").height()+30);
                                $('.holder').css('min-height',$(".left_nav").height());
                            }
                            else{
                                $(".left_nav").height($(".right_show").height()+131);
                                $('.holder').css('min-height',$(".right_show").height());
                            }

                        }
                        if($(".left_nav").height() > $(".right_show").height()){
                            $(".right_show").height($(".left_nav").height()+30);
                            $('.holder').css('min-height',$(".left_nav").height());
                        }
                        else{
                            $(".left_nav").height($(".right_show").height()+135);
                            $('.holder').css('min-height',$(".right_show").height());
                        }





                        ;

                    });

                    bindListener();

                },
                error: function (data) {
                    var txt="Unkonw Error.Please Try Again!";
                    window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.info);
                }
            });

            /* //实现鼠标悬浮文字提示
             function over(){
             document.getElementById("device_info").style.innerHTML="";
             }
             function out(){
             document.getElementById("device_info").style.innerHTML="No Device!";
             } */

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
        });
    </script>

</head>
<body>
<div class="holder">
    <div class="left_nav concern">
        <div class="header_text" style="    position: relative;
    top: -46px;">
            <div class="header_text_right">
                <span class="header_pic"><a href="modify.php" ><img src="Heads/default.jpg" id="head"></a></span>
            </div>
        </div>
        <ul style="  ">
            <a href="login.php"><li onclick="quit()"  >Logout</li></a>
            <a href="concern.php"><li class="on">Family care</li></a>
            <a href="productupgrade.php"><li>Value-Added Services</li></a>
            <a href="" ><span title="Yet open, please wait patiently"><li>Doctors' Hall</li></span></a>
        </ul>
    </div>
    <div class="right_show" >
        <h4 class="titl">isleep</h4>
        <a href="homepage.php"><span class="home"></span></a>
        <div class="show_detail">
            <div class="show_detail_data">
                <ul class="concern_list">
                    <li><span>Care request</span></li>
                    <li><span>My Care</span></li>
                    <li><span>Care me</span><i><span></span></i></li>
                </ul>
                <div class="concern0">
                    <div class="left" >
                        <div class="panel_input item0_input">
                            <input type="email" style="    border: 2px solid #DFDDDB;" class="" id="apply_txt"/>
                            <input type="button" style="cursor: pointer" class="search_btn" id="search_btn" >
                            <!--<img src="images/search.png" class="search_pic"/>-->
                        </div>
                    </div>
                </div>
                <div class="concern1"></div>
                <div class="concern2">
                    <div class="concern201"><h4>Approve The Request</h4> </div>
                    <div class="concern202"><h4>Already Care Me</h4> </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $('#search_btn').bind("click",function(){
        var userInfo = document.cookie.match(new RegExp("(^| )userData=([^;]*)(;|$)"));
        console.log(userInfo);
        var info = JSON.parse(userInfo[2]);
        var Info=info['userInfo'];
        var token = info.token;
        var approval_box0_email = $("#apply_txt").val();
        if ($.trim(approval_box0_email) == '') {
            var txt="input email!";
            window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.info);
            return false;
        }
        else{
            $.ajax({
                        type:"POST",
                        url:"  request/dispatcher.do",
                        data:{
                            url:"http://127.0.0.1:9001/login/query",
                            params:"email="+approval_box0_email
                        },
                        dataType:"json",
                        success:function(data) {
                            console.log(data);
                            $('.concern_item0').remove();
                            if(data.Code==1){
                                $(".concern_item0").remove();
                                if(data.Data.image==null){
                                    if( data.Data.gender==1){
                                        data.Data.image='  Heads/header_man.png';
                                    }else if( data.Data.gender==0){
                                        data.Data.image='  Heads/header_woman.png';
                                    }
                                };
                                $(".concern0").append(' <ul class="concern_item0"> <div  class="concern_someone_detail"> <div class="detail_pic"> <span class="header_pic"><img src="' + data.Data.image + '" id="head">  <p class="appl_name">' + data.Data.name + '</p> <p class="appl_email">' + data.Data.email + '</p> </span> <div class="detail_btn"> <input type="button" name="Submit" onclick="remove()" value="Cancel" class="submit_back"> <input type="button" value="Submit" id="submit_submit" class="submit_submit"> </div> </div> </div> </ul> ');
                                if($(".left_nav").height() > $(".right_show").height()){
                                    $(".right_show").height($(".left_nav").height()+30);
                                    $('.holder').css('min-height',$(".left_nav").height());
                                }
                                else{
                                    $(".left_nav").height($(".right_show").height()+135);
                                    $('.holder').css('min-height',$(".right_show").height());
                                }
//                                1001、用户不存在，1002、已经申请过关注，1003、不能关注你自己


                                $("#submit_submit").click(function () {
                                    $.ajax({
                                        type:"POST",
                                        url:"  request/dispatcher.do",
                                        data:{
                                            url:"http://127.0.0.1:9001/login/apply",
                                            params:"token="+token+"&email="+approval_box0_email
                                        },
                                        dataType:"json",
                                        success:function(data) {
//                                            alert(data.Message);
                                            if(data.Code==1){
                                                var txt=data.Message;
                                                window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.info);
                                            }
                                            else if(data.Code==2){

                                                var txt="No User Data";
                                                window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);
                                            }else if(data.Code==1001){

                                                var txt="User does not exist";
                                                window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);
                                            }else if(data.Code==1002){

                                                var txt="Has applied for attention";
                                                window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);
                                            }else if(data.Code==1003){

                                                var txt="Can not be concerned about yourself";
                                                window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);
                                            }


                                        },
                                        error: function (jqXHR, textStatus, errorThrown,Code) {
                                            var txt="Unkonw Error.Please Try Again!";
                                            window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);
                                        }
                                    })
                                });
                            }

                        },
                        error: function (jqXHR, textStatus, errorThrown,Code) {
                            var txt="Unkonw Error.Please Try Again!";
                            window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);
                        }
                    }
            );}
    });

    //清除查询的结果
    function remove(){
        $(".concern_item0").remove();
    }
    $('.right_show').css("min-height", $(window).height());
    $('.left_nav').css("min-height", $(window).height());
    $('.right_show').css("padding-bottom",60);

    if($(".left_nav").height() > $(".right_show").height()){
        $(".right_show").height($(".left_nav").height());
        $('.holder').css('min-height',$(".left_nav").height());
    }
    else{
        $(".left_nav").height($(".right_show").height());
        $('.holder').css('min-height',$(".right_show").height());
    }

</script>

<!--<script src="/SleepMonitor/JS/mine.js"></script>-->
<script src="  JS/mine.js"></script>
</body>
</html>