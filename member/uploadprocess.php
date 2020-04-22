<?php
session_start();
defined('DB_SERVER') or define('DB_SERVER', 'localhost');
defined('DB_USERNAME') or define('DB_USERNAME', 'root');
defined('DB_PASSWORD') or define('DB_PASSWORD', '123456');
defined('DB_NAME') or define('DB_NAME', 'project');
$link=mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

$imageErr='';
$target_dir="../img/member/";
$query="select id from member where username='".$_SESSION['username']."'";
$result=mysqli_query($link,$query);
$row=mysqli_fetch_assoc($result);
$id=$row['id'];
$canSubmit=1;
if(empty($_FILES["fileToUpload"]["name"])){
    $canSubmit=0;
    $imageErr="You have not selected a file!";
}
$ext=strtolower(pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION));
$allowedext=array('gif','png','jpg');
if (!in_array($ext,$allowedext)){
    $canSubmit=0;
    $imageErr="Extension of your file is not supported!";
}
if($_FILES["fileToUpload"]["size"]>5242880){
    $canSubmit=0;
    $imageErr="Your file exceeds 5MB!";
}
if($canSubmit==1){
    $target_file=$target_dir.basename($_FILES["fileToUpload"]["name"]);
    $imageFileType=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $randomName=uniqid();
    $target_file=$target_dir.$randomName.'.'.$imageFileType;
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file);
    $query="update member set icon='".$randomName."' where id=".$id;
    $result=mysqli_query($link,$query);
}
$array=array('canSubmit'=>$canSubmit,'imageErr'=>$imageErr);
echo json_encode($array);
?>