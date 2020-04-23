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
    include_once('member/register.php');
    ?>
<div class="wrapper">
    <div class="navbar">

<ul>
		<li><a class="img" href="index.php"><img src="img/logo.png" alt="Trade2CU logo"></img></a></li>
		<li><a href="product/selling.php">Sell</a></li>
		<li><a href="product/categories.php">Categories</a></li>
        <li>
			<form>
				<input type="text" placeholder="Search.." name="search">
				<button type="submit"><i class="fa fa-search"></i></button>
			</form>
		</li>
            <?php
            if (isset($_SESSION['username'])) {
                echo('<li style="float:right"><a href="member/logout.php">Logout</a></li>');
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
		<li style="float:right;"><a href="product/buy/cart.php" style="padding:1px;padding-right:16px;">Shopping Cart</a></li>
		<li style="float:right;"><img src="../img/cart.png" style="height:16px;padding:5px;"></li>
	</ul>
</div>

<br><br>
<h2>News Feed</h2>
<?php
if(!isset($_SESSION['username'])){
?>

    <p>After logging in, you can view your news feed here.</p>
    <p>This includes new comments on your products, new messages that you receive and many more!</p>

<?php
}else{
    ?>
    <ul class="news-feed-login">
<?php
    $query="select lastlogin, id from member where username='".$_SESSION["username"]."'";
    $result=mysqli_query($link,$query);
    $row=mysqli_fetch_assoc($result);
    $lastlogin=$row["lastlogin"];
    $id=$row["id"];
    $query="select * from message where receiveid=".$id." and time>'".$lastlogin."'";
    $result=mysqli_query($link,$query);
    $count=$result->num_rows;
    if($count==0){
        echo "<li><a>You have no new messages.</a></li>";
    }else{
        echo "<li><a>You have ".$count." new message(s). Click </a><a href='/member/message.php'>here</a> to view them.</a></li>";
    }
?>
    <li><a>Commented</a></li>
    <li><a>Transaction</a></li>
    </ul>
    <?php
}
?>
<?php
if(isset($_SESSION["username"])){
    $query="update member set lastlogin=now() where username='".$_SESSION["username"]."'";
    $result=mysqli_query($link,$query);
}
?>
<br><br><br>
<h2>Product Suggestion</h2>
<p>Season of spring! Your dorm may need a dehumidifier. Here are some products that we think you may need:</p>

<div class="push"></div>

</div>

<div class="navbar">
	<ul>
		<li><a class="img" href="index.php"><img src="img/logo.png" alt="Trade2CU logo"></img></a></li>
		<li><a href="../aboutus/aboutus.php">About Us</a></li>
		<li><a href="../aboutus/faq.php">FAQ</a></li>
	</ul>
</div>

<script src="/member/register.js"></script>
</body>


</html>