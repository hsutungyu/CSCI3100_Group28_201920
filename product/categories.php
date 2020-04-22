<!DOCTYPE HTML>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/style-nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Trade2CU - Categories</title>
    <link href="https://fonts.googleapis.com/css?family=Baloo+2&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<style>
#cate{
  float: left;
  width: 20%;
  padding: 20px;
  }

#display{
  float: right;
  width: 70%;
  padding: 20px;
  }
#frame{
  width: 1000px;
  height: 800px;
  border-style: none;
  }
.link{
  cursor: pointer;
  }
.main{
  width: 1200px;
  }

</style>

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
    <br><br><br><br><br><br><br><br>
	<div class="main">
	<div id="cate">
	  <ul>
	    <li><p onclick="change('http://localhost/product/Textbook%20and%20Sources.php')"id="item" class="link"><u>Textbooks and Sources</u></p></li><br>
		<li><p onclick="change('http://localhost/product/Electronics.php')" id="item" class="link"><u>Electronics</u></p></li><br>
		<li><p onclick="change('http://localhost/product/Furnitures.php')" id="item" class="link"><u>Furnitures</u></p></li><br>
		<li><p onclick="change('http://localhost/product/Dorm.php')" id="item" class="link"><u>Dorm Items and Necesities</u></p></li><br>
		<li><p onclick="change('http://localhost/product/Clothes.php')" id="item" class="link"><u>Clothes</u></p></li><br>
		<li><p onclick="change('http://localhost/product/Stationery.php')" id="item" class="link"><u>Stationery</u></p></li><br>
		<li><p onclick="change('http://localhost/product/Others.php')" id="item" class="link"><u>Others</u></p></li><br>
	  </ul>
	</div>
	<div id="display">
	    <iframe id="frame" src='https://www.cuhk.edu.hk/english/index.html'> </iframe>
	</div>
	</div>
	
<script type="text/javascript">  	
function change(link){
   document.getElementById("frame").src=link;
}
</script>	 
</div>
<footer class="footer">
    <h4 style="text-align:center">Trade2CU</h4>
    <a style="text-align:center" href="/aboutus/aboutus.php">About Us</a><br>
    <a style="text-align:center;margin-bottom:10px;" href="/aboutus/faq.php">FAQ</a><br>
</footer>
<script src="/member/register.js"></script>
		
		
</body>
</html>
