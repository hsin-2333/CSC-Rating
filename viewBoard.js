var stepperElem = document.querySelector(".bs-stepper");
var stepper = new Stepper(stepperElem);
var done = false;
var currStep = 1;
history.pushState(currStep, "");
//切換到步驟前觸發，呼叫e.preventDefault()可阻止切換
stepperElem.addEventListener("show.bs-stepper", function (e) {
  if (done) {
    //若程序完成，不再切換
    e.preventDefault();
    return;
  }
});
//切換到步驟後觸發，e.detail.indexStep為目前步驟序號(從0開始)
stepperElem.addEventListener("shown.bs-stepper", function (e) {
  var idx = e.detail.indexStep + 1;
  currStep = idx;
  //pushState()記下歷程以支援瀏覽器回上頁功能
  history.pushState(idx, "");
});
//瀏覽器上一頁下一頁觸發
window.onpopstate = function (e) {
  if (e.state && e.state != currStep) stepper.to(e.state);
};
//模擬送出表單，註記已完成，不再允許切換步驟
function simulateSubmit() {
  stepper.next();
  done = true;
}

//Timestamp
function getTimestamp(){
    const date = new Date();
    const year = date.getFullYear();
    const month = date.getMonth() + 1;
    const day = date.getDate();
    const hour = date.getHours();
    const min = date.getMinutes();
    const sec = date.getSeconds();
    const millisec = date.getMilliseconds();

    const dates = [year, month, day].join("/");
    const seconds = [hour, min, sec, millisec].join(":");
    const timestamp = [dates, seconds].join(" - ");
    return timestamp;
}

// 3min Timer
var fullTime = 90; // 1.5分鐘
var warn = 5; // 20
var almost = 1; // 10

var currTime = fullTime;
var timer_positive =0;
var timestamp = getTimestamp();
var unixTime = Date.now();

var timer = setInterval(function () {
    --currTime;
    // Clear interval if time is up:
    if (currTime < 0) {
        ++ timer_positive;
        switch(timer_positive){
            case 1:
                console.log("- Phase1 - Enter 「Thanks for completion」 Page (First Review)-", unixTime, '-', timestamp,'- -', condition);
                break;
            case 2:
              console.log("- Phase1 - Enter 「Thanks for completion」 Page (Second Review)-", unixTime, '-', timestamp,'- -', condition);
                break;    
        }
        stepper.next();    
        currTime = fullTime + 3;
        //window.clearInterval(timer);
    }
    if (currTime == fullTime){

        switch(timer_positive){
            case 1:
                console.log("- Phase1 - Enter Review Page (Second Review) -", unixTime, "-", timestamp, "- -", condition);
                break;
            case 2:
                window.clearInterval(timer);
                break;    
        }
        stepper.next();
    }
    if (currTime <= fullTime){  
        document.getElementById("contain").style.visibility = "visible";
        
    }
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