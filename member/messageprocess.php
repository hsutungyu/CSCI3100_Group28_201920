<?php
$canSubmit=1;
defined('DB_SERVER') or define('DB_SERVER', 'localhost');
defined('DB_USERNAME') or define('DB_USERNAME', 'root');
defined('DB_PASSWORD') or define('DB_PASSWORD', '123456');
defined('DB_NAME') or define('DB_NAME', 'project');
$link=mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
session_start();
    $query="select id from member where username='".$_POST["message-receive"]."'";
    $result=mysqli_query($link,$query);
    $row=mysqli_fetch_assoc($result);
    $receiveid=$row["id"];
    $query="select id from member where username='".$_SESSION["username"]."'";
    $result=mysqli_query($link,$query);
    $row=mysqli_fetch_assoc($result);
    $sendid=$row["id"];
    $query="insert into message values (null,".$receiveid.",".$sendid.",now(),'".$_POST["message-input"]."',".$_POST["message-pid"].")";
    $result=mysqli_query($link,$query);
?>