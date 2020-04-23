<?php
session_start();
defined('DB_SERVER') or define('DB_SERVER', 'localhost');
defined('DB_USERNAME') or define('DB_USERNAME', 'root');
defined('DB_PASSWORD') or define('DB_PASSWORD', '123456');
defined('DB_NAME') or define('DB_NAME', 'project');
$link=mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

$query="select id from member where username='".$_SESSION["username"]."'";
$result=mysqli_query($link,$query);
$row=mysqli_fetch_assoc($result);
$id=$row['id'];

foreach($_SESSION["shopping-cart"] as &$pid){
    $query="insert into trans values (null, ".$pid.",".$id.",now(),1,null,now())";
    $result=mysqli_query($link,$query);
}
unset($_SESSION["shopping-cart"]);
header("Location: status.php");
?>