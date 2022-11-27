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
echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';  
echo '商品編號'.$_SESSION['cloth_order'][1].'的condition='.$_SESSION['arr'][$_SESSION['cloth_order'][1]-1];
echo '<br>';  
echo '商品編號'.$_SESSION['cloth_order'][2].'的condition='.$_SESSION['arr'][$_SESSION['cloth_order'][2]-1];
echo '<br>';  
echo '商品編號'.$_SESSION['cloth_order'][3].'的condition='.$_SESSION['arr'][$_SESSION['cloth_order'][3]-1];
echo '<br>';  
echo '商品編號'.$_SESSION['cloth_order'][4].'的condition='.$_SESSION['arr'][$_SESSION['cloth_order'][4]-1];
echo '<br>';  
echo '商品編號'.$_SESSION['cloth_order'][5].'的condition='.$_SESSION['arr'][$_SESSION['cloth_order'][5]-1];
echo '<br>';  
echo '商品編號'.$_SESSION['cloth_order'][6].'的condition='.$_SESSION['arr'][$_SESSION['cloth_order'][6]-1];
echo '<br>';  
echo '商品編號'.$_SESSION['cloth_order'][7].'的condition='.$_SESSION['arr'][$_SESSION['cloth_order'][7]-1];
echo '<br>';  
echo '商品編號'.$_SESSION['cloth_order'][8].'的condition='.$_SESSION['arr'][$_SESSION['cloth_order'][8]-1];
echo '<br>';
echo '練習用的T恤(商品編號'.$_SESSION['cloth_order'][0].'的condition='.$_SESSION['arr'][8];
echo '<br><br><br>';
echo 'Condition是1,2,6,7的商品，需要受試者親自體驗';

?>


 