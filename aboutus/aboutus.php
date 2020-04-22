<!DOCTYPE html>
<html>
<head>
<title>Trade2CU - About Us</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<!-- The font "Baloo 2" -->
<link href="https://fonts.googleapis.com/css?family=Baloo+2:500&display=swap&subset=latin-ext" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="../css/style-nav.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
* {
	font-family: "Baloo 2", cursive;
}

p {
	text-align: justify;
}
</style>
</head>

<body>
<?php
    session_start();
    include_once('../member/register.php');
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

<br><br><br><br><br>

<h2 style="text-align:center">About Creators</h2>

<p>We are a team of CUHK students who found that many CUHK students, teachers and staffs suffer from different kinds of inconvenience. One of the biggest inconvenience is to dispose of something which is not useful for the original owner while still valuable. Secondly, some students may be facing financial difficulties so that they would prefer second-hand items, such as textbooks and dorm items, to whole new items. However, it is always hard to find a specific second-hand item. Therefore, we aim to provide a platform for users to conveniently search for items that they are interested in, to promote a more friendly atmosphere between individuals of CUHK and to minimize the amount of wasted items that are created in CUHK.</p>

<h2 style="text-align:center">About Trade2CU</h2>

<p>Trade2CU acts like an exclusive shopping center for CUHK. Teachers and students can trade their items in CUHK during their school time, which can reduce the cost and the time consumed to buy an item. Any CUHK members can sell their items and buy items sold by other members on this website. No need to find people who can offer you necessities by yourself. You only need to search the item you want and the website will help you find the right person. Even if you have any special requirements, you can still find your ideal items through chatting with sellers on this website.</p>
</div>

<h2 style="text-align:center">Our Contact :)</h2>

<p>If you want to tell us something, please send us email at <a href="mailto:csci3100project28@gmail.com">csci3100project28@gmail.com</a>!</p>

<footer class="footer">
    <h4 style="text-align:center">Trade2CU</h4>
    <a style="text-align:center" href="/aboutus/aboutus.php">About Us</a><br>
    <a style="text-align:center;margin-bottom:10px;" href="/aboutus/faq.php">FAQ</a><br>
</footer>
<script src="../member/register.js"></script>
</body>
</html>