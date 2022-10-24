<?php
session_start();  //登入
include("pdoInc.php");
include('template_class.php');


function getIp(){
    return $_SERVER['REMOTE_ADDR'];
}



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
                <div class="container summit ">
                    <!--form style="container"action="new_index.php" method="post" enctype="multipart/form-data"-->          
                    <form style="container" action="2_viewBoard.php?id=<?php echo (int)$_GET['id'];?>" method="post" enctype="multipart/form-data">                        
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
                            <div class="timer-txt">00:00:<span id="sec">00</span></div>
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
                                    <span class="bs-stepper-circle">2</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#step3">
                                    <button type="button" class="step-trigger" role="tab">
                                    <span class="bs-stepper-circle">3</span>
                                    </button>
                                </div>
                            </div>
                            <div class="bs-stepper-content">
                                <div id="step1" class="content" role="tabpanel">
                                    <div class="form-group">
                                        <label>評論(喜歡這項商品的哪個部分)</label>
                                        <textarea name="content" class="form-control" onkeyup="checkLength_P(this);" placeholder="請至少輸入30個字" ></textarea>
                                        <small class="form-text text-muted"><span id="chLeft_P">0</span>/30</small>
                                    </div>
                                    <div class="b">
                                        <button type="button" onclick="stepper.next()">下一步</button>
                                    </div>
                                </div>
                                <div id="step2" class="content" role="tabpanel">
                                    <div class="form-group">
                                        <label>評論(有什麼不滿意的地方嗎)</label>
                                        <textarea name="content_negative" class="form-control" onkeyup="checkLength(this);" placeholder="請至少輸入30個字" ></textarea>
                                        <small class="form-text text-muted"><span id="chLeft" >0</span><span>/30</span></small>
                                    </div>
                                    <div class="b">
                                        <button type="button" onclick="stepper.next()" >提交</button>
                                    </div>
                                </div>
                                <div id="step3" class="content" role="tabpanel">
                                    <div class="alert alert-success">
                                    感謝您填寫評論。接下來即將進入到下一階段
                                    </div>
                                    <div class="b">
<?php
                                    switch ($_SESSION['arr'][$_GET['id']-1]) {
                                        case "3":
                                        case "4":
                                        case "5":
                                        case "8":
?>
                                        <button type="submit" onclick="stepper.next()" >確認</button>
                                        
<?php                                   break;
                                        default:
?>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="button button-primary" data-toggle="modal" data-target="#exampleModalCenter"> 確認</button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <img src='uploads/mark.png' class="rounded float-left" width="28" height="25" alt="exclamation mark">
                                                <h5 class="modal-title" id="exampleModalLongTitle">請誠實作答</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                您有一次修改評論內的機會
                                              </div>
                                              <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary" onclick="stepper.next()">繼續</button>
                                              </div>
                                            </div>
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
                <div class="container summit ">
                    <!--form style="container"action="new_index.php" method="post" enctype="multipart/form-data"-->
                    <form style="container" action="2_viewBoard.php?id=<?php echo (int)$_GET['id'];?>" method="post" enctype="multipart/form-data">                        
                
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
                            <div class="timer-txt">00:00:<span id="sec">00</span></div>
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
                                                        <span class="bs-stepper-circle">2</span>
                                                    </button>
                                                </div>
                                                <div class="line"></div>
                                                <div class="step" data-target="#step3">
                                                    <button type="button" class="step-trigger" role="tab">
                                                        <span class="bs-stepper-circle">3</span>
                                                    </button>
                                                </div>
                                                
                                            </div>
                            <div class="bs-stepper-content">
                                <div id="step1" class="content" role="tabpanel">
                                    <div class="form-group">
                                        <label>評論(有什麼不滿意的地方嗎)</label>
                                        <textarea name="content_negative" class="form-control" onkeyup="checkLength(this);" placeholder="請至少輸入30個字"></textarea>
                                        <small class="form-text text-muted"><span id="chLeft" >0</span><span>/30</span></small>
                                    </div>
                                    <div class="b">
                                        <button type="button" onclick="stepper.next()">下一步</button>
                                    </div>
                                </div>
                                <div id="step2" class="content" role="tabpanel">
                                    <div class="form-group">
                                        <label>評論(喜歡這項商品的哪個部分)</label>
                                        <textarea name="content" class="form-control" onkeyup="checkLength_P(this);" placeholder="請至少輸入30個字"></textarea>
                                        <small class="form-text text-muted"><span id="chLeft_P" >0</span><span>/30</span></small>
                                    </div>
                                    <div class="b">
                                        <button type="button" onclick="stepper.next()" >提交</button>
                                    </div>
                                </div>
                                <div id="step3" class="content" role="tabpanel">
                                    <div class="alert alert-success">
                                    感謝您填寫評論。接下來即將進入到下一階段
                                    </div>
                                    <div class="b">
<?php
                                    switch ($_SESSION['arr'][$_GET['id']-1]) {
                                        case "3":
                                        case "4":
                                        case "5":
                                        case "8":
?>
                                        <button type="submit" onclick="stepper.next()" >確認</button>
                                        
<?php                                   break;
                                        default:
?>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="button button-primary" data-toggle="modal" data-target="#exampleModalCenter"> 確認</button>
                                        c
                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <img src='uploads/mark.png' class="rounded float-left" width="28" height="25" alt="exclamation mark">
                                                <h5 class="modal-title" id="exampleModalLongTitle">請誠實作答</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                您有一次修改評論內的機會
                                              </div>
                                              <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary" onclick="stepper.next()">繼續</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>

                                        <!--loading 15sec -->
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

echo 'arr[0]='.$_SESSION['arr'][0];
echo '<br>';  
echo 'arr[1]='.$_SESSION['arr'][1];
echo 'arr[2]='.$_SESSION['arr'][2];
echo '<br>';  
echo 'arr[3]='.$_SESSION['arr'][3];
echo '<br>';  
echo 'arr[4]='.$_SESSION['arr'][4];
echo '<br>';  
echo 'arr[5]='.$_SESSION['arr'][5];
echo '<br>';  
echo 'arr[6]='.$_SESSION['arr'][6];
echo '<br>';  
echo 'arr[7]='.$_SESSION['arr'][7];
echo '<br>';
echo 'session[arr][id] ]='.$_SESSION['arr'][$_GET['id']-1] ;

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

<style>
  *,
  *:before,
  *:after {
    box-sizing: border-box;
  }

body {
    /* background-color: #222; */
    /* min-height: 100vh; */
    margin: 0px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  .loading {
    flex: 1;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    column-gap: 0.5rem;
    row-gap: 1.5rem;
    margin: 30px;
    z-index: 5;
  }

  /* .loading:after {
    content: "Loading...";
    color: rgb(0, 0, 0);
    flex: 0 100%;
    font: 700 1.3rem "Caveat", cursive;
    text-align: center;
  } */

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
      opacity: 0.8;
      transform: translateY(-3px);
    }
  }
</style>
