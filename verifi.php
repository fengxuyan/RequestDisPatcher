<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <base href="<%=basePath%>">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Forget Password</title>
    <!--<link rel="stylesheet" href="  CSS/bootstrap.min.css">-->
    <script src=" /RequestDisPatcher/ JS/jquery-3.2.0.min.js"></script>
    <script src=" /RequestDisPatcher/ JS/xcConfirm.js"></script>


    <link rel="stylesheet" type="text/css" href=" /RequestDisPatcher/ CSS/xcConfirm.css"/>
    <link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/layout.css">
    <link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/global.css">
    <link rel="stylesheet" type="text/css" href="  /RequestDisPatcher/CSS/font-awesome.min.css">
    <script type="text/javascript">
        function getQueryString(name) {
            var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
            var r = window.location.search.substr(1).match(reg);
            if (r != null) return unescape(r[2]);
            return null;
        }
        var email =  getQueryString('email');
        $(document).ready(function(){
            $("#submit").click(function(){
                $.ajax({
                    type:"post",
                    url:"  request/dispatcher.do",
                    data:{
                        url:"http://127.0.0.1:9001/login/verifi",
//                        url:"http://101.37.100.209:9001/login/verifi",
                        params:"email="+email+'&verifi='+$('#code').val()
                    },
                    dataType:"json",
                    success:function(data){

//                        window.location.href="  modifyPwd.html?email="+email;

                        if(data.Code==1){

						window.location.href="  modifyPwd.php?email="+email;
//                            window.location.href="  verifi.html";
                        }else if(data.Code==1006){
                            var txt='Verification failed';
                            window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);

                        }else if(data.Code==1007){
                            var txt='Too many times to verify';
                            window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);

                        }else if(data.Code==1008){
                            var txt='The verification code has expired. Please resend it';
                            window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.warning);

                        }
                    },
                    error:function(){
                        alert("Unkonw Error.Please Try Again!");
                    }
                });
            });
        });
    </script>
</head>
<body>
<div class="holder">
    <div class="header">
        <div class="header_scroll">
            <h2>isleep</h2>
        </div>
        <div class="header_text" style="    height: 78px;">
            <h2 class="title">Verify Code</h2>
        </div>
    </div>
    <div>
        <div class="foPwdTxt">
            <h2 class="title Email">Enter received verify code</h2>
        </div>
        <div class="foPwdTxt">
            <h2 class="title Email">Verify code</h2>
        </div>
        <div class="panel_input" style="border:2px solid #8A847F;    border-radius: 26px;height:49px !important;">
            <input type="text" placeholder="Verify code"  name="Verify_code" class="email" id="code" />
        </div>
        <div class="foot_btn fo" style="    margin-top: 60px;">
            <input type="button" name="Submit" onclick="javascript:history.back(-1);" value="Back" class="submit_back">
            <input type="button" value="Submit" class="submit_submit" id="submit">
        </div>
    </div>
</div>
</body>

<!--<link rel="stylesheet" type="text/css" href="/SleepMonitor/CSS/forget.css">-->
</html>