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
    <div class="wrapper">
    <div class="navbar">

<ul>
		<li><a class="img" href="../index.php"><img src="../img/logo.png" alt="Trade2CU logo"></img></a></li>
		<li><a href="../product/selling.php">Sell</a></li>
		<li><a href="../product/categories.php">Categories</a></li>
        <li>
			<form>
				<input type="text" placeholder="Search.." name="search">
				<button type="submit"><i class="fa fa-search"></i></button>
			</form>
		</li>
            <?php
            if (isset($_SESSION['username'])) {
                echo('<li style="float:right"><a href="../member/logout.php">Logout</a></li>');
				echo('<li style="float:right"><a class="navbar-text" href="../member/information.php">Welcome '.$_SESSION['username'].'!</a></li>'); 
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
<br><br>
<?php
    if(!isset($_SESSION['username'])){
        echo "<script>alert('Please login before accessing this page!');window.location.href='/index.php';</script>";
    }else{
        $query="SELECT * FROM member where username='".$_SESSION['username']."'";
        $result=mysqli_query($link,$query);
        $row=mysqli_fetch_assoc($result);
        if($row['icon']==NULL){
            $icon='/img/member/placeholder.png';
        }else{
            $icon='/img/member/'.$row['icon'];
        }
        echo "<img src='".$icon."' style='height:160px;width:160px;' align='left'></img>";
        echo '<h2 style="position:relative;left:50px;margin-bottom:-10px;margin-top:0px;">'.$row['username'].'</h2>';
        echo '<p style="position:relative;left:50px;margin-bottom:10px">
			Email: '.$row['email'].' <br>
			Telephone: '.$row['telephone'].' <br>
			FPS payment method: '.$row['fps'].'
		</p>';
    }
?>
<a id="modifyinfo-modal-button" style="position:relative;left:50px;color:#df5a07;">Edit profile</a>
<a href="/member/message.php" style="position:relative;left:60px;">View my messages</a>
<a href="/product/buy/status.php" style="position:relative;left:70px;">View status of my order / my items</a>
<br clear="left">
<button class="button" id="icon-modal-button">Edit icon</button>
<br><br>
<p><span style="position:relative;left:30px;font-size:1.5em;font-weight:bold;margin:0.83em 0;padding-right:50px;">Things I am selling</span> <a href="../product/selling.php">sell a new one</a></p>

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
    echo "<p>You don't have any products for sale now! Click the link above to post a new item on Trade2CU!</p>";
}
?>
</ul>
</div>
<div class="push"></div>

</div>

<div class="navbar">
	<ul>
		<li><a class="img" href="../index.php"><img src="../img/logo.png" alt="Trade2CU logo"></img></a></li>
		<li><a href="../aboutus/aboutus.php">About Us</a></li>
		<li><a href="../aboutus/faq.php">FAQ</a></li>
	</ul>
</div>

<script src="/member/register.js"></script>
<script src="/member/upload.js"></script>
<script src="/member/modifyinfo.js"></script>
</body>
</html>