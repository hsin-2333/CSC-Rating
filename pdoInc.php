<?php
$db_server = "localhost";
$db_user = "root";
$db_passwd = "";
$db_name = "id19501158_mockrating";
$conn = mysqli_connect($db_server, $db_user, $db_passwd, $db_name);
 
try {
    $dsn = "mysql:host=$db_server;dbname=$db_name";
    $dbh = new PDO($dsn, $db_user, $db_passwd);
}
catch (Exception $e){
    die('無法對資料庫連線');
}
 
$dbh->exec("SET NAMES utf8");
?>