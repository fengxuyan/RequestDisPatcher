/**
 * Created by Yao on 2017/1/6.
 */
$(function () {

    function getMax(a,b,c)
    {
        return a>b?(a>c?a:c):(b>c?b:c);
    }

    $('body').css('min-height',$(window).height());
    $('.holder').css('min-height',$(window).height());
    if($(".left_nav").height() <$(window).height()){
        $(".left_nav").height($(window).height());
    }

    if($(".right_show").height() <$(window).height()){
        $(".right_show").height($(window).height());
    }

    if($(".left_nav").height() > $(".right_show").height()){
        $(".right_show").height($(".left_nav").height());
        $('.holder').css('min-height',$(".left_nav").height());
    }
    else{
        $(".left_nav").height($(".right_show").height());
        $('.holder').css('min-height',$(".right_show").height());
    }
    var max = getMax($(".concern0").height(),$(".concern1").height(),$(".concern2").height());

    $('.contest').height($(".left_nav").height()-60);
    $('.concern_item0').hide();
    // siblings()用于初始化，在后续的点击事件中不应该使用siblings(),
    //$(".real ul li").eq(0).addClass("on").siblings().removeClass("on");
    var that=$(".left_nav ul li").eq(0)[0];
    $(".left_nav ul li").click(function(event) {
// $(this).addClass('on').siblings('span').removeClass('on');
        if(typeof(that)!="undefined"){
            $(that).removeClass("on");
        }
        $(this).addClass('on');
        that=this;
    });
    function bindListener(){
        $('.concern_item1  .clickLi ').siblings().hide();
        $(".clickLi").unbind().each(function(index,item){
            $(item).on("click",function(event){
                $target=$(event.target);
                $('i',this).toggleClass('itme1_arrow').toggleClass('itme2_arrow');
                $(this).siblings().toggle('item1_product_list');
            });
        });
    }
    $(".concern_list li").eq(0).addClass("clickC");
    $(".concern_list li").each(function(index,item){
        $(item).bind("click",function(){
            $(item).addClass("clickC");
            $(item).siblings().removeClass("clickC");
            if(index==0){
                $('.concern0').show();
                $('.concern1').hide();
                $('.concern2').hide();
                // $('.concern_item1').hide();
                //$('.oneDayLists').hide();

            }
            if(index==1) {
                $('.concern1').show();
                $('.concern0').hide();
                $('.concern2').hide();
                // $('.concern_item2').hide();
                //$('.oneDayLists').hide();
            }
            if(index==2){
                $('.concern2').show();
                $('.concern0').hide();
                $('.concern1').hide();
                // $('.concern_item1').hide();
            }
            //$(".concern_item0").hide();
        });
    });





    $('.concern2').hide();
    $('.concern1').hide();
    $(".search_list li").eq(0).addClass("clickC");
    //$('.report').show();

    $('.two').hide();
    $('.one').show();
    $("#onesearch").bind("click",function() {
            $('.one').hide();
            $('.report').show();
            window.location.href='sleepreport.html';
        }
    );
    $("#twosearch").bind("click",function() {
            $('.two').hide();
            $('.reports').show();
            $('.right_show').css("height", "1800px");
            window.location.href='SleepAnalysis.html';
        }
    );
    //$("#twosearch").click($('.report').show());
    $(".search_list li").each(function(index,item){
        $(item).bind("click",function(){
            $(item).addClass("clickC");
            $(item).siblings().removeClass("clickC");
            if(index==0){
                $('.one').show();
                $('.two').hide();
            }
            if(index==1){
                $('.one').hide();
                $('.two').show();
            }
            //$(".concern_item0").hide();
        });
    });


    $(".search_list.report li").each(function(index,item){
        $(item).bind("click",function(){
            // $(item).removeClass("clickC");
            if(index==0){
                $(item).addClass("clickC");
                $('.one').show();
                $('.two').hide();
            }
            if(index==1){
                $('.one').hide();
                $('.two').show();
                $(item).siblings().addClass("clickC");
                $(item).removeClass("clickC");
            }
            //$(".concern_item0").hide();
        });
    });

    $(".search_list.reportslist li").each(function(index,item){
        $(".search_list li").eq(0).removeClass("clickC");
        $(".search_list li").eq(1).addClass("clickC");
        $(item).bind("click",function(){
            // $(item).removeClass("clickC");
            if(index==0){
                $('.one').show();
                $('.two').hide();
                $(item).siblings().addClass("clickC");
                $(item).removeClass("clickC");
            }
            if(index==1){
                $('.one').hide();
                $('.two').show();
                $(item).addClass("clickC");
            }
            //$(".concern_item0").hide();
        });
    });
    var chart = AmCharts.makeChart("chartdiv", {
        "type": "serial",
        "theme": "light",
        "marginRight": 80,
        "marginTop": 17,
        "autoMarginOffset": 20,
        "dataProvider": [{
            "date": "2012-03-01",
            "price": 20
        }, {
            "date": "2012-03-02",
            "price": 75
        }, {
            "date": "2012-03-03",
            "price": 15
        }, {
            "date": "2012-03-04",
            "price": 75
        }, {
            "date": "2012-03-05",
            "price": 158
        }, {
            "date": "2012-03-06",
            "price": 57
        }, {
            "date": "2012-03-07",
            "price": 107
        }, {
            "date": "2012-03-08",
            "price": 89
        }, {
            "date": "2012-03-09",
            "price": 75
        }, {
            "date": "2012-03-10",
            "price": 132
        }, {
            "date": "2012-03-11",
            "price": 158
        }, {
            "date": "2012-03-12",
            "price": 56
        }, {
            "date": "2012-03-13",
            "price": 169
        }, {
            "date": "2012-03-14",
            "price": 24
        }, {
            "date": "2012-03-15",
            "price": 147
        }],
        "valueAxes": [{
            "logarithmic": true,
            "dashLength": 1,
            "guides": [{
                "dashLength": 6,
                "inside": true,
                "label": "average",
                "lineAlpha": 1,
                "value": 90.4
            }],
            "position": "left"
        }],
        "graphs": [{
            "bullet": "round",
            "id": "g1",
            "bulletBorderAlpha": 1,
            "bulletColor": "#FFFFFF",
            "bulletSize": 7,
            "lineThickness": 2,
            "title": "Price",
            "type": "smoothedLine",
            "useLineColorForBulletBorder": true,
            "valueField": "price"
        }],
        "chartScrollbar": {},
        "chartCursor": {
            "valueLineEnabled": true,
            "valueLineBalloonEnabled": true,
            "valueLineAlpha": 0.5,
            "fullWidth": true,
            "cursorAlpha": 0.05
        },
        "dataDateFormat": "YYYY-MM-DD",
        "categoryField": "date",
        "categoryAxis": {
            "parseDates": true
        },
        "export": {
            "enabled": true
        }
    });
    chart.addListener("dataUpdated", zoomChart);
    function zoomChart() {
        chart.zoomToDates(new Date(2012, 2, 2), new Date(2012, 2, 10));
    }

    var chart1 = AmCharts.makeChart("chartdiv1", {
        "type": "serial",
        "theme": "light",
        "marginRight": 80,
        "marginTop": 17,
        "autoMarginOffset": 20,
        "dataProvider": [{
            "date": "2012-03-01",
            "price": 20
        }, {
            "date": "2012-03-02",
            "price": 75
        }, {
            "date": "2012-03-03",
            "price": 15
        }, {
            "date": "2012-03-04",
            "price": 75
        }, {
            "date": "2012-03-05",
            "price": 158
        }, {
            "date": "2012-03-06",
            "price": 57
        }, {
            "date": "2012-03-07",
            "price": 107
        }, {
            "date": "2012-03-08",
            "price": 89
        }, {
            "date": "2012-03-09",
            "price": 75
        }, {
            "date": "2012-03-10",
            "price": 132
        }, {
            "date": "2012-03-11",
            "price": 158
        }, {
            "date": "2012-03-12",
            "price": 56
        }, {
            "date": "2012-03-13",
            "price": 169
        }, {
            "date": "2012-03-14",
            "price": 24
        }, {
            "date": "2012-03-15",
            "price": 147
        }],
        "valueAxes": [{
            "logarithmic": true,
            "dashLength": 1,
            "guides": [{
                "dashLength": 6,
                "inside": true,
                "label": "average",
                "lineAlpha": 1,
                "value": 90.4
            }],
            "position": "left"
        }],
        "graphs": [{
            "bullet": "round",
            "id": "g1",
            "bulletBorderAlpha": 1,
            "bulletColor": "#FFFFFF",
            "bulletSize": 7,
            "lineThickness": 2,
            "title": "Price",
            "type": "smoothedLine",
            "useLineColorForBulletBorder": true,
            "valueField": "price"
        }],
        "chartScrollbar": {},
        "chartCursor": {
            "valueLineEnabled": true,
            "valueLineBalloonEnabled": true,
            "valueLineAlpha": 0.5,
            "fullWidth": true,
            "cursorAlpha": 0.05
        },
        "dataDateFormat": "YYYY-MM-DD",
        "categoryField": "date",
        "categoryAxis": {
            "parseDates": true
        },
        "export": {
            "enabled": true
        }
    });
    chart1.addListener("dataUpdated", zoomChart1);
    function zoomChart1() {
        chart1.zoomToDates(new Date(2012, 2, 2), new Date(2012, 2, 10));
    }
    var chart2 = AmCharts.makeChart("chartdiv2", {
        "type": "serial",
        "theme": "light",
        "marginRight": 80,
        "marginTop": 17,
        "autoMarginOffset": 20,
        "dataProvider": [{
            "date": "2012-03-01",
            "price": 20
        }, {
            "date": "2012-03-02",
            "price": 75
        }, {
            "date": "2012-03-03",
            "price": 15
        }, {
            "date": "2012-03-04",
            "price": 75
        }, {
            "date": "2012-03-05",
            "price": 158
        }, {
            "date": "2012-03-06",
            "price": 57
        }, {
            "date": "2012-03-07",
            "price": 107
        }, {
            "date": "2012-03-08",
            "price": 89
        }, {
            "date": "2012-03-09",
            "price": 75
        }, {
            "date": "2012-03-10",
            "price": 132
        }, {
            "date": "2012-03-11",
            "price": 158
        }, {
            "date": "2012-03-12",
            "price": 56
        }, {
            "date": "2012-03-13",
            "price": 169
        }, {
            "date": "2012-03-14",
            "price": 24
        }, {
            "date": "2012-03-15",
            "price": 147
        }],
        "valueAxes": [{
            "logarithmic": true,
            "dashLength": 1,
            "guides": [{
                "dashLength": 6,
                "inside": true,
                "label": "average",
                "lineAlpha": 1,
                "value": 90.4
            }],
            "position": "left"
        }],
        "graphs": [{
            "bullet": "round",
            "id": "g1",
            "bulletBorderAlpha": 1,
            "bulletColor": "#FFFFFF",
            "bulletSize": 7,
            "lineThickness": 2,
            "title": "Price",
            "type": "smoothedLine",
            "useLineColorForBulletBorder": true,
            "valueField": "price"
        }],
        "chartScrollbar": {},
        "chartCursor": {
            "valueLineEnabled": true,
            "valueLineBalloonEnabled": true,
            "valueLineAlpha": 0.5,
            "fullWidth": true,
            "cursorAlpha": 0.05
        },
        "dataDateFormat": "YYYY-MM-DD",
        "categoryField": "date",
        "categoryAxis": {
            "parseDates": true
        },
        "export": {
            "enabled": true
        }
    });
    chart2.addListener("dataUpdated", zoomChart2);
    function zoomChart2() {
        chart2.zoomToDates(new Date(2012, 2, 2), new Date(2012, 2, 10));
    }
    var chart3 = AmCharts.makeChart("chartdiv3", {
        "type": "serial",
        "theme": "light",
        "marginRight": 80,
        "marginTop": 17,
        "autoMarginOffset": 20,
        "dataProvider": [{
            "date": "2012-03-01",
            "price": 20
        }, {
            "date": "2012-03-02",
            "price": 75
        }, {
            "date": "2012-03-03",
            "price": 15
        }, {
            "date": "2012-03-04",
            "price": 75
        }, {
            "date": "2012-03-05",
            "price": 158
        }, {
            "date": "2012-03-06",
            "price": 57
        }, {
            "date": "2012-03-07",
            "price": 107
        }, {
            "date": "2012-03-08",
            "price": 89
        }, {
            "date": "2012-03-09",
            "price": 75
        }, {
            "date": "2012-03-10",
            "price": 132
        }, {
            "date": "2012-03-11",
            "price": 158
        }, {
            "date": "2012-03-12",
            "price": 56
        }, {
            "date": "2012-03-13",
            "price": 169
        }, {
            "date": "2012-03-14",
            "price": 24
        }, {
            "date": "2012-03-15",
            "price": 147
        }],
        "valueAxes": [{
            "logarithmic": true,
            "dashLength": 1,
            "guides": [{
                "dashLength": 6,
                "inside": true,
                "label": "average",
                "lineAlpha": 1,
                "value": 90.4
            }],
            "position": "left"
        }],
        "graphs": [{
            "bullet": "round",
            "id": "g1",
            "bulletBorderAlpha": 1,
            "bulletColor": "#FFFFFF",
            "bulletSize": 7,
            "lineThickness": 2,
            "title": "Price",
            "type": "smoothedLine",
            "useLineColorForBulletBorder": true,
            "valueField": "price"
        }],
        "chartScrollbar": {},
        "chartCursor": {
            "valueLineEnabled": true,
            "valueLineBalloonEnabled": true,
            "valueLineAlpha": 0.5,
            "fullWidth": true,
            "cursorAlpha": 0.05
        },
        "dataDateFormat": "YYYY-MM-DD",
        "categoryField": "date",
        "categoryAxis": {
            "parseDates": true
        },
        "export": {
            "enabled": true
        }
    });
    chart3.addListener("dataUpdated", zoomChart3);
    function zoomChart3() {
        chart3.zoomToDates(new Date(2012, 2, 2), new Date(2012, 2, 10));
    }


    $('.approval_agree').click(
        function () {
            var approval_box0_email=$(".approval_box0_email").html();
            alert(approval_box0_email);
            var ajaxurl="/SleepMonitor/concern/query";
            $.ajax({
                    type:"POST",
                    url:ajaxurl,
                    data:{"approval_box0_email":approval_box0_email,"approval_agree":1},
                    async: false,
                    dataType:"json",
                    jsonp:'callback',
                    success:function(data) {
                        //alert("success"); location.href = "{php echo url('wechat/card/')}" + 'f=post&do=' + type;
                        var div='<div class="a"><div class="head-pic" style="display: inline-block"> <img src="../images/0.jpg"> </div> <div style="display: inline-block"> <ul> <li><span>name</span> <span class="approval_box1_email">email</span><button type="button" class="unfollow">鍙栨秷鍏虫敞</button></li> </ul> <ul> <li><span>鏅鸿兘搴婂灚</span> <button type="button" class="now">鏌ョ湅瀹炴椂</button> <button type="button" class="history"> 鏌ョ湅鍘嗗彶</button></li> </ul> </div></div><div class="clear"></div>';
                        $(".approval_box1").after(div);

                        $('.now').click(
                            function(){
                                window.location.href='product/id=123&now=1';
                            });
                        $('.history').click(
                            function(){
                                window.location.href='id=123&now=0';
                            }
                        );
                    },
                    error: function (jqXHR, textStatus, errorThrown,Code) {
                        alert("Unkonw Error.Please Try Again!");
                    }
                }
            );
            return false;
        });

    $('.approval_disagree').click(
        function () {
            var approval_box0_email=$('.approval_box0_email').html();
            var ajaxurl="/SleepMonitor/concern/query";
            //var ajaxurl="test.php";
            $.ajax({
                    type:"POST",
                    url:ajaxurl,
                    data:{"approval_box0_email":approval_box0_email,"approval_agree":0},
                    async: false,
                    dataType:"json",
                    jsonp:'callback',
                    success:function(data) {
                        //alert("success");
                    },
                    error: function (jqXHR, textStatus, errorThrown,Code) {
                        alert("Unkonw Error.Please Try Again!");
                    }
                }
            );
            return false;
        });
    $('.unfollow').click(
        function(){
            var approval_box1_email=$(".approval_box1_email").html();
            var ajaxurl="/SleepMonitor/concern/query";
            $.ajax({
                    type:"POST",
                    url:ajaxurl,
                    data:{"approval_box1_email":approval_box1_email,"unfollow":1},
                    async: false,
                    dataType:"json",
                    jsonp:'callback',
                    success:function(data) {
                        $('.approval_box1').remove();
                    },
                    error: function (jqXHR, textStatus, errorThrown,data) {
                        alert("Unkonw Error.Please Try Again!");
                    }
                }
            );
            return false;

        });

    $('#disable').click(
        function () {
            var approval_box2_email=$(".approval_box2_email").html();
            var ajaxurl="/SleepMonitor/concern/query";
            //var ajaxurl="test.php";
            $.ajax({
                    type:"POST",
                    url:ajaxurl,
                    data:{"approval_box0_email":approval_box2_email,"disable":1},
                    async: false,
                    dataType:"json",
                    jsonp:'callback',
                    success:function(data) {
                        //alert("success");
                    },
                    error: function (jqXHR, textStatus, errorThrown,Code) {
                        alert("Unkonw Error.Please Try Again!");
                    }
                }
            );
            return false;
        });

});