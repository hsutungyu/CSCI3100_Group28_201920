<!DOCTYPE HTML>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/style-nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Baloo+2&display=swap" rel="stylesheet">
    <title>Trade2CU - Selling</title>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<style>
.content p1{
 padding: 30px;
 font-size: 200%;
 }
.imagecss {
  float: left;
  width: 45%;
  padding: 25px;
  }
.inputcss {
  float: right;
  width: 45%;
  padding: 20px;
  }
.main{
  width: 1200px;
  }
</style>

<body>
<?php
if(!isset($_SESSION['username'])){
    echo "<script>alert('Please login before accessing this page!');window.location.href='/index.php';</script>";
}
?>
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
	<div class="content">
	<p1>Start selling your items!!!</p1>
	<form method="post" action="sellinginfo.php">
	  <div class="imagecss">
           <label for="img">Please Upload Item's Image:<br></label>
           <input type="file" id="img" name="img" accept="image/*" required onchange="loadFile(event)" /><br>
		   <img id="output" width="400 height="400" />
	  </div>

	  <div class="inputcss">
	      <label for="itemname">Name your item:</label><br>
		  <input type="text" id="itemname" name="itemname" size="50" required><br>
		  <p>Categories your Item:(You can choose more than one)</p>
		  <input type="checkbox" id="b&s" name="cate[]" value="Textbook and Sources">
		  <label for="b&s">Textbook and Sources</label><br>
		  <input type="checkbox" id="elect" name="cate[]" value="Electronics">
		  <label for="elect">Electronics</label><br>
		  <input type="checkbox" id="Furnitures" name="cate[]" value="Furnitures">
		  <label for="Furnitures">Furnitures</label><br>
		  <input type="checkbox" id="daily" name="cate[]" value="Dorm items/ Necessities">
		  <label for="daily">Dorm items/ Necessities</label><br>
		  <input type="checkbox" id="cloth" name="cate[]" value="Clothes">
		  <label for="cloth">clothes</label><br>
		  <input type="checkbox" id="stat" name="cate[]" value="Stationery">
		  <label for="stat">Stationery</label><br>
		  <input type="checkbox" id="other" name="cate[]" value="Others">
		  <label for="other">Others</label><br>

	      <p>Type:</p>
	      <input type="radio" id="new" name="type[]" value="new" required>
		  <label for="new">New</label><br>
		  <input type="radio" id="2h" name="type[]" value="second hand">
		  <label for="2h">Second-hand</label><br>
		  <br>
		  <label for="Price">Set your Price:</label><br>
		  <input type="number" step="0.1" id="price" name="price" min="0" required><br>
		  <br>
		  <label for="info">Additional infomation:(Optional)</label><br>
		  <textarea rows="6" cols="50" name="info">Additional information...</textarea>
		  <br><br>

		  <input type="submit" value="Submit" onclick="ValidateSelection()">&emsp;&emsp;
		  <input type="reset">
	  </div>
	</form>
	</div>
	</div>
<script type="text/javascript">  
function ValidateSelection()  
{  
    var checkboxes = document.getElementsByName("cate[]");  
    var numberOfCheckedItems = 0;  
    for(var i = 0; i < checkboxes.length; i++)  
    {  
        if(checkboxes[i].checked)  
            numberOfCheckedItems++;  
    }  
    if(numberOfCheckedItems <1)  
    {  
        alert("Please select at least one category");  
		event.preventDefault()
        return false;  
    }  
}  

var loadFile = function(event) {
	var image = document.getElementById('output');
	image.src = URL.createObjectURL(event.target.files[0]);
};
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
