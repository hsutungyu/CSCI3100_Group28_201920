<!DOCTYPE HTML>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/style-nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Baloo+2&display=swap" rel="stylesheet">
    <title>Trade2CU - Message</title>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>

<body>
    <?php
    session_start();
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

<h2>View Messages</h2>
<div style="float:left;width:20%;">
<?php
$storedpid=[];
$storedmid=[];
$query="select id from member where username='".$_SESSION["username"]."'";
$result=mysqli_query($link,$query);
$row=mysqli_fetch_assoc($result);
$id=$row['id'];

$query="select pid from trans where buyid=".$id;
$result=mysqli_query($link,$query);
while($row=mysqli_fetch_assoc($result)){
    array_push($storedpid,$row['pid']);
}

$query="select product.mid from product inner join trans on product.id=trans.pid where trans.buyid=".$id;
$result=mysqli_query($link,$query);
while($row=mysqli_fetch_assoc($result)){
    foreach($storedpid as &$pid){
        $storedmid[$pid]=$row["mid"];
    }
}
unset($pid);

$query="select distinct pid from message where sendid in (".$id.") or receiveid in (".$id.") order by pid";
$result=mysqli_query($link,$query);
    while($row=mysqli_fetch_assoc($result)){
        if(!in_array($row["pid"],$storedpid)){
            array_push($storedpid,$row['pid']);
        }
    }



$query="select distinct pid, sendid, receiveid from message where sendid=".$id." or receiveid=".$id." order by pid";
$result=mysqli_query($link,$query);

    while($row=mysqli_fetch_assoc($result)){
        foreach($storedpid as &$pid){
        if($row["sendid"]!=$id&&!array_key_exists($pid,$storedmid)){
            $storedmid[$pid]=$row["sendid"];
        }elseif($row["receiveid"]!=$id&&!array_key_exists($pid,$storedmid)){
            $storedmid[$pid]=$row["receiveid"];
        }
    }
}
unset($pid);

foreach ($storedpid as &$pid){
    $query="select name from product where id=".$pid;
    $result=mysqli_query($link,$query);
    $row=mysqli_fetch_assoc($result);
    echo "<a class='messagebox-button'>".$pid." : ".$row["name"]."<br>";
    $query="select username from member where id=".$storedmid[$pid];
    $result=mysqli_query($link,$query);
    $row=mysqli_fetch_assoc($result);
    echo " with ".$row["username"]."</a><br>";
}
?>
</div>
<div style="overflow:hidden;width:80%;">
<?php
foreach ($storedpid as &$pid){
    echo "<div class='messagebox' style='display:none;'>";
    $query="select * from message where (sendid in (".$id.") or receiveid in (".$id.")) and pid=".$pid." order by time";
    $result=mysqli_query($link,$query);
    while($row=mysqli_fetch_assoc($result)){
        if($row["receiveid"]==$id){
            echo "<p style='float:left;clear:both;'>".$row["message"]."</p><br>";
            echo "<p style='float:left;clear:both;'>".$row["time"]."</p><br>";
        }else{
            echo "<p style='float:right;clear:both;'>".$row["message"]."</p><br>";
            echo "<p style='float:right;clear:both;'>".$row["time"]."</p><br>";
        }
    }
    echo "</div>";
}
unset($pid);
?>

</div>
<form id="message-form" action="" method="post">
<input name="message-submit" id="message-submit" style="display:none;float:right;height:4.5vh;" type="submit">
<input name="message-input" id="message-input" style="display:none;float:right;width:80%;height:4vh;" type="text">
<input name="message-receive" style="display:none;" id="message-receive" type="text">
<input name="message-pid" style="display:none;" id="message-pid" type="text">
</form>
<br><br><br>

</div>
<div class="push" style="height:160px;"></div>

</div>
<div class="navbar">
	<ul>
		<li><a class="img" href="/index.php"><img src="/img/logo.png" alt="Trade2CU logo"></img></a></li>
		<li><a href="/aboutus/aboutus.php">About Us</a></li>
		<li><a href="/aboutus/faq.php">FAQ</a></li>
	</ul>
</div>
<script src="/member/register.js"></script>
<script src="/member/message.js"></script>
</body>


</html>