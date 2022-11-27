<?php
session_start();
include("pdoInc.php");
include('template_class.php');

//生成不重複的隨機數字
function unique_rand($min, $max, $num) {
  $count = 0;
  $return = array();
  while ($count < $num) {
    $return[] = mt_rand($min, $max);
    $return = array_flip(array_flip($return));
    $count = count($return);
  }
  //打乱数组，重新赋予数组新的下标
  shuffle($return);
  return $return;
}

//生成1-8其中一個數字
$arr = unique_rand(1, 8, 8);
//echo implode($arr, ",");
implode(",", $arr); //FIXED: PHP 8.x Error
array_push($arr, 4); //把[練習用的服飾]指定為array[8]，數值固定為4(順序=AC3)-先正評/無體驗/無Popup，加入陣列之中
$_SESSION['arr'] = $arr;

//服裝出現順序
$cloth_order = unique_rand(1, 8, 8);
implode(",", $cloth_order);
array_unshift($cloth_order, 9); //把[練習用的服飾id(9)]放到順序開端
$_SESSION['cloth_order'] = $cloth_order; 
$_SESSION['orderN'] = 0; 

if(isset($_SESSION['account']) && $_SESSION['account'] != null){ 
    // 如果登入過，則直接轉到登入後頁面
    echo '<meta http-equiv=REFRESH CONTENT=0;url=new_index.php>';
}
else if(isset($_POST['account']) && isset($_POST['password'])){
    $acc = preg_replace("/[^A-Za-z0-9]/", "", $_POST['account']);
    $pwd = preg_replace("/[^A-Za-z0-9]/", "", $_POST['password']);
    $nn = preg_replace("/[^A-Za-z0-9]/", "", $_POST['nickname']);
    if($acc != NULL && $pwd != NULL){
        $sth = $dbh->prepare('SELECT * FROM user where account = ?');
        $sth->execute(array($acc));
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        
        // 如果資料庫中沒有這個帳號
        if($row['account'] != $acc ){
            if($_POST['account']!="" && $_POST['password']!="" && $_POST['nickname']!= ""){
            $sth2 =  $dbh->prepare('INSERT INTO user ( account, pwd,nickname, is_admin) VALUES (?, ?, ?, ?)');
            $sth2->execute(array($acc, md5($pwd), $_POST['nickname'], 0));

            $sth3 =  $dbh->prepare('INSERT INTO profileimg (status, account) VALUES (?, ?)');
            $sth3->execute(array(1, $acc));
            
            echo "<script>alert('註冊成功！輸入帳號密碼即可登入！');location.href='".$_SERVER["HTTP_REFERER"]."';</script>"; 
                
            }
            else{
                echo"<script>alert('您尚未註冊過，請完整填寫三項欄位!')</script>";
            }
        }
        // 如果資料庫中有此帳號 & 密碼相同
        else if($row['account'] == $acc && $row['pwd'] == md5($pwd) && $nn == null){
            
            $_SESSION['account'] = $row['account'];
            $_SESSION['nickname'] = $row['nickname'];
            $_SESSION['is_admin'] = $row['is_admin'];
            //$_SESSION['boardID'] = $row['boardID'];
            echo '<meta http-equiv=REFRESH CONTENT=0;url=new_index.php>';
        }
        else if($row['account'] == $acc && $nn != null){
            echo"<script>alert('此帳號已被使用，請更換一個！')</script>";


        }
        // else if($row['account'] == $acc && $row['pwd'] != md5($pwd) && $nn != null){
        //     echo"<script>alert('此帳號已註冊過，請更換一個！')</script>";
            

        // }
        
        else{
            
            echo"<script>alert('密碼錯誤！再試一次！')</script>";
        }
    }
    
    
}

$frameTpl = new template('0_loginPage.htm');
$frameTpl->set('php', basename($_SERVER['PHP_SELF']));
if(!isset($_SESSION['account'])){
    $frameTpl->set('check_login','註冊/登入');
    $frameTpl->set('php_guide','0_login.php');

}
else{
    $frameTpl->set('check_login','登出');
    $frameTpl->set('php_guide','0_logout.php');


}
echo $frameTpl->render();
?>
<style>
html,body{
margin-top:-30px;
background-image: url();
background-color: #f5f5f5;

}

.login_btn{
color: black;
background-color: #FFC312;
width: 130px;
}

.links{
color: grey;
}
.card{
height: 370px;
margin-top: auto;
margin-bottom: auto;
width: 400px;
background-color: rgba(0,0,0,0.5) !important;
}
a{
    font-weight:bold;
}

</style>

 



