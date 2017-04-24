/**
 * Created by Chison on 2017/4/10.
 */
function IsPC() {
    var userAgentInfo = navigator.userAgent;
    var Agents = ["Android", "iPhone",
        "SymbianOS", "Windows Phone",
        "iPad", "iPod"];
    var flag = true;
    for (var v = 0; v < Agents.length; v++) {
        if (userAgentInfo.indexOf(Agents[v]) > 0) {
            flag = false;
            break;
        }
    }
    return flag;
}

function maopao(msg) {
    $('#maopaomsg').text(msg);
    if(msg){
        $('#maopaos').modal({
            keyboard: false,
            backdrop: false,
            show: true
        });
        $('.new-style').css('background','rgba(0,0,0,0.7)').css('position','fixed').css('width','50%').css('top','40%').css('left','25%').css('height','2.5em').css('padding','0.5em').css('color','#FFF');
        if(IsPC()){
            $('.new-style').css('width','25%').css('left','38%');
        }
        setTimeout(cisHide, 1500);
    }

    function cisHide() {
        $('#maopaos').modal('hide');
    }
}