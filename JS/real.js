/**
 * Created by FengXuYan on 2017/4/4.
 */
/**
 * Created by Yao on 2017/1/6.
 */
$(function () {

    $('.xl_line').css('background-image','url(./images/70.gif)');

    var ajaxurl="http://101.37.100.209:9001/login/getConcernMe";

    /*
        判断返回的心率的值 由此更改心率图

     */

    // $.ajax({
    //     type: "GET",
    //     dataType: 'JSONP',
    //     url: ajaxurl,
    //     data: {
    //         "token": "C5B5E3BF26C23A785F8FC08F515C8669" ,
    //     },
    //     success: function (data) {
    //
    //         $('.xl_line').css('background-image','url(../WebRoot/images/70.gif)');
    //
    //     },
    //     error: function (data) {
    //         // alert('faile');
    //     }
    // });


    /*
     根据实时数据不同 根据状态绘制拼接block_pic 的背景图

     ajax请求返回状态 根据状态append div div对应着背景图  刷新当前页面 超出最外面的框就隐藏

     同时更改心率呼吸率

     */




});