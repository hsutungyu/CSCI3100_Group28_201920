<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" type="text/css" href="/css/style-nav.css">
<link rel="stylesheet" type="text/css" href="/css/style-info.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Baloo+2&display=swap" rel="stylesheet">
    <title>Trade2CU - User Information</title>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>

<body>
<?php
    session_start();
    include_once('../member/register.php');
    include_once('../member/upload.php');
    include_once('../member/modifyinfo.php');
    ?>
    <div class="container">
    <div class="navbar">

<ul>
        <li><a href="/product/buy/buying.php" class="navbar-text navbar-dropdown1-button">Buying</a>
            <ul class="navbar-dropdown1-content">
                <li><a href="/product/buy/buying.php">Search for Products</a>
                    <a href="/product/categories.php">View Categories</a>
                </li>
            </ul>
        </li>
        <li><a href="/product/selling.php" class="navbar-text">Selling</a></li>
        <li><a href="/index.php" class="navbar-img active"><img src="/img/logo.png" height="60px" align="middle"></a>
        </li>
        <li><a class="navbar-dropdown2-button">Search</a>
            <ul class="navbar-dropdown2-content">
                <li>
                    <form>
                        <input type="text" placeholder="Search..">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </li>
            </ul>
        </li>
            <?php
            if (isset($_SESSION['username'])) {
                echo('<li><a class="navbar-text" href="/member/information.php">Welcome '.$_SESSION['username'].'</a>'); ?>
            <ul class="navbar-dropdown1-content"><li><a href="/member/logout.php" class="navbar-text">Logout</a></li></ul>
            <?php
            }
            if (!isset($_SESSION['username'])) {
                ?>
                <li><a class="navbar-text">Welcome Guest</a>
                <ul class="navbar-login-content"><li><div class="form"><form action="" method="post"><a>Account:</a><input type="text" id="username" name="username"><a>Password:</a><input type="password" id="password" name="password"><input type="submit" name="login" value="Login"></form></div></li></ul>
                <ul class="navbar-dropdown1-content"><li><a id="register-modal-button">Register</a></li></ul></li>
                <?php
            }
            defined('DB_SERVER') or define('DB_SERVER', 'localhost');
            defined('DB_USERNAME') or define('DB_USERNAME', 'root');
            defined('DB_PASSWORD') or define('DB_PASSWORD', '123456');
            defined('DB_NAME') or define('DB_NAME', 'project');

            $link=mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
            function alert($msg){
                echo "<script type='text/javascript'>alert('$msg');</script>";
            }
            if (isset($_POST['login'])) {
                if (!empty($_POST['username'])) {
                    $username=$_POST['username'];
                }
                if (!empty($_POST['password'])){
                    $password=$_POST['password'];
                }
                if (!empty($username)&&!empty($password)) {
                    $password_hashed=password_hash($password, PASSWORD_DEFAULT);
                    $query=mysqli_query($link, "select password from member where username='$username'");
                    if (mysqli_num_rows($query)==1) {
                        if (password_verify($password, mysqli_fetch_array($query)['password'])) {
                            $_SESSION['username']=$username;
                            header("Refresh:0");
                        } else 
                            alert("Username or Password is incorrect!");
                        }
                    }else{
                        alert("Username or Password cannot be empty!");
                    }
            }
            
            ?>
            

    </ul>

</div>
<br><br><br><br><br><br><br><br>
<?php
    if(!isset($_SESSION['username'])){
        echo "<script>alert('Please login before accessing this page!');window.location.href='/index.php';</script>";
    }else{
        $query="SELECT * FROM member where username='".$_SESSION['username']."'";
        $result=mysqli_query($link,$query);
        $row=mysqli_fetch_assoc($result);
        ?>
        <h2 style='text-align:center'>User Information</h2>
        <?php
        if($row['icon']==NULL){
            $icon='/img/member/placeholder.png';
        }else{
            $icon='/img/member/'.$row['icon'];
        }
        echo "<div style='float:left;width:33.33%'><img src='".$icon."' height='100' width='100'></img></div>";
        echo "<div style='float:left;width:33.33%'><a style='text-align:center' class='information-display'>Username: ".$row['username']."</a><br>";
        echo "<a style='text-align:center' class='information-display'>Email: ".$row['email']."</a><br>";
        echo "<a style='text-align:center' class='information-display'>Telephone No.: ".$row['telephone']."</a><br>";
        echo "<a style='text-align:center' class='information-display'>FPS payment method: ".$row["fps"]."<br><br><br></div>";
    }
?>
<div style='float:left;width:33.33%'>
<a id="icon-modal-button">Change Icon</a><br>
<a id="modifyinfo-modal-button">Modify Your Information</a><br>
<a href="/member/message.php">View Your Messages</a><br>
<a href="/product/buy/status.php">View Status of Your Order / Your Items</a>
</div>
<br><br><br><br><br>
<div style='float:left;width:50%;'><h2>Things you are Selling:</h2></div><div style='float:right;'><br><br><a href='/product/selling.php'>Post a new Item!</a></div>
</div>
<div id="selling-display">
<ul class="info-selling-display">
<?php
$query="select id from member where username = '".$_SESSION["username"]."'";
$result=mysqli_query($link,$query);
$row=mysqli_fetch_assoc($result);
$id=$row["id"];
$query="select * from product where mid=".$id;
$result=mysqli_query($link,$query);
if (mysqli_num_rows($result)>0) {
    while ($row=mysqli_fetch_assoc($result)) {
        echo "<li><a><img width='100' height='100' src='../img/product/".$row["img"]."'>";
        echo "<h4>".$row["name"]."</h4>";
        echo "<p>HK$".$row["price"]."</p>";
    }
}else{
    echo "<a>You don't have any products for sale now! Click the link above to post a new item on Trade2CU!";
}
?>
</ul>
</div>
<footer class="footer">
    <h4 style="text-align:center">Trade2CU</h4>
    <a style="text-align:center" href="/aboutus/aboutus.php">About Us</a><br>
    <a style="text-align:center;margin-bottom:10px;" href="/aboutus/faq.php">FAQ</a><br>
</footer>
<script src="/member/register.js"></script>
<script src="/member/upload.js"></script>
<script src="/member/modifyinfo.js"></script>
</body>
</html>