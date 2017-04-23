Date.prototype.format =function(format)
{
    var o = {
        "M+" : this.getMonth()+1, //month
        "d+" : this.getDate(), //day
        "h+" : this.getHours(), //hour
        "m+" : this.getMinutes(), //minute
        "s+" : this.getSeconds(), //second
        "q+" : Math.floor((this.getMonth()+3)/3), //quarter
        "S" : this.getMilliseconds() //millisecond
    }
    if(/(y+)/.test(format)) format=format.replace(RegExp.$1,
        (this.getFullYear()+"").substr(4- RegExp.$1.length));
    for(var k in o)if(new RegExp("("+ k +")").test(format))
        format = format.replace(RegExp.$1,
            RegExp.$1.length==1? o[k] :
                ("00"+ o[k]).substr((""+ o[k]).length));
    return format;
}


function MillisecondToDate(msd) {
    var time = parseFloat(msd) /1000;
    if (null!= time &&""!= time) {
        if (time >60&& time <60*60) {
            time = parseInt(time /60.0) +"minute"+ parseInt((parseFloat(time /60.0) -
                    parseInt(time /60.0)) *60) +"second";
        }else if (time >=60*60&& time <60*60*24) {
            time = parseInt(time /3600.0) +"hour"+ parseInt((parseFloat(time /3600.0) -
                    parseInt(time /3600.0)) *60) +"minute"+
                parseInt((parseFloat((parseFloat(time /3600.0) - parseInt(time /3600.0)) *60) -
                    parseInt((parseFloat(time /3600.0) - parseInt(time /3600.0)) *60)) *60) +"second";
        }else {
            time = parseInt(time) +"second";
        }
    }else{
        time = "0 hour 0 minute 0 second";
    }
    return time;

}