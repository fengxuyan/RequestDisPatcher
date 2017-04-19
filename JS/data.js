$(function () {

    var currYear = (new Date()).getFullYear();
    var opt={};
    opt.date = {preset : 'date'};
    opt.datetime = {preset : 'datetime'};
    opt.time = {preset : 'time'};
    opt.default = {
        theme: 'android-ics light', //皮肤样式
        display: 'modal', //显示方式
        mode: 'scroller', //日期选择模式
        dateFormat: 'mm/dd/yyyy',
        lang: 'zh',
        showNow: true,
        nowText: "今天",
        startYear: currYear - 100, //开始年份
        endYear: currYear  //结束年份
    };
    $("#appDate").mobiscroll($.extend(opt['date'], opt['default']));
    $("#changetime").mobiscroll($.extend(opt['date'], opt['default']));

    $("#changetimesleft").mobiscroll($.extend(opt['date'], opt['default']));

    $("#changetimesright").mobiscroll($.extend(opt['date'], opt['default']));
    //
    // var optDateTime = $.extend(opt['datetime'], opt['default']);
    // var optTime = $.extend(opt['time'], opt['default']);
    // $("#appDateTime").mobiscroll(optDateTime).datetime(optDateTime);
    // $("#appTime").mobiscroll(optTime).time(optTime);
    //获取当前的时间
    function today(){
        var today=new Date();
        var h=today.getFullYear();
        var m=today.getMonth()+1;
        var d=today.getDate();
        return m+"/"+d+"/"+h;
    }

    function weekago(){
        var today=new Date(new Date().getTime() - 1000 * 60 * 60 * 24 * 7);
        var h=today.getFullYear();
        var m=today.getMonth()+1;
        var d=today.getDate();
        return m+"/"+d+"/"+h;
    }
    // document.getElementById("changetime").value=today();
    document.getElementById("changetimesright").value=today();
    document.getElementById("changetimesleft").value=weekago();
});