<!DOCTYPE HTML>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/style-nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Baloo+2&display=swap" rel="stylesheet">
    <title>Trade2CU - Homepage</title>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
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
<?php 
$servername="localhost";
$username="root";
$password="123456";
$dbname="project";
$conn=new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
	die("Connection failed:". $conn->connect_error);
}

$target=array();
$data=array();
//preset word
$preset='spring';
$sql=" SELECT keywords, description FROM suggestion WHERE description='$preset' ";
$result=mysqli_query($conn,$sql);
$text=mysqli_fetch_assoc($result);
//store keyword into array
$text=explode(" ",$text['keywords']);
$len=count($text);
//searching product that matches at least one keyword
if (count($text)>0){
	$query=" SELECT * FROM product ";
	$query=mysqli_query($conn,$query);
	$numrows=mysqli_num_rows($query);
	if ($numrows>0){
		while ($row=mysqli_fetch_assoc($query)){
			$sum=0;
			$pid=$row['id'];
			//loop for all key words according to space
			for ($i=0; $i<$len; $i++){
				if (stripos($row['name'], $text[$i])!==false){
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
			    if (stripos($type, $text[$i])!==false){
					$sum++;
					continue;
				}
				$info=explode(" ", $row['info']);
				$key=0;
				for ($j=0; $j<count($info);$j++){
					if (stripos($info[$j],$text[$i])!==false){
						$sum++;
						$key=1;
						break;				
					}	
				}
				if ($key==1){
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
				        if (stripos($tmp, $text[$i])!==false){
					        $sum++;
					        break;
				        }			            
		            }
	            }
			}
			if ($sum>0){
				$pid=$row['id'];
				array_push($target,$pid);
				array_push($target,$sum);
				array_push($data, $target);
				$target=array();
			}
		}		
	}		
}
//quicksort on $data according to appearance times of keywords
function swap(&$a, &$b) 
{  
    $temp = $a;  
    $a = $b;  
    $b = $temp;  
}  

function partition (&$arr, $l, $h)  
{  
    $x = $arr[$h][1];  
    $i = ($l - 1);  
  
    for ($j = $l; $j <= $h - 1; $j++)  
    {  
        if ($arr[$j][1] <= $x)  
        {  
            $i++;  
            swap ($arr[$i][0], $arr[$j][0]); 
			swap ($arr[$i][1], $arr[$j][1]); 
        }  
    }  
    swap ($arr[$i + 1][0], $arr[$h][0]);
	swap ($arr[$i + 1][1], $arr[$h][1]);
	
    return ($i + 1);  
}   

function quickSort(&$A, $l, $h)  
{  
    if ($l < $h)  
    {  
        $p = partition($A, $l, $h);  
        quickSort($A, $l, $p - 1);  
        quickSort($A, $p + 1, $h);  
    }  
}
quickSort($data, 0 , count($data)-1);
?>
<?php
$len=count($data);
$display=6;
if ($len<6){
	$display=$len;
}
for ($i=0; $i<$display; $i++){
    $query="select * from trans where pid=".$data[$len-1-$i][0];
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result)>0){
        continue;
    }
    $query="select img from product where id=".$data[$len-1-$i][0];
    $result=mysqli_query($conn,$query);
    $row=mysqli_fetch_assoc($result);
    $img=$row['img'];
    
?>
<div class="column">
<a onclick="window.top.location.href='/product/buy/buying.php?pid=<?php echo $data[$len-1-$i][0];?>'"><img src="/img/product/<?php echo $img;?>" alt="cart" id="img" style="width:100%" style="height:50%"></a>
	<?php
	$qry=" SELECT id, name, price FROM product WHERE id=".$data[$len-$i-1][0];
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
