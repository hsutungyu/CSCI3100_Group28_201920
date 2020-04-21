<?php
$emailErr=$passwordErr=$telephoneErr=$passwordConfirmErr="";
$password=$passwordConfirm=$email=$telephone="";
$canSubmit=1;
session_start();
function alert($msg){
    echo "<script text='type/script'>alert('$msg');</script>";
}

if (!empty($_POST["modifyinfo-password"])) {
    $password=$_POST["modifyinfo-password"];
}
if(!empty($_POST["modifyinfo-password-confirm"])){
    $passwordConfirm=$_POST["modifyinfo-password-confirm"];
}
if(!empty($_POST["modifyinfo-email"])){
    $email=$_POST["modifyinfo-email"];
}
if(!empty($_POST["modifyinfo-telephone"])){
    $telephone=$_POST["modifyinfo-telephone"];
}

    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '123456');
    define('DB_NAME', 'project');
    $link=mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if (!empty($password)&&!empty($passwordConfirm)) {
        if ($password!==$passwordConfirm) {
            $passwordConfirmErr="Password does not match!";
            $canSubmit=0;
        }
        if (strlen($password)<8){
            $passwordErr="Password must have 8 characters or more!";
        }
        if (!preg_match("#[A-Z]+#",$password)){
            $passwordErr="Password must contain at least one uppercase and one lowercase letter!";
        }
        if (!preg_match("#[a-z]+#",$password)){
            $passwordErr="Password must contain at least one uppercase and one lowercase letter!";
        }
    }
    if (!empty($email)) {
        $allowedEmailDomain=["link.cuhk.edu.hk","cuhk.edu.hk"];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $separatedEmail=explode('@', $email);
            $domainCheck=array_pop($separatedEmail);
            if (!in_array($domainCheck, $allowedEmailDomain)) {
                $emailErr="Your email is not from CUHK!";
                $canSubmit=0;
            }
            $query_email_duplicate=mysqli_query($link, "select * from member where email='$email'");
            if (mysqli_num_rows($query_email_duplicate)!==0) {
                $emailErr="This email has been registered already!";
                $canSubmit=0;
            }
        } else {
            $emailErr="Invalid email format!";
            $canSubmit=0;
        }
    }

    if(!empty($telephone)){
        if(strlen($telephone)!=8){
            $telephoneErr="Please enter a valid HK telephone! (8 digits)";
            $canSubmit=0;
        }
    }
    
    if ($canSubmit===1) {
        if(!empty($password)&&!empty($passwordConfirm)){
            $password_hashed=password_hash($password, PASSWORD_DEFAULT);
            $query="update member set password = '".$password_hashed."' where username='".$_SESSION["username"]."'";
            $query_input_data=mysqli_query($link, $query);
        }
        if(!empty($email)){
            $query="update member set email = '".$email."'where username = '".$_SESSION["username"]."'";
            $query_input_data=mysqli_query($link,$query);
        }
        if(!empty($telephone)){
            $query="update member set telephone ='".$telephone."'where username = '".$_SESSION["username"]."'";
            $query_input_data=mysqli_query($link,$query);
        }
    }
    $array=array('canSubmit'=>$canSubmit,'emailErr'=>$emailErr,'passwordErr'=>$passwordErr,'passwordConfirmErr'=>$passwordConfirmErr,'telephoneErr'=>$telephoneErr);
    echo json_encode($array);
?>
