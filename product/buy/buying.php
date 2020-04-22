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
<?php
$servername="localhost";
$username="root";
$password="123456";
$dbname="project";
$conn=new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
	die("Connection failed:". $conn->connect_error);
}
?>
<div class="main">
	<?php
	$tid=$_GET['pid'];
    $qry=" SELECT * FROM product WHERE id=$tid ";
    $result=mysqli_query($conn,$qry);
	$row=mysqli_fetch_assoc($result);
	$name=$row['name'];
	$price=$row['price'];
	$type=$row['type'];
	$info=$row['info'];
	?>
	<div class="productimg content">
	     <img src="test.png" alt="test" id="test"/>
	</div>
	<div class="productinfo content">
	     <?php echo "<p id='name'>".$name."</p>"; ?>
		 <p id="rating">Rating Here(With number of rating/comments received)</p>
	     <hr>
		 <?php echo "<p id='price'>"."$".$price."</p>"; ?>
		 <hr>
		 <p>Type</p>
	     <?php
		 if ($type==1){
		 ?>
		 <input type="radio" id="new" name="type" value="new" checked>
		 <label for="new">New</label><br>
		 <input type="radio" id="2h" name="type" value="2h" disabled>
		 <label for="2h">Second-hand</label><br>
		 <?php
		 }
		 else{
		 ?>
		 <input type="radio" id="new" name="type" value="new" disabled>
		 <label for="new">New</label><br>
		 <input type="radio" id="2h" name="type" value="2h" checked>
		 <label for="2h">Second-hand</label><br>
		 <?php
		 }
		 ?>
		 <p>Additional information</p>
		 <?php 
		 if ($info=='Additional information...'){
			 echo "NONE";
		 }
		 else{
		     echo "<p>".$info."</p>" ;
		 }
		 ?>
	</div>

	<div class="buy content">
	      <p>My favourite</p>
		  <span id="heart"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
		  <p>Put in shopping cart</p>
		  <img src="/img/cart.png" alt="cart" id="cart"/>
	</div>
	</div>
	<br><br><br>
<div id="comment">
	<hr>
	    <p style="font-size: 150%" >Comment</p>
	<form action="comment.php" method="POST">
	<table>
	<?php 
	session_start();
	$_SESSION['varname']=$tid;
	?>
	<tr><td colspan="10"><textarea name="comment" rows="10" cols="50"></textarea></td></tr>
	<tr><td colspan="2"><input type="submit" name="submit" value="Comment"></tr></td>
	</table>
	</form>
<?php
$servername="localhost";
$username="root";
$password="123456";
$dbname="project";
$conn=new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
	die("Connection failed:". $conn->connect_error);
}
get mid
$query="select id, username from member where username='".$_SESSION["username"]."'";
$result=mysqli_query($conn,$query);
$rowl=mysqli_fetch_assoc($result);
$id=$rowl["id"];


$sql=" SELECT * FROM comment WHERE pid=$tid";
$sql=mysqli_query($conn,$sql);
$numrows=mysqli_num_rows($sql);
//show comments
if ($numrows>0){
	while ($r=mysqli_fetch_assoc($sql)){
		$name=$rowl['username'];
		$comment=$r['comment'];
		$time=$r['time'];
		echo $name.'<br/>'.'<br/>'.$comment.'<br/>'.'<br/>'.$time.'<br/>'.'<br/>'.'<hr size="1"/>';
	}
}
		
?>
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
