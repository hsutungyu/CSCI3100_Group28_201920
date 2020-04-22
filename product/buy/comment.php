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
//upload to comment
//get mid
$query="select id, username from member where username='".$_SESSION["username"]."'";
$result=mysqli_query($conn,$query);
$rowl=mysqli_fetch_assoc($result);
$id=$rowl["id"];
$comment=$_POST['comment'];
$time=date("Y/m/d H:i:s");
session_start();
$tid=$_SESSION['varname'];
$sql ="INSERT INTO comment(pid,mid,comment,time) VALUES('$tid',$id,'$comment','$time')";
$conn->query($sql);



?>

</body>
</html>