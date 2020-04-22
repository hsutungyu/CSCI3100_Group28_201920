<!DOCTYPE HTML>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/style-nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Baloo+2&display=swap" rel="stylesheet">
    <title>Trade2CU - Homepage</title>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>

<body>
    <?php
    session_start();
    include_once($_SERVER["DOCUMENT_ROOT"]."/member/register.php");
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
                    <form action="search.php" method="get">
                        <input name='text' type="text" placeholder="Search..">
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
<h2>Your shopping cart</h2>
<ul>
<?php
if(!empty($_POST["cart-pid"])){
    $query="select id from member where username='".$_SESSION["username"]."'";
    $result=mysqli_query($link,$query);
    $row=mysqli_fetch_assoc($result);
    $id=$row["id"];
    $query="select mid from product where id=".$_POST["cart-pid"];
    $result=mysqli_query($link,$query);
    $row=mysqli_fetch_assoc($result);
    $id1=$row["mid"];
    if($id==$id1){
        alert("You cannot buy your own product!");
        echo "<script>window.location='/index.php'</script>";
    }else{
        if(!isset($_SESSION["shopping-cart"])){
            $_SESSION["shopping-cart"]=[];
            array_push($_SESSION["shopping-cart"],$_POST["cart-pid"]);
        }else{
            if(!in_array($_POST["cart-pid"],$_SESSION["shopping-cart"])){
                array_push($_SESSION["shopping-cart"],$_POST["cart-pid"]);
            }
        }
    }
}
if(!empty($_SESSION["shopping-cart"])){
    foreach($_SESSION["shopping-cart"] as &$pid){
        $query="select * from product where id=".$pid;
        $result=mysqli_query($link,$query);
        $row=mysqli_fetch_assoc($result);
        echo "<li style='display:inline-block;width:25%;'><a><img width='100' height='100' src='/img/product/".$row["img"]."'>";
        echo "<h4>".$row["name"]."</h4>";
        echo "<p>HK$".$row["price"]."</p>";
    }
    ?>
    </ul>
    <?php
}else{
    echo "<a>Your shopping cart is empty!</a>";
}
if (!empty($_SESSION["shopping-cart"])) {
    ?>
    <form id="checkout-form" method="POST" action="cartprocess.php">
    <input type="submit" id="checkout-submit" value="Proceed to Checkout">
    </form>
    <form action="clearcart.php" method="POST">
    <input type="submit" value="Clear Shopping Cart">
    </form>
<?php
}
?>
<br><br>
</div>
<footer class="footer">
    <h4 style="text-align:center">Trade2CU</h4>
    <a href="/aboutus/aboutus.php">About Us</a><br>
    <a href="/aboutus/faq.php">FAQ</a><br>
</footer>
<script src="/member/register.js"></script>
</body>


</html>