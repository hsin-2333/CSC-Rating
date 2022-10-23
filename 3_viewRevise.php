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
//定時跳轉功能
echo '<script type="text/javascript">','window.setInterval("phase2_timer()", 1000);','</script>';

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
            case "4":
            case "5":
            case "7":    
?>
                <!--撰寫評論區(先正後負)-->
                <div class="card-body" >
                
                <div class="container summit ">
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
                                    <textarea id="reviseFirstPositiveTextarea"name="Revise_C" class="form-control" onkeyup="checkLength_P(this);"><?php echo $row['content']; ?></textarea>
                                    <small class="form-text text-muted"><span id="chLeft_P">30</span><span>/30</span></small>
                                </div>
                                <div class="b">
                                    <button id="reviseFirstSubmitPositiveReview" type="button" onclick="moveNextStep(event)">下一步</button>
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
                                    <button id="firstSubmitPositiveReview" type="button" onclick="moveNextStep(event)" >確認</button>
                                </div>
                            
                            </div>
                            <div id="step3" class="content" role="tabpanel">
                                <div class="form-group">
                                    <label>評論(有什麼不滿意的地方嗎)</label>
                                    <textarea id="reviseSecondNegativeTextarea" name="Revise_C_N" class="form-control" onkeyup="checkLength(this);" ><?php echo $row['content_negative'];?></textarea>
                                        <small class="form-text text-muted"><span id="chLeft" >0</span><span>/30</span></small>
                                </div>
                                <div class="b">
                                    <button id="reviseSecondSubmitNegativeReview" type="button" onclick="moveNextStep(event)" >提交</button>
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
                                    <button id="reviseFinalSubmit1" type="submit" onclick="moveNextStep(event)" >確認</button>
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
                
                <div class="container summit ">
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
                                    <textarea id="reviseFirstNegativeTextarea" name="Revise_C_N" class="form-control" onkeyup="checkLength(this);" ><?php echo $row['content_negative'];?></textarea>
                                    <small class="form-text text-muted"><span id="chLeft" >30</span><span>/30</span></small>
                                </div>
                                <div class="b">
                                    <button id="reviseFirstSubmitNegativeReview" type="button" onclick="moveNextStep(event)">下一步</button>
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
                                    <button id="firstSubmitPositiveReview" type="button" onclick="moveNextStep(event)">下一步</button>
                                </div>
                            </div>                            
                            <div id="step3" class="content" role="tabpanel">
                                <div class="form-group">
                                    <label>評論(喜歡這項商品的哪個部分)</label>
                                    <textarea id="reviseSecondPositiveTextarea" name="Revise_C" class="form-control" onkeyup="checkLength_P(this);"  ><?php echo $row['content'];?></textarea>
                                    <small class="form-text text-muted"><span id="chLeft_P">30</span><span>/30</span></small>
                                </div>
                                <div class="b">
                                    <button id="reviseSecondSubmitPositiveReview" type="button" onclick="moveNextStep(event)" >提交</button>
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
                                    <button id="reviseFinalSubmit1" type="submit" onclick="moveNextStep(event)" > 確認</button>
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
            .summit{
                padding : 10px;
                font-size:20px;
                /* border:solid grey 1px; */
                display : flex;
                justify-content: center;
                align-items: center;
                
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
 
 