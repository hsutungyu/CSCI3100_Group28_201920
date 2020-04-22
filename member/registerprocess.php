<?php
$emailErr=$passwordErr=$usernameErr=$passwordConfirmErr="";
$canSubmit=1;
session_start();
function alert($msg){
    echo "<script text='type/script'>alert('$msg');</script>";
}
if(!empty($_POST["register-account"])){
    $username=$_POST["register-account"];
}else{
    $usernameErr="This field cannot be empty!";
    $canSubmit=0;
}
if(!empty($_POST["register-password"])){
    $password=$_POST["register-password"];
}else{
    $passwordErr="This field cannot be empty!";
    $canSubmit=0;
}
if(!empty($_POST["register-password-confirm"])){
    $passwordConfirm=$_POST["register-password-confirm"];
}else{
    $passwordConfirmErr="This field cannot be empty!";
    $canSubmit=0;
}
if(!empty($_POST["register-email"])){
    $email=$_POST["register-email"];
}else{
    $emailErr="This field cannot be empty!";
    $canSubmit=0;
}

    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '123456');
    define('DB_NAME', 'project');
    $link=mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if(!empty($username)){
        $query_username_duplicate=mysqli_query($link, "select * from member where username='$username'");
        if (mysqli_num_rows($query_username_duplicate)!==0) {
            $usernameErr="Username has been taken!";
            $canSubmit=0;
        }
    }

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
    
    $allowedEmailDomain=["link.cuhk.edu.hk","cuhk.edu.hk"];
    if(filter_var($email,FILTER_VALIDATE_EMAIL)){
        $separatedEmail=explode('@',$email);
        $domainCheck=array_pop($separatedEmail);
        if(!in_array($domainCheck,$allowedEmailDomain)){
            $emailErr="Your email is not from CUHK!";
            $canSubmit=0;
        }
        $query_email_duplicate=mysqli_query($link,"select * from member where email='$email'");
        if(mysqli_num_rows($query_email_duplicate)!==0){
            $emailErr="This email has been registered already!";
            $canSubmit=0;
        }
    }else{
        $emailErr="Invalid email format!";
        $canSubmit=0;
    }

    if ($canSubmit===1) {
        $password_hashed=password_hash($password, PASSWORD_DEFAULT);
        $query_input_data=mysqli_query($link, "insert into member values (null,'$username','$password_hashed','$email',null,null,null,null)");
        echo $link->error;
        $_SESSION['username']=$username;
    }
    $array=array('canSubmit'=>$canSubmit,'emailErr'=>$emailErr,'passwordErr'=>$passwordErr,'passwordConfirmErr'=>$passwordConfirmErr,'usernameErr'=>$usernameErr);
    echo json_encode($array);
?>
