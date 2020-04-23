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
    if(empty($_GET['pid'])){
        echo "<script>alert('Invalid Request!');window.location.href='/index.php';</script>";
    }
	$tid=$_GET['pid'];
    $qry=" SELECT * FROM product WHERE id=$tid ";
    $result=mysqli_query($conn,$qry);
	$row=mysqli_fetch_assoc($result);
	$name=$row['name'];
	$price=$row['price'];
	$type=$row['type'];
    $info=$row['info'];
    $img=$row['img'];
	?>
	<div class="productimg content">
         <?php echo "<img src='/img/product/".$img."' alt='test' id='test'/>";?>
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
          <form id="fav-form" action="" method="POST">
          <?php echo "<input name='fav-pid' id='fav-pid' type='text' style='display:none;' value='".$tid."'>"?>
          <button id="fav-form-submit" type="submit" style="background-color:transparent;border:none;"><span id="heart"><i class="fa fa-heart-o" aria-hidden="true"></i></span></button>
        </form>
        
		  <p>Put in shopping cart</p>
          <form id="cart-form" action="cart.php" method="POST">
		  <input type="image" id="cart" src="/img/cart.png" alt="cart">
          <?php echo "<input name='cart-pid' id='cart-pid' type='text' style='display:none;' value='".$tid."'>"?>
          </form>
	</div>
	</div>
	<br><br><br>
<div id="comment">
	<hr>
	    <p style="font-size: 150%" >Comment</p>
	<form action="comment.php" method="POST">
    <input type="text" id="redir" name="redir" style="display:none;">
	<table>
	<?php 
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
<script src="buying.js"></script>
		        		
</body>
</html>
