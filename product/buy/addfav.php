<?php
session_start();
defined('DB_SERVER') or define('DB_SERVER', 'localhost');
defined('DB_USERNAME') or define('DB_USERNAME', 'root');
defined('DB_PASSWORD') or define('DB_PASSWORD', '123456');
defined('DB_NAME') or define('DB_NAME', 'project');
$link=mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
$fav=0;

$pid=$_POST["fav-pid"];
$query="select id from member where username='".$_SESSION["username"]."'";
$result=mysqli_query($link,$query);
$row=mysqli_fetch_assoc($result);
$id=$row["id"];
$query="select * from myfav where pid=".$pid." and mid=".$id;
$result=mysqli_query($link,$query);
if(mysqli_num_rows($result)==0){
    $query="insert into myfav values(null, ".$pid.",".$id.")";
    $result=mysqli_query($link,$query);
    $fav=1;
}else{
    $query="delete from myfav where pid=".$pid." and mid=".$id;
    $result=mysqli_query($link,$query);
    $fav=0;
}
$array=array('fav'=>$fav);
echo json_encode($array);
?>