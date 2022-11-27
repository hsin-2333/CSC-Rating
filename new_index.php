<?php
session_start();  //登入
include("pdoInc.php");
include('template_class.php');

function getIp(){
    return $_SERVER['REMOTE_ADDR'];
}

?>

<link rel="stylesheet" href="bootstrap.css">






<!--  導覽列-->

<?php

$frameTpl = new template('main.htm');
$frameTpl->set('php', basename($_SERVER['PHP_SELF']));

if(!isset($_SESSION['account'])){
    $frameTpl->set('check_login','註冊/登入');
    $frameTpl->set('php_guide','0_login.php');
    $frameTpl->set('personal','');
    $frameTpl->set('personal.php','personal.php');

}
else{
    $frameTpl->set('check_login','登出');
    $frameTpl->set('php_guide','0_logout.php');
    $frameTpl->set('personal','帳號資料');
    $frameTpl->set('personal.php','personal.php');
    $frameTpl->set('username', $_SESSION['nickname']);

}
/*
//關鍵字分類

$sth = $dbh->query('SELECT * from product ORDER BY id');
while($row = $sth->fetch(PDO::FETCH_ASSOC)){

    $keywordsTpl = new template('keyword.htm');
    $keywordsTpl->set('keyword','<li class="nav-item"><a href="1_showPic.php?id='.$row['id'].'">'.$row['name'].'</a></li>');
    $keywords[] = $keywordsTpl->render();

}
$frameTpl->set('keywords', join("\n", $keywords));


*/

echo $frameTpl->render();
echo '<br><br><br><br><br><br><br><br><br><br><br><br><br>';  
echo '順序1(商品編號'.$_SESSION['cloth_order'][1].'的condition='.$_SESSION['arr'][0];
echo '<br>';  
echo '順序2(商品編號'.$_SESSION['cloth_order'][2].'的condition='.$_SESSION['arr'][1];
echo '<br>';  
echo '順序3(商品編號'.$_SESSION['cloth_order'][3].'的condition='.$_SESSION['arr'][2];
echo '<br>';  
echo '順序4(商品編號'.$_SESSION['cloth_order'][4].'的condition='.$_SESSION['arr'][3];
echo '<br>';  
echo '順序5(商品編號'.$_SESSION['cloth_order'][5].'的condition='.$_SESSION['arr'][4];
echo '<br>';  
echo '順序6(商品編號'.$_SESSION['cloth_order'][6].'的condition='.$_SESSION['arr'][5];
echo '<br>';  
echo '順序7(商品編號'.$_SESSION['cloth_order'][7].'的condition='.$_SESSION['arr'][6];
echo '<br>';  
echo '順序8(商品編號'.$_SESSION['cloth_order'][8].'的condition='.$_SESSION['arr'][7];
echo '<br>';
echo '順序0-練習用的T恤(商品編號'.$_SESSION['cloth_order'][0].'的condition='.$_SESSION['arr'][8];
echo '<br>';
?>


 