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
    include_once($_SERVER["DOCUMENT_ROOT"].'/member/register.php');
    $status=array(1=>'Reserved','Confirming Payment','Payment Confirmed','Arranging Pick Up','Pick Up Arrangment Finished','Transaction Finished');
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



<h2>Transaction</h2>
<h3>Your Order</h3>
<ul>
<?php
defined('DB_SERVER') or define('DB_SERVER', 'localhost');
defined('DB_USERNAME') or define('DB_USERNAME', 'root');
defined('DB_PASSWORD') or define('DB_PASSWORD', '123456');
defined('DB_NAME') or define('DB_NAME', 'project');

$link=mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

$query="select id from member where username='".$_SESSION["username"]."'";
$result=mysqli_query($link,$query);
$row=mysqli_fetch_assoc($result);
$id=$row["id"];
$query="select trans.status, product.mid, product.name, product.price, trans.id from trans inner join product on trans.pid=product.id where trans.buyid=".$id;
$result=mysqli_query($link,$query);
while($row=mysqli_fetch_assoc($result)){
    echo "<li><a>Product Name: ".$row["name"]."</a><br>";
    echo "<a>Price: HK$".$row["price"]."</a><br>";
    $query="select username from member where id=".$row["mid"];
    $result1=mysqli_query($link,$query);
    $row1=mysqli_fetch_assoc($result1);
    $buyusername=$row1["username"];
    echo "<a>Sold by: ".$buyusername.". Message him/her <a href='/member/message.php'>here</a><br>";
    echo "<a>Status: ".$status[$row["status"]];
    if($row["status"]==1){
        echo "   <a href='/product/buy/transaction.php?tid=".$row["id"]."'>Start Payment</a></a><br>";
    }elseif($row["status"]==5){
        echo "   <form action='statusprocess.php' method='POST'><input type='submit' name='pick-up-finish-submit' value='Product Received'>";
        echo "<input type='text' name='pick-up-finish-pid' style='display:none;' value='".$row["id"]."'>";
        echo "</form></a><br>";
    }else{
        echo "</a>";
    }
    
    echo "</li>";
}
?>
</ul>
<h3>Your Item(s) for Sale</h3>
<ul>
<?php
$query="select product.name, product.price, trans.id from trans inner join product on trans.pid=product.id where product.mid=".$id;
$result=mysqli_query($link,$query);
while($row=mysqli_fetch_assoc($result)){
    echo "<li><a>Product Name: ".$row["name"]."</a><br>";
    echo "<a>Price: HK$".$row["price"]."</a><br>";
            $query="select status, buyid from trans where id=".$row["id"];
            $result2=mysqli_query($link,$query);
            $row2=mysqli_fetch_assoc($result2);
            $query="select username from member where id=".$row2["buyid"];
            $result3=mysqli_query($link,$query);
            $row3=mysqli_fetch_assoc($result3);
            echo "<a>Bought by: ".$row3["username"]."</a><br>";
            echo "<a>Status: ".$status[$row2["status"]];
            if($row2["status"]==2){
                echo "  <form action='statusprocess.php' method='POST'><input type='submit' name='confirm-payment-submit' value='Payment Received'>";
                echo "<input type='text' name='confirm-payment-pid' style='display:none;' value='".$row["id"]."'>";
                echo "</form></a><br>";
            }elseif($row2["status"]==4){
                echo "  <form action='statusprocess.php' method='POST'><input type='submit' name='pick-up-submit' value='Pick up coordinated'>";
                echo "<input type='text' name='pick-up-pid' style='display:none;' value='".$row["id"]."'>";
                echo "</form></a><br>";
            }
        }

?>
</ul>
</div>

</div>
<div class="push"></div>


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