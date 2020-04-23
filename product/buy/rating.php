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
$query="select id from member where username='".$buyusername."'";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);
$id=$row["id"];
$sql ="INSERT INTO rating(mid,rate,pid) VALUES($id,$rate,$pid)";
$conn->query($sql);
header("Location: status.php");
?>

</body>
</html>