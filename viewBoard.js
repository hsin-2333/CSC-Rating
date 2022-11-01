
// 3min Timer
var fullTime = 180;
var warn = 20;
var almost = 10;

var currTime = fullTime;

var timer = setInterval(function () {
    --currTime;

    // Clear interval if time is up:
    if (currTime < 0) {
        currTime = fullTime + 2;
        //window.clearInterval(timer);
    }
    if (currTime <= fullTime) document.getElementById("contain").style.visibility = "visible";
    else if (currTime > fullTime || currTime < 0) document.getElementById("contain").style.visibility = "hidden";

    //separate min and sec
    var T_sec = Math.floor(currTime % 60);
    var T_min = Math.floor(currTime / 60);

    // Prepend 0 if single-digit number:
    //var txt = currTime.toString().length === 1 ? "0" + currTime : currTime;
    var txt_s = T_sec.toString().length === 1 ? "0" + T_sec : T_sec;
    var txt_m = T_min.toString().length === 1 ? "0" + T_min : T_min;

    // Set time to show to user:
    //$("#sec").text(txt);
    $("#sec").text(txt_s);
    $("#min").text(txt_m);

    // Decrease the bar width:
    var w = (currTime / fullTime) * 100;
    $('.timer-bar').css({ 'width': w + '%' })

    // Manipulate bar according to the value:
    if (currTime >= fullTime) {
        $('.timer-bar').removeClass('timer-almost')
        $('.timer-bar').removeClass('timer-warn')
    }
    if (currTime == warn) $('.timer-bar').addClass('timer-warn')
    if (currTime == almost) $('.timer-bar').addClass('timer-almost')
}, 1000);