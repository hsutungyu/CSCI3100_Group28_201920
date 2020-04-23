<?php
session_start();
defined('DB_SERVER') or define('DB_SERVER', 'localhost');
defined('DB_USERNAME') or define('DB_USERNAME', 'root');
defined('DB_PASSWORD') or define('DB_PASSWORD', '123456');
defined('DB_NAME') or define('DB_NAME', 'project');
$link=mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);


if(isset($_POST["confirm-payment-submit"])){
    $query="update trans set status=4 where id=".$_POST["confirm-payment-pid"];
    $result=mysqli_query($link,$query);
    $query="update trans set lastupdate=now() where id=".$_POST["transaction-id"];
    $result=mysqli_query($link,$query);
}elseif(isset($_POST["pick-up-submit"])){
    $query="update trans set status=5 where id=".$_POST["pick-up-pid"];
    $result=mysqli_query($link,$query);
    $query="update trans set lastupdate=now() where id=".$_POST["transaction-id"];
    $result=mysqli_query($link,$query);
}elseif(isset($_POST["pick-up-finish-submit"])){
    $query="update trans set status=6 where id=".$_POST["pick-up-finish-pid"];
    $result=mysqli_query($link,$query);
    $query="update trans set lastupdate=now() where id=".$_POST["transaction-id"];
    $result=mysqli_query($link,$query);
}


header("Location: status.php")

?>