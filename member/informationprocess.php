<?php
session_start();
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '123456');
define('DB_NAME', 'project');
$link=mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if(isset($_POST["cancel-listing-submit"])){
    $query="delete from categories where pid=".$_POST["cancel-listing-pid"];
    $result=mysqli_query($link,$query);
    $query="delete from comment where pid=".$_POST["cancel-listing-pid"];
    $result=mysqli_query($link,$query);
    $query="delete from message where pid=".$_POST["cancel-listing-pid"];
    $result=mysqli_query($link,$query);
    $query="delete from myfav where pid=".$_POST["cancel-listing-pid"];
    $result=mysqli_query($link,$query);
    $query="delete from rating where pid=".$_POST["cancel-listing-pid"];
    $result=mysqli_query($link,$query);
    $query="delete from trans where pid=".$_POST["cancel-listing-pid"];
    $result=mysqli_query($link,$query);
    $query="delete from myfav where pid=".$_POST["cancel-listing-pid"];
    $result-mysqli_query($link,$query);
    $query="delete from product where id=".$_POST["cancel-listing-pid"];
    $result=mysqli_query($link,$query);
}
if(isset($_POST["cancel-myfav-submit"])){
    $query="delete from myfav where pid=".$_POST["cancel-myfav-pid"];
    $result=mysqli_query($link,$query);
}


header("Location: information.php");


?>