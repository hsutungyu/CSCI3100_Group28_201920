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
    include_once('../member/register.php');
    ?>
<div class="container">

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
echo "Category: Furnitures";
?>
<hr>
<?php
$target=array();
$query=" SELECT category, pid FROM categories";
$query=mysqli_query($conn,$query);
$numrows=mysqli_num_rows($query);
if ($numrows>0){
	while ($row=mysqli_fetch_assoc($query)){
		if ($row['category']==3){
			array_push($target,$row['pid']);
		}
	}
}

$len=count($target);
for ($i=0; $i<$len; $i++){
    $query="select * from trans where pid=".$target[$i];
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result)>0){
        continue;
    }
    $query="select img from product where id=".$target[$i];
    $result=mysqli_query($conn,$query);
    $row=mysqli_fetch_assoc($result);
    $img=$row['img'];
?>
<div class="column">
<a onclick="window.top.location.href='/product/buy/buying.php?pid=<?php echo $target[$i];?>'" href=""><img src="/img/product/<?php echo $img;?>" alt="cart" id="img" style="width:100%" style="height:50%"></a>
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

<script src="/member/register.js"></script>
</body>


</html>