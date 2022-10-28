<?php
session_start();  //登入
include("pdoInc.php");
include('template_class.php');


function getIp(){
    return $_SERVER['REMOTE_ADDR'];
}

echo '<script type="text/javascript">',
     'function moveNextStep(event){
        var timestamp = new Date().toISOString();
        console.log(timestamp, event.srcElement.id);

    return stepper.next();
    };',
     '</script>'
;

////定時跳轉功能
echo '<script type="text/javascript">','window.setInterval("phase1_timer()", 1000);','</script>';

//$sthBoard = $dbh->prepare('SELECT id, name FROM product WHERE id = ?');
if(isset($_GET['id'])){
    $sthBoard = $dbh->prepare('SELECT id, name FROM product WHERE id = ?');
    $sthBoard->execute(array((int)$_GET['id']));
    
    
    
    if($sthBoard->rowCount() == 1){
        $row_B = $sthBoard->fetch(PDO::FETCH_ASSOC);
        //row['id'] 等於 (int)$_GET['id'] ->商品id
        
        switch ($_SESSION['arr'][$_GET['id']-1]) {
        case "1":
        case "2":
        case "3":
        case "4":    
?>
            <!--填寫評論(先正後負)-->
            <div class="card-body" >
                <div class="container submit ">
                    <!--form style="container"action="new_index.php" method="post" enctype="multipart/form-data"-->          
                    <form style="container" id="ReviewForm" action="2_viewBoard.php?id=<?php echo (int)$_GET['id'];?>" method="post" enctype="multipart/form-data">                        
                        <div class="d-flex justify-content-start  mb-3 ">
                            <!--顯示圖片、商品名稱、評分 -->
                            <div class="p-2">
                            <img src='uploads/product_<?php echo (int)$_GET['id']?>.jpg?' width="70" height="70" class="img-circle" alt="商品圖片">
                            </div>
                            <div class="p-2">
                                <h5 class="card-title" style=" font-size:30px;"><strong>Product name: <?php echo $row_B['name']?></strong> </h5>
                                <!--h6 class="card-subtitle mb-2 text-muted">                                    <fieldset class="rating">
                                                            <input type="radio" id="no-rate" class="input-no-rate" name="rating" value="0" checked="" aria-label="No rating.">
                
                                                            <input type="radio" id="rate1" name="rating" value="1">
                                                            <label for="rate1">1 star</label>
                
                                                            <input type="radio" id="rate2" name="rating" value="2">
                                                            <label for="rate2">2 stars</label>
                
                                                            <input type="radio" id="rate3" name="rating" value="3">
                                                            <label for="rate3">3 stars</label>
                
                                                            <input type="radio" id="rate4" name="rating" value="4">
                                                            <label for="rate4">4 stars</label>
                
                                                            <input type="radio" id="rate5" name="rating" value="5">
                                                            <label for="rate5">5 stars</label>
                
                                                            <span class="focus-ring"></span>
                                                    </fieldset>
                                </h6-->
                            </div>
                                            
                        </div>
                         <!--timer -->        
                         <div class="container-timer ">
                        <div class="timer-wrapper">
                            <div class="timer-bar"></div>
                            <div class="timer-txt">00:<span id="min">03</span>:<span id="sec">00</span></div>
                        </div>
                        </div>
                        <!-- Stepper -->        
                        <div class="bs-stepper">
                            <div class="bs-stepper-header" role="tablist">
                                <div class="step" data-target="#step1">
                                    <button type="button" class="step-trigger" role="tab">
                                    <span class="bs-stepper-circle">1</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#step2">
                                    <button type="button" class="step-trigger" role="tab">
                                    <!--span class="bs-stepper-circle">2-Loading page:提示訊息</span-->
                                    </button>
                                </div>
                                <!--div class="line"></div-->
                                <div class="step" data-target="#step3">
                                    <button type="button" class="step-trigger" role="tab">
                                    <span class="bs-stepper-circle">2</span>
                                    </button>
                                </div>
                                <div class="step" data-target="#step4">
                                    <button type="button" class="step-trigger" role="tab">
                                    <!--span class="bs-stepper-circle">4-Loading page:提示訊息</span-->
                                    </button>
                                </div>
                            </div>
                            <div class="bs-stepper-content">
                                <div id="step1" class="content" role="tabpanel">
                                    <div class="form-group">
                                        <label>評論(喜歡這項商品的哪個部分)</label>
                                        <textarea id="firstPositiveTextarea" name="content" class="form-control" onkeydown="getKeydown(event)" onkeyup="checkLength_P(this);" onfocus="getElementIdTimestamp(event)" placeholder="我覺得......" ></textarea>
                                        <div style="float:right;"><small class="form-text text-muted">建議至少30個字</small></div>
                                        <small class="form-text text-muted"><span id="chLeft_P">0</span>/100</small>
                                    </div>
                                    <div class="b">
                                        <!--button id="firstSubmitPositiveReview" type="button" onclick="moveNextStep(event)">下一步</button-->
                                    </div>
                                </div>
                                <div id="step2" class="content" role="tabpanel">
                                    <div class="alert alert-success text-center">
                                    感謝您填寫評論
                                    </div>
                                    <div>
                                        <small class="form-text text-muted text-center">請稍後 接下來即將進入到下一階段</small>
                                    </div>
                                    <div class="b">
                                        <!--button id="firstSubmitPositiveReview" type="button" onclick="moveNextStep(event)">下一步</button-->
                                    </div>
                                </div>
                                <div id="step3" class="content" role="tabpanel">
                                    <div class="form-group">
                                        <label>評論(有什麼不滿意的地方嗎)</label>
                                        <textarea id="secondNegativeTextarea" name="content_negative" class="form-control" onkeydown="getKeydown(event)" onkeyup="checkLength(this);" onfocus="getElementIdTimestamp(event)" placeholder="我覺得......" ></textarea>
                                        <div style="float:right;"><small class="form-text text-muted">建議至少30個字</small></div>
                                        <small class="form-text text-muted"><span id="chLeft" >0</span><span>/100</span></small>
                                    </div>
                                    <div class="b">
                                        <!--button id="submitNegativeReview"type="button" onclick="moveNextStep(event)" >提交</button-->
                                    </div>
                                </div>
                                
                                <div id="step4" class="content" role="tabpanel">
                                    <div class="alert alert-success text-center">
                                    感謝您填寫評論
                                    </div>
                                    <div>
                                        <small class="form-text text-muted text-center">請稍後 接下來即將進入到下一階段</small>
                                    </div>
                                    <div class="b">
<?php
                                    switch ($_SESSION['arr'][$_GET['id']-1]) {
                                        case "3":
                                        case "4":
                                        case "5":
                                        case "8":
?>
                                        <!-- Pop up LOADING-->
                                        <script type="text/javascript">
                                            window.setTimeout("stepFour()",16000); //結束提醒3秒後，出現Loading 畫面
                                        </script>

                                        <div id="loader" class="overlay" style="display:none">
                                            <div id=loaderItems>
                                                <div class="loading" id="loadBar">
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                </div>
                                                <div class="t-txt" id="loadtxt">
                                                    請稍等<span id="div1">15</span>秒，即將進入下一頁...
                                                </div> 
                                            </div>
                                        </div>



<?php                                   break;
                                        default:                                        
?>
                                        <!-- Button trigger modal >
                                        <button id= "confirmationSubmit2" type="button" class="button button-primary" data-toggle="modal" data-target="#exampleModalCenter" onclick="getElementIdTimestamp(event)"> 確認</button-->
                                        <!--第16秒出現 Pop up MSG-->
                                        <script type="text/javascript">window.setTimeout("myModal.show()",16000);</script>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <img src='uploads/mark.png' class="rounded float-left" width="28" height="25" alt="exclamation mark">
                                                <h5 class="modal-title text-danger" id="exampleModalLongTitle">上述所言是否是來自您實際的體驗</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body text-muted"><br>
                                                <small class="text-muted">頁面將會自動跳回已寫的評論 您有一次修改評論內的機會</small>
                                              </div><br>
                                              <div class="modal-footer">
                                                <button id="secondChanceConfirmation" type="button" class="btn btn-primary" onclick="stepFour_PopUp()">繼續</button>
                                              </div>
                                            </div>
                                          </div>

                                        </div>
                                        
                                        <!--Pop up LOADING-->
                                        <div id="loader" class="overlay" style="display:none">
                                            <div class="loading" id="loadBar">
                                                        <div></div>
                                                        <div></div>
                                                        <div></div>
                                                        <div></div>
                                                        <div></div>
                                            </div>
                                            <div class="t-txt" id="loadtxt">
                                                請稍等<span id="div1">00</span>秒，即將進入下一頁...
                                            </div> 
                                        </div>
<?php 
                                    }
?>
                                    </div>
                                </div>
                            </div>
       
                        </div>
                                    
                    </form>
                </div>
            </div>
<?php       break;
        default:
?>
            <!--填寫評論(先負後正)-->
            <div class="card-body" >
                <div class="container submit ">
                    <form style="container" id="ReviewForm" action="2_viewBoard.php?id=<?php echo (int)$_GET['id'];?>" method="post" enctype="multipart/form-data">                        
                
                        <div class="d-flex justify-content-start  mb-3 ">
                                            <!--顯示圖片、商品名稱、評分 -->
                                            <div class="p-2">
                                                <img src='uploads/product_<?php echo (int)$_GET['id']?>.jpg?' width="70" height="70" class="img-circle" alt="商品圖片">
                                            </div>
                
                                            <div class="p-2">
                                                <h5 class="card-title" style=" font-size:30px;"><strong>Product name: <?php echo $row_B['name']?></strong> </h5>
                                                <!--h6 class="card-subtitle mb-2 text-muted">
                                                    <fieldset class="rating">
                                                            <input type="radio" id="no-rate" class="input-no-rate" name="rating" value="0" checked="" aria-label="No rating.">
                
                                                            <input type="radio" id="rate1" name="rating" value="1">
                                                            <label for="rate1">1 star</label>
                
                                                            <input type="radio" id="rate2" name="rating" value="2">
                                                            <label for="rate2">2 stars</label>
                
                                                            <input type="radio" id="rate3" name="rating" value="3">
                                                            <label for="rate3">3 stars</label>
                
                                                            <input type="radio" id="rate4" name="rating" value="4">
                                                            <label for="rate4">4 stars</label>
                
                                                            <input type="radio" id="rate5" name="rating" value="5">
                                                            <label for="rate5">5 stars</label>
                
                                                            <span class="focus-ring"></span>
                                                    </fieldset>
                                                </h6-->
                                            </div>
                                            
                                        </div>
                        <!--timer -->        
                        <div class="container-timer ">
                        <div class="timer-wrapper">
                            <div class="timer-bar"></div>
                            <div class="timer-txt">00:<span id="min">03</span>:<span id="sec">00</span></div>
                        </div>
                        </div>
                        <!-- Stepper -->        
                        <div class="bs-stepper">
                            <div class="bs-stepper-header" role="tablist">
                                <div class="step" data-target="#step1">
                                    <button type="button" class="step-trigger" role="tab">
                                    <span class="bs-stepper-circle">1</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#step2">
                                    <button type="button" class="step-trigger" role="tab">
                                    <!--span class="bs-stepper-circle">2-Loading page:提示訊息</span-->
                                    </button>
                                </div>
                                <!--div class="line"></div-->
                                <div class="step" data-target="#step3">
                                    <button type="button" class="step-trigger" role="tab">
                                    <span class="bs-stepper-circle">2</span>
                                    </button>
                                </div>
                                <div class="step" data-target="#step4">
                                    <button type="button" class="step-trigger" role="tab">
                                    <!--span class="bs-stepper-circle">4-Loading page:提示訊息</span-->
                                    </button>
                                </div>
                            </div>
                            <div class="bs-stepper-content">
                                <div id="step1" class="content" role="tabpanel">
                                    <div class="form-group">
                                        <label>評論(有什麼不滿意的地方嗎)</label>
                                        <textarea id="firstNegativeTextarea" name="content_negative" class="form-control" onkeydown="getKeydown(event)" onkeyup="checkLength(this);" onfocus="getElementIdTimestamp(event)" placeholder="我覺得......"></textarea>
                                        <div style="float:right;"><small class="form-text text-muted">建議至少30個字</small></div>
                                        <small class="form-text text-muted"><span id="chLeft" >0</span><span>/100</span></small>
                                    </div>
                                    <div class="b">
                                        <!--button id="firstSubmitNegativeReview" type="button" onclick="moveNextStep(event)">下一步</button-->
                                    </div>
                                </div>
                                <div id="step2" class="content" role="tabpanel">
                                    <div class="alert alert-success text-center">
                                    感謝您填寫評論
                                    </div>
                                    <div>
                                        <small class="form-text text-muted text-center">請稍後 接下來即將進入到下一階段</small>
                                    </div>
                                    <div class="b">
                                        <!--button id="firstSubmitPositiveReview" type="button" onclick="moveNextStep(event)">下一步</button-->
                                    </div>
                                </div>
                                <div id="step3" class="content" role="tabpanel">
                                    <div class="form-group">
                                        <label>評論(喜歡這項商品的哪個部分)</label>
                                        <textarea id="secondPositiveTextarea" name="content" class="form-control" onkeydown="getKeydown(event)" onkeyup="checkLength_P(this);" onfocus="getElementIdTimestamp(event)" placeholder="我覺得......"></textarea>
                                        <div style="float:right;"><small class="form-text text-muted">建議至少30個字</small></div>
                                        <small class="form-text text-muted "><span id="chLeft_P" >0</span><span>/100</span></small>
                                    </div>
                                    <div class="b">
                                        <!--button id="secondSubmitPositiveReview"type="button" onclick="moveNextStep(event)" >提交</button-->
                                    </div>
                                </div>
                                <div id="step4" class="content" role="tabpanel">
                                    <div class="alert alert-success text-center">感謝您填寫評論</div>
                                    <div>
                                        <small class="form-text text-muted text-center">請稍後 接下來即將進入到下一階段</small>
                                    </div>
                                    <div class="b">
<?php
                                    switch ($_SESSION['arr'][$_GET['id']-1]) {
                                        case "3":
                                        case "4":
                                        case "5":
                                        case "8":
?>
                                        <!-- Pop up LOADING-->
                                        <script type="text/javascript">
                                            window.setTimeout("stepFour()",16000); //結束提醒3秒後，秀出Loading 畫面
                                        </script>

                                        <div id="loader" class="overlay" style="display:none">
                                            <div id=loaderItems>
                                                <div class="loading" id="loadBar">
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                </div>
                                                <div class="t-txt" id="loadtxt">
                                                    請稍等<span id="div1">15</span>秒，即將進入下一頁...
                                                </div> 
                                            </div>
                                        </div>
                                        <!--button id="xxxx" type="submit" onclick="moveNextStep(event)" >確認</button-->
                                        
<?php                                   break;
                                        default:
?>
                                        <!-- Button trigger modal -->
                                        <!--button id="confirmationSubmit1" type="button" class="button button-primary" data-toggle="modal" data-target="#exampleModalCenter" onclick="getElementIdTimestamp(event)"> 確認</button-->
                                        
                                        <!--第16秒出現 Pop up MSG-->
                                        <script type="text/javascript">window.setTimeout("myModal.show()",16000);</script>                                         
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <img src='uploads/mark.png' class="rounded float-left" width="28" height="25" alt="exclamation mark">
                                                <h5 class="modal-title text-danger" id="exampleModalLongTitle">上述所言是否來自您實際的體驗</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                <small class="text-muted">頁面將會自動跳回已寫的評論 您有一次修改評論內的機會</small>
                                              </div>
                                              <div class="modal-footer">
                                                <button id="confirmationSubmit1"type="button" class="btn btn-primary" onclick="stepFour_PopUp()">繼續</button>
                                              </div>
                                            </div>
                                          </div>

                                        </div>

                                        <!--Pop up LOADING-->
                                        <div id="loader" class="overlay" style="display:none">
                                            <div class="loading" id="loadBar">
                                                        <div></div>
                                                        <div></div>
                                                        <div></div>
                                                        <div></div>
                                                        <div></div>
                                            </div>
                                            <div class="t-txt" id="loadtxt">
                                                請稍等<span id="div1">00</span>秒，即將進入下一頁...
                                            </div> 
                                        </div>
<?php 
                                    }
?>
                                    </div>
                            </div>
                            </div>
       
                        </div>
                                    
                    </form>
                </div>
            </div>
<?php 
        }


        $sth = $dbh->prepare('SELECT * from dz_thread WHERE product_id = ? ORDER BY id');
        $sth->execute(array((int)$_GET['id']));
        
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        
        //確認欄位有無填寫完成
        if(isset($_POST['content_negative']) && isset($_POST['content'] )){
                if($_POST['content']=="" or $_POST['content_negative']=="" ){  
                    echo "<script>alert('所有欄位皆須填寫')</script>";
                }
                else{
                    if(isset($_SESSION['account'])){
                        {
                            $sth2 = $dbh->prepare(
                                'INSERT INTO dz_thread (product_id,nickname, account, content,content_negative, ip) VALUES (?, ?, ?, ?, ?, ?)'
                            );
                            $sth2->execute(array(
                                (int)$_GET['id'],
                                $_SESSION['nickname'],
                                $_SESSION['account'],
                                //$_POST['rating'], 
                                $_POST['content'],
                                $_POST['content_negative'],
                                $_SERVER['REMOTE_ADDR'],
                            ));
                            
                        }
                        
                        echo '<meta http-equiv=REFRESH CONTENT=0;url=3_viewRevise.php?id='.$row['product_id'].'>';

                    }
                
        else{
                echo "<script>alert('登入後才能發表回應')</script>";
            }
                
        }
                
        }


        $frameTpl = new template('rating_page.htm');
        $frameTpl->set('php', basename($_SERVER['PHP_SELF']));
        if ( isset($msgs)){
            $frameTpl->set('messages', join("\n", $msgs));

        }
        else{
        $frameTpl->set('messages', '');
        }
        

        //對應main.html模板中的navbar
        if(!isset($_SESSION['account'])){
            $frameTpl->set('check_login','註冊/登入');
            $frameTpl->set('php_guide','0_login.php');
            $frameTpl->set('mine','');
            $frameTpl->set('mine.php','mine.php');
            $frameTpl->set('hello_display','none');
        
        }
        else{
            $frameTpl->set('check_login','登出');
            $frameTpl->set('php_guide','0_logout.php');
            $frameTpl->set('mine','我的發表');
            $frameTpl->set('mine.php','mine.php');
            $frameTpl->set('hello_display','display');
            $frameTpl->set('username', $_SESSION['nickname']);
        
        }
        
    
        echo $frameTpl->render();

        

    }
    else {
        echo '看板不存在';
    }
}
else {
    echo '未指定看板';
}


?>


<style>
            .t{
                font-size:25px;
                width:450px;
                display : flex;
                justify-content: center;
                align-items: center;
                padding : 15px;
                margin-top:0px;
                margin-right:auto;
                margin-left:auto;

            }
            select{
                width:460px;
            }
            textarea{
                width:500px;
            }
            input{
                width:500px;
            }
            .b{
                width:200px;
                display : flex;
                justify-content: center;
                align-items: center;
                padding : 15px;
                margin-right:auto;
                margin-left:auto;

            }
            .submit{
                padding : 10px;
                font-size:20px;
                /* border:solid grey 1px; */
                display : flex;
                justify-content: center;
                align-items: center;
                
            }
            .align-right{
                text-align: right;
            }
</style>

<!-- timer css -->
<style>
  .container-timer {
    position: relative;
    max-width: 100px;
    height: 20px;
    background: #f5f5f5;
    margin: 5px auto;
  } 
  .timer-wrapper {
    height: 20px;
    line-height: 20px;
    background: #000;
    position: relative;
    margin-top: 0px;
  }
  .timer-txt {
    width: 100%;
    margin: 0;
    color: #fff;
    text-align: center;
    position: absolute;
    top: 0;
    left: 0;
  }
  .timer-bar {
    width: 100%;
    height: 20px;
    position: absolute;
    top: 0;
    left: 0;
    transition: all 0.3s;
    background: #28c684;
  }
  .timer-warn {
    background: #d0863a;
  }
  .timer-almost {
    background: #d03a49;
  }
  
</style>

 <!--insert jquery-->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js"></script>
 <!-- timer JS-->
 <script>
      var fullTime = 180;
      var warn = 20;
      var almost = 10;

      var currTime = fullTime;

      var timer = setInterval(function () {
        --currTime;

        // Clear interval if time is up:
        if (!currTime) window.clearInterval(timer);

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
        $(".timer-bar").css({ width: w + "%" });

        // Manipulate bar according to the value:
        if (currTime === warn) $(".timer-bar").addClass("timer-warn");
        if (currTime === almost) $(".timer-bar").addClass("timer-almost");
      }, 1000);
</script>

<style>
  .overlay{
    opacity:1.0;
    margin: auto;
    background-color:#ccc;
    position:fixed;
    width:100%;
    height:100%;
    top:0px;
    left:0px;
    z-index:1000;
}
  .loading {
    flex: 1;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    column-gap: 0.5rem;
    row-gap: 1.5rem;
    margin: 30px;

  }

  #loaderItems {
    width:100%;
    height:100%;
  }
  
  div#loadBar{
    justify-content: center;
    align-items: flex-end;
    width: 100%;
    height: 50%;
  }

  div#loadtxt {
    width: 100%;
    justify-content: center;
    display: flex;
  }

  .loading div {
    background-color: rgb(0, 0, 0);
    border-radius: 50%;
    width: 20px;
    height: 20px;
    animation: loading-effect 1s cubic-bezier(0.77, 0.8, 0.58, 1) infinite
      var(--delay, 0.2s) alternate-reverse;
  }

  .loading div:nth-child(2) {
    --delay: 0.4s;
  }
  .loading div:nth-child(3) {
    --delay: 0.6s;
  }
  .loading div:nth-child(4) {
    --delay: 0.8s;
  }
  .loading div:nth-child(5) {
    --delay: 1s;
  }

  @keyframes loading-effect {
    0% {
      box-shadow: 0 0 4px 1px rgba(199, 199, 199, 0.2);
      opacity: 0.2;
      transform: translateY(3px) scale(1.1);
    }

    100% {
      opacity: 1.0;
      transform: translateY(-3px);
    }
  }
</style>