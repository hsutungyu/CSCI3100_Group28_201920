<?php
session_start();
defined('DB_SERVER') or define('DB_SERVER', 'localhost');
defined('DB_USERNAME') or define('DB_USERNAME', 'root');
defined('DB_PASSWORD') or define('DB_PASSWORD', '123456');
defined('DB_NAME') or define('DB_NAME', 'project');
$link=mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);


if(isset($_POST["confirm-payment-submit"])){
    $split=explode(" ",$_POST["confirm-payment-submit"]);
    $pid=$split[count($split)-1];
    $query="update trans set status=4 where pid=".$pid;
    $result=mysqli_query($link,$query);
}elseif(isset($_POST["pick-up-submit"])){
    $split=explode(" ",$_POST["pick-up-submit"]);
    $pid=$split[count($split)-1];
    $query="update trans set status=5 where pid=".$pid;
    $result=mysqli_query($link,$query);
}
?>