<?php

session_start();
defined('DB_SERVER') or define('DB_SERVER', 'localhost');
defined('DB_USERNAME') or define('DB_USERNAME', 'root');
defined('DB_PASSWORD') or define('DB_PASSWORD', '123456');
defined('DB_NAME') or define('DB_NAME', 'project');
$link=mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

$trans1Err='';
$canSubmit=1;
$paymethod=0;
$transfps='';
if(empty($_POST["pay-method"])){
    $trans1Err="Please choose one payment method!";
    $canSubmit=0;
}
if($canSubmit==1){
    if($_POST["pay-method"]==="pay-by-cash"){
        $paymethod=1;
        $query="update trans set paymentmethod=".$paymethod." where id=".$_POST["transaction-id"];
        $result=mysqli_query($link,$query);
        $query="update trans set status=4 where id=".$_POST["transaction-id"];
        $result=mysqli_query($link,$query);
    }
    if($_POST["pay-method"]==="pay-by-fps"){
        $paymethod=2;
        $transfps=$_POST["transaction-fps"];
        $query="update trans set paymentmethod=".$paymethod." where id=".$_POST["transaction-id"];
        $result=mysqli_query($link,$query);
        $query="update trans set status=2 where id=".$_POST["transaction-id"];
        $result=mysqli_query($link,$query);
    }
}
$array=array('canSubmit'=>$canSubmit,'paymethod'=>$paymethod,'trans1Err'=>$trans1Err,'transfps'=>$transfps);
echo json_encode($array);
?>