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
		<li><a class="img" href="/index.php"><img src="/img/logo.png" alt="Trade2CU logo"></img></a></li>
		<li><a href="/product/selling.php">Sell</a></li>
		<li><a href="/product/categories.php">Categories</a></li>
        <li>
        <form  action="/search.php" method="get">
				<input type="text" placeholder="Search.." name="text">
				<button type="submit"><i class="fa fa-search"></i></button>
			</form>
		</li>
            <?php
            if (isset($_SESSION['username'])) {
                echo('<li style="float:right"><a href="/member/logout.php">Logout</a></li>');
				echo('<li style="float:right"><a class="navbar-text" href="/member/information.php">Welcome '.$_SESSION['username'].'!</a></li>'); 
			}
            if (!isset($_SESSION['username'])) {
                ?>
				<li style="float:right">
					<a id="register-modal-button">Register</a>
				</li>
                <li style="float:right">
					<form action="" method="post">
						<label for="username" style="color:#df5a07;position:relative;right:4px;">Username:</label>
						<input type="text" id="username" name="username" style="margin-left:-4.5px;">
						<label for="password" style="color:#df5a07;">Password:</label>
						<input type="password" id="password" name="password">
						<input type="submit" name="login" value="Login">
					</form>
				</li>
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
<div class="navbar">
	<ul>
		<li style="float:right;"><a href="/product/buy/cart.php" style="padding:1px;padding-right:16px;">Shopping Cart</a></li>
		<li style="float:right;"><img src="/img/cart.png" style="height:16px;padding:5px;"></li>
	</ul>
</div>


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
<div class="push"></div>

</div>
<div class="navbar">
	<ul>
		<li><a class="img" href="/index.php"><img src="/img/logo.png" alt="Trade2CU logo"></img></a></li>
		<li><a href="/aboutus/aboutus.php">About Us</a></li>
		<li><a href="/aboutus/faq.php">FAQ</a></li>
	</ul>
</div>
<script src="/member/register.js"></script>
</body>


</html>