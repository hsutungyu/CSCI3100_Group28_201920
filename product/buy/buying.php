<!DOCTYPE HTML>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/style-nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Trade2CU - Product</title>
    <link href="https://fonts.googleapis.com/css?family=Baloo+2&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<style>
.main{
  width: 1200px;
  }
.content{
  float: left;
  height: 400px;
  }
.productimg{
  width: 30%;
  padding: 15px;

  }
#test{
   width: 200px;
   height: 250px;
   }
.productinfo{
   width:45%;
   padding: 15px;

   }
#name{
   font-size: 150%;
   }
#rating{
font-size: 80%;
}
.buy{
   width: 15%;
   padding:10px;
   }
.main:after{
  content: "";
  display: table;
  clear: both;
  }

.fa-heart-o{
  color: red;
  cursor: pointer;
  font-size: 24px;
  }
.fa-heart{
  color: red;
  cursor: pointer;
  font-size: 24px;
  }
#cart{
   width:50px;
   height:50px;
   }
#comment{
   width: 1200px;
   position: static;
   top: 400px;
   boeder: 1px solid black;
   }
   

</style>

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
	<div class="productimg content">
	     <img src="test.png" alt="test" id="test"/>
	</div>
	<div class="productinfo content">
	     <p id="name">Product Name Here</p>
		 <p id="rating">Rating Here(With number of rating/comments received)</p>
	     <hr>
		 <p id="price">Price Here</p>
		 <hr>
		 <p>Type(box is default)</p>
		 <input type="radio" id="new" name="type" value="new" checked>
		 <label for="new">New</label><br>
		 <input type="radio" id="2h" name="type" value="2h" disabled>
		 <label for="2h">Second-hand</label><br>
		 <p>Additional information</p>
		 <p>...</p>
	</div>

	<div class="buy content">
	      <p>My favourite</p>
		  <span id="heart"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
		  <p>Put in shopping cart</p>
		  <img src="cart.png" alt="cart" id="cart"/>
	</div>
	</div>
	<br><br><br>
	<div id="comment">
	<hr>
	    <p style="font-size: 150%" >Comment</p>
		<p>comment show below</p>
		<p>.</p>
	</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
</script>
<script>
$(document).ready(function(){
  $("#heart").click(function(){
     if (!($("#heart").hasClass("liked"))){
         $("#heart").html('<i class="fa fa-heart" aria-hidden="true"></i>');	
         $("#heart").addClass("liked");
     }else{
	     $("#heart").html('<i class="fa fa-heart-o" aria-hidden="true"></i>');	
         $("#heart").removeClass("liked");
		 }
	});
});

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
