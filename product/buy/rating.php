<html>
<body>
<?php
$servername="localhost";
$username="root";
$password="123456";
$dbname="project";
$conn=new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
	die("Connection failed:". $conn->connect_error);
}
$pid=$_POST["pid"];
$rate=$_POST["rate"];
$buyusername=$_POST["buyusername"];
$query="select username from member where id=".$row["mid"];
$result1=mysqli_query($link,$query);
$row1=mysqli_fetch_assoc($result1);
$sql ="INSERT INTO rating(mid,rate,pid) VALUES($buyusername,$rate,$pid)";
$conn->query($sql);
header("Location: status.php");
?>
</body>
</html>