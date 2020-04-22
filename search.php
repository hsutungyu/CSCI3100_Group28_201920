<html>
<head>
    <link rel="stylesheet" type="text/css" href="/css/style-nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Baloo+2&display=swap" rel="stylesheet">
    <title>Trade2CU - Homepage</title>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.column {
  float: left;
  width: 15%;
  padding: 15px;
}

.row::after {
  content: "";
  clear: both;
}

.footer {
  position: float;
  bottom: 0;
  width: 100%;
  clear:both;
}

</style>
<body>
<?php
    session_start();
    include_once('member/register.php');
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
                    <form  action="search.php" method="get">
                        <input type="text" name="text" placeholder="Search..">
                        <button type="submit" value="search"><i class="fa fa-search"></i></button>
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
$search=$_GET["text"];
echo "Search: ",$search;
?>
<br>
<h2>Search Result</h2>
<hr>

<?php
$target=array();
$terms=explode(" ",$search);
$len=count($terms);
//searching
if (count($terms)>0){
	$query=" SELECT * FROM product";
	$query=mysqli_query($conn,$query);
	$numrows=mysqli_num_rows($query);
	if ($numrows>0){
		while ($row=mysqli_fetch_assoc($query)){
			$sum=0;
			$pid=$row['id'];
			//loop for all key words according to space
			for ($i=0; $i<$len; $i++){
				if (strpos($row['name'], $terms[$i])!==false){
					$sum++;
					continue;
				}
				//convert type from int to string
				if ($row['type']==1){
	                $type="new";
                }
                else{
	                $type="second hand";
                }
			    if (strpos($type, $terms[$i])!==false){
					$sum++;
					continue;
				}
				$sql=" SELECT category, pid FROM categories WHERE pid=$pid";
	            $sql=mysqli_query($conn,$sql);
	            $caterows=mysqli_num_rows($sql);
	            if ($caterows>0){
		            while ($r=mysqli_fetch_assoc($sql)){
						//convert cate to string
						switch($r['category']){
							case 1: 
		                        $tmp="Textbook and Source";
			                    break;
	                        case 2:
		                        $tmp="Electronics";
			                    break;
	                        case 3:
		                        $tmp="Furnitures";
			                    break;
	                        case 4:
		                        $tmp="Dorm items/ Necessities";
			                    break;
	                        case 5:
		                        $tmp="Clothes";
			                    break;
                            case 6:
		                        $tmp="Stationery";
			                    break;
                            case 7:
		                        $tmp="Others";
							};
				        if (strpos($tmp, $terms[$i])!==false){
					        $sum++;
					        break;
				        }			            
		            }
	            }
			}
			if ($sum==$len){
				$pid=$row['id'];
				array_push($target,$pid);
			}
		}		
	}		
}	
?>
<div class="row">
<?php
$_SESSION['varname']=$target;
$len=count($target);
for ($i=0; $i<$len; $i++){
?>
<div class="column">
	<a href="/product/buy/buying.php" method="POST"><img src="/img/cart.png" alt="cart" id="img" style="width:100%" style="height:50%"></a>
	<?php
	$qry=" SELECT id, name, price FROM product WHERE id=$target[$i] ";
    $result=mysqli_query($conn,$qry);
	$row=mysqli_fetch_assoc($result)
	?>
	<div>
	<?php
    echo "Itemname: ",$row['name'],"<br>";
	echo "Price: $",$row['price'];
	?>
	</div>
</div>
<?php
}
mysqli_close($conn);
?>
</div>




<footer class="footer">
    <h4 style="text-align:center">Trade2CU</h4>
    <a href="/aboutus/aboutus.php">About Us</a><br>
    <a href="/aboutus/faq.php">FAQ</a><br>
</footer>
<script src="/member/register.js"></script>
</body>
</html>