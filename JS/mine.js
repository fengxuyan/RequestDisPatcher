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
        }

    );
    $("#twosearch").bind("click",function() {
            $('.two').hide();
            $('.reports').show();
            $('.right_show').css("height", "1800px");
            // window.location.href='SleepAnalysis.html';
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

});