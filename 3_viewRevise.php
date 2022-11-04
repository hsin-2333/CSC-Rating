<?php
session_start();  //登入
include("pdoInc.php");
include('template_class.php');


function getIp(){
    return $_SERVER['REMOTE_ADDR'];
}

echo '<script type="text/javascript">',
    'console.log("- - Enter Product Page", "- ", get_timestamp());',
    '</script>';
 
// echo '<script type="text/javascript">
//     const date = new Date();
//     const year = date.getFullYear();
//     const month = date.getMonth() + 1;
//     const day = date.getDate();
//     const hour = date.getHours();
//     const min = date.getMinutes();
//     const sec = date.getSeconds();
//     const millisec = date.getMilliseconds();
//     const dates = [year, month, day].join("/");
//     const seconds = [hour, min, sec, millisec].join(":");
//     const timestamp = [dates, seconds].join(" - ");
//     console.log("- - Enter Product Page", "- - ", timestamp);
// </script>';

// echo '<script type="text/javascript">',
//      'function start_timer(){   
//         document.getElementById("StartReview").submit();
//         console.log("- Phase2 - Start Review - ", timestamp);
//       };',
//      '</script>'
// ;
// echo '<script type="text/javascript">',
//      'function moveNextStep(event){
//         var timestamp = new Date().toISOString();
//         console.log(timestamp, event.srcElement.id);

//     return stepper.next();
//     };',
//      '</script>'
// ;

//定時跳轉功能
//echo '<script type="text/javascript">','window.setInterval("phase2_timer()", 1000);','</script>';

//Condition順序
?>  <script type="text/javascript">
       var unique_rand = "<?php echo $_SESSION['arr'][$_GET['id']-1]; ?>";
    </script>
<?php

$sthBoard = $dbh->prepare('SELECT * FROM product WHERE id = ?'); //商品編號
if(isset($_GET['id'])){
    $sth = $dbh->prepare('SELECT id FROM dz_thread WHERE id = ? ');
    $sthBoard->execute(array((int)$_GET['id']));

    
    if($sthBoard->rowCount() == 1){
        $row_B = $sthBoard->fetch(PDO::FETCH_ASSOC);

        //取得歷史貼文
        $sth = $dbh->prepare('SELECT * from dz_thread WHERE product_id = ? ORDER BY id DESC');
        $sth->execute(array((int)$_GET['id']));

        while($row = $sth->fetch(PDO::FETCH_ASSOC)){

            switch ($_SESSION['arr'][$_GET['id']-1]) {
            case "1":
            case "2":
            case "3":
            case "4":    
?>
                <!--撰寫評論區(先正後負)-->
                <div class="card-body" >
                
                <div class="container submit ">
                    <form style="container" id="ReviewForm"  method="post" enctype="multipart/form-data">   
                        <div class="d-flex justify-content-start  mb-3 ">
                            <!--顯示圖片、商品名稱、評分 -->
                            <div class="p-2">
                                <img src='uploads/product_<?php echo (int)$_GET['id']?>.jpg?' width="70" height="70" class="img-circle" alt="商品圖片">
                            </div>

                            <div class="p-2">
                                <h5 class="card-title" style=" font-size:30px;"><strong>Product name:<?php echo $row_B['name']?></strong> </h5>
                                <!--h6 class="card-subtitle mb-2 text-muted">
                                    <fieldset class="rating">


                                            <input type="radio" id="rate1" name="newRating" value="1"  <?php if ($row['rating']==1) echo "checked"; ?>>
                                            <label for="rate1">1 star</label>

                                            <input type="radio" id="rate2" name="newRating" value="2"  <?php if ($row['rating']==2) echo "checked"; ?> >
                                            <label for="rate2">2 stars</label>

                                            <input type="radio" id="rate3" name="newRating" value="3"  <?php if ($row['rating']==3) echo "checked"; ?> >
                                            <label for="rate3">3 stars</label>

                                            <input type="radio" id="rate4" name="newRating" value="4"  <?php if ($row['rating']==4) echo "checked"; ?> >
                                            <label for="rate4">4 stars</label>

                                            <input type="radio" id="rate5" name="newRating" value="5"  <?php if ($row['rating']==5) echo "checked"; ?>  >
                                            <label for="rate5">5 stars</label>

                                            <span class="focus-ring"></span>
                                    </fieldset>
                                </h6-->
                            </div>
                            
                        </div>
                            
                         <!--timer -->        
                        <div class="container-timer " id = "contain">
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
                                    <textarea id="reviseFirstPositive" name="Revise_C" class="form-control" onkeydown="getKeydown(event)" onkeyup="checkLength_P(this) ;" onfocus="getElementIdTimestamp(event)"><?php echo $row['content']; ?></textarea>
                                    <div style="float:right;"><small class="form-text text-muted">建議至少30個字</small></div>                                    
                                    <small class="form-text text-muted"><span id="chLeft_P"></span><span>/100</span></small>
                                </div>
                                <div class="b">
                                    <!--button id="reviseFirstSubmitPositiveReview" type="button" onclick="moveNextStep(event)">下一步</button-->
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
                                    <!--button id="firstSubmitPositiveReview" type="button" onclick="moveNextStep(event)" >確認</button-->
                                </div>
                            
                            </div>
                            <div id="step3" class="content" role="tabpanel">
                                <div class="form-group">
                                    <label>評論(有什麼不滿意的地方嗎)</label>
                                    <textarea id="reviseSecondNegative" name="Revise_C_N" class="form-control" onkeydown="getKeydown(event)" onkeyup="checkLength(this);" onfocus="getElementIdTimestamp(event)" ><?php echo $row['content_negative'];?></textarea>
                                    <div style="float:right;"><small class="form-text text-muted">建議至少30個字</small></div>
                                    <small class="form-text text-muted"><span id="chLeft" ></span><span>/100</span></small>
                                </div>
                                <div class="b">
                                    <!--button id="reviseSecondSubmitNegativeReview" type="button" onclick="moveNextStep(event)" >提交</button-->
                                </div>
                            </div>
                            <div id="step4" class="content" role="tabpanel">
                                <div class="alert alert-success text-center">
                                感謝您填寫評論
                                </div>
                                <div>
                                    <small class="form-text text-muted text-center">請稍後 接下來請您填答自評問題</small>
                                </div>
                                <div class="b">
                                    <!--button id="reviseFinalSubmit1" type="submit" onclick="moveNextStep(event)" >確認</button-->
                                </div>
                            
                            </div>
                        </div>
                        </div>
                    
                    </form>
                </div>

            </div>
        
<?php            
                break;
            default:
?>
                <!--撰寫評論區(先負後正)-->
                <div class="card-body" >
                
                <div class="container submit ">
                    <form style="container" id="ReviewForm"  method="post" enctype="multipart/form-data">   
                        <div class="d-flex justify-content-start  mb-3 ">
                            <!--顯示圖片、商品名稱、評分 -->
                            <div class="p-2">
                                <img src='uploads/product_<?php echo (int)$_GET['id']?>.jpg?' width="70" height="70" class="img-circle" alt="商品圖片">
                            </div>

                            <div class="p-2">
                                <h5 class="card-title" style=" font-size:30px;"><strong>Product name:<?php echo $row_B['name']?></strong> </h5>
                                <!--h6 class="card-subtitle mb-2 text-muted">
                                    <fieldset class="rating">

                                            <input type="radio" id="rate1" name="newRating" value="1"  <?php if ($row['rating']==1) echo "checked"; ?>>
                                            <label for="rate1">1 star</label>

                                            <input type="radio" id="rate2" name="newRating" value="2"  <?php if ($row['rating']==2) echo "checked"; ?> >
                                            <label for="rate2">2 stars</label>

                                            <input type="radio" id="rate3" name="newRating" value="3"  <?php if ($row['rating']==3) echo "checked"; ?> >
                                            <label for="rate3">3 stars</label>

                                            <input type="radio" id="rate4" name="newRating" value="4"  <?php if ($row['rating']==4) echo "checked"; ?> >
                                            <label for="rate4">4 stars</label>

                                            <input type="radio" id="rate5" name="newRating" value="5"  <?php if ($row['rating']==5) echo "checked"; ?>  >
                                            <label for="rate5">5 stars</label>

                                            <span class="focus-ring"></span>
                                    </fieldset>
                                </h6-->
                            </div>
                            
                        </div>
                            
                        <!--timer -->        
                        <div class="container-timer " id = "contain">
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
                                    <textarea id="reviseFirstNegative" name="Revise_C_N" class="form-control" onkeydown="getKeydown(event)" onkeyup="checkLength(this);" onfocus="getElementIdTimestamp(event)" ><?php echo $row['content_negative'];?></textarea>
                                    <div style="float:right;"><small class="form-text text-muted">建議至少30個字</small></div>
                                    <small class="form-text text-muted"><span id="chLeft" ></span><span>/100</span></small>
                                </div>
                                <div class="b">
                                    <!--button id="reviseFirstSubmitNegativeReview" type="button" onclick="moveNextStep(event)">下一步</button-->
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
                                    <textarea id="reviseSecondPositive" name="Revise_C" class="form-control" onkeydown="getKeydown(event)" onkeyup="checkLength_P(this);" onfocus="getElementIdTimestamp(event)" ><?php echo $row['content'];?></textarea>
                                    <div style="float:right;"><small class="form-text text-muted">建議至少30個字</small></div>
                                    <small class="form-text text-muted "><span id="chLeft_P"></span><span>/100</span></small>
                                </div>
                                <div class="b">
                                    <!--button id="reviseSecondSubmitPositiveReview" type="button" onclick="moveNextStep(event)" >提交</button-->
                                </div>
                            </div>
                            <div id="step4" class="content" role="tabpanel">
                                <div class="alert alert-success text-center">
                                感謝您填寫評論
                                </div>
                                <div>
                                    <small class="form-text text-muted text-center">接下來請您填答自評問題</small>
                                </div>
                                <div class="b">
                                    <!--button id="reviseFinalSubmit1" type="submit" onclick="moveNextStep(event)" > 確認</button-->
                                </div>
                            
                            </div>
                        </div>
                        </div>
                    
                    </form>
                </div>

            </div>
<?php             
        }      

        }
    

        //確認欄位有無填寫完成
        if(isset($_POST['Revise_C']) && isset($_POST['Revise_C_N']   )){
                if($_POST['Revise_C']=="" or $_POST['Revise_C_N']=="" ){  
                    echo "<script>alert('所有欄位皆須填寫')</script>";
                }
                else{
                    if(isset($_SESSION['account'])){
                        {
                            $sth2 = $dbh->prepare(
                                //'INSERT INTO dz_thread (product_id,nickname, account, rating, content, content_negative, ip) VALUES (?,?, ?, ?,?, ?, ?)'
                                'UPDATE dz_thread SET Revise_C = ?, Revise_C_N = ? WHERE product_id = ? AND account = ? '
                            );
                            $sth2->execute(array(
                                //$_POST['newRating'], 
                                $_POST['Revise_C'],
                                $_POST['Revise_C_N'],
                                (int)$_GET['id'],
                                $_SESSION['account']
                            ));
                        }
                        echo '<meta http-equiv=REFRESH CONTENT=0;url=4_question.php?id='.(int)$_GET['id'].'>';

                    }
                
                    else{
                            echo "<script>alert('登入後才能發表回應')</script>";
                        }
                
        }
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

            /*-- timer css --*/
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
                transition: all 0.0s;
                background: #28c684;
            }
            .timer-warn {
                background: #d0863a;
            }
            .timer-almost {
                background: #d03a49;
            }
            
        </style>

        </body>



        <?php
        
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
            $frameTpl->set('personal','');
            $frameTpl->set('personal.php','personal.php');
            $frameTpl->set('notification','');
            $frameTpl->set('notification.php','notification.php');
            $frameTpl->set('mine','');
            $frameTpl->set('mine.php','mine.php');
            $frameTpl->set('hello_display','none');
        
        }
        else{
            $frameTpl->set('check_login','登出');
            $frameTpl->set('php_guide','0_logout.php');
            $frameTpl->set('personal','帳號資料');
            $frameTpl->set('personal.php','personal.php');
            $frameTpl->set('notification','我的通知');
            $frameTpl->set('notification.php','notification.php');
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
 
<!--insert jquery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js"></script>
<script src="./viewRevise.js"></script>