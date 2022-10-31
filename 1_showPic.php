<?php
session_start();  //登入
include("pdoInc.php");
include('template_class.php');


function getIp(){
    return $_SERVER['REMOTE_ADDR'];
}
<<<<<<< HEAD
//Condition順序
?>  <script type="text/javascript">
       var unique_rand = "<?php echo $_SESSION['arr'][$_GET['id']-1]; ?>";
    </script>
<?php
=======

>>>>>>> 1e9c987d705828fe2e2cb439b5371dfe39aaff10

//$sthBoard = $dbh->prepare('SELECT id, name FROM product WHERE id = ?');
if(isset($_GET['id'])){
    $sthBoard = $dbh->prepare('SELECT id, name FROM product WHERE id = ?');
    $sthBoard->execute(array((int)$_GET['id']));
    
    
    
    if($sthBoard->rowCount() == 1){
        $row_B = $sthBoard->fetch(PDO::FETCH_ASSOC);
        //row['id'] 等於 (int)$_GET['id'] ->商品id
        $productName = $row_B['name'];
   ;

?>  <script type="text/javascript">
       var productName = "<?php echo $row_B['name']; ?>";
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
        const timestamp1 = [dates, seconds].join(" - ");
        console.log("- - Enter Product Page", "- ", timestamp1, "-", productName);
    </script>


            <!--填寫評論(先正後負)-->
            <div class="card-body" >
                <div class="container submit ">
                    <!--form style="container"action="new_index.php" method="post" enctype="multipart/form-data"-->
                    <form style="container" id="StartReview" action="2_viewBoard.php?id=<?php echo (int)$_GET['id'];?>" method="post" enctype="multipart/form-data">                        
                
                        <div class="d-flex justify-content-start  mb-3 ">
                            <!--顯示圖片、商品名稱、評分 -->
                            <div class="p-2">
                            <img src='uploads/product_<?php echo (int)$_GET['id']?>.jpg?' width="250" height="250" class="img-circle" alt="商品圖片">
                            </div>
                            <div class="p-2 b">
                                <h5 class="card-title" style=" font-size:30px;"><strong><?php echo $row_B['name']?></strong> </h5>
                            </div>
                                       
                        </div>
                        <div class="b"><button id="startReview" class="btn btn-outline-primary" onclick="start_timer()" >開始撰寫評論</button></div>     
                                    
                    </form>
                </div>
            </div>

<?php 
        
        $sth = $dbh->prepare('SELECT * from dz_thread WHERE product_id = ? ORDER BY id');
        $sth->execute(array((int)$_GET['id']));
        
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        
        /*確認欄位有無填寫完成
        if(isset($_POST['rating']) && isset($_POST['content'] )){
                if($_POST['rating']=="0" or $_POST['content']=="" or $_POST['content_negative']=="" ){  
                    echo "<script>alert('所有欄位皆須填寫')</script>";
                }
                else{
                    if(isset($_SESSION['account'])){
                        {
                            $sth2 = $dbh->prepare(
                                'INSERT INTO dz_thread (product_id,nickname, account, rating, content,content_negative, ip) VALUES (?,?, ?, ?,?, ?, ?)'
                            );
                            $sth2->execute(array(
                                (int)$_GET['id'],
                                $_SESSION['nickname'],
                                $_SESSION['account'],
                                $_POST['rating'], 
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
        */

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
</style>
