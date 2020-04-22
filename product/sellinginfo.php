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
$itemname=$_POST["itemname"];
echo "Itemname: ",$itemname,"<br>";
$cate=$_POST["cate"];
echo "Categores: ",implode(", ",$cate),"<br>";
$type=$_POST["type"];
echo "Type: ",implode($type),"<br>";
$price=$_POST["price"];
echo "Price: ",$price,"<br>";
$price=(float)$price;
$info=$_POST["info"];
echo "Info: ",$info,"<br>";
//change $cate from string to int 
for ($i=0; $i<count($cate); $i++){
	$cate=array_reverse($cate);
	$tmp=array_pop($cate);
	switch($tmp){
		case "Textbook and Sources":
		     $tmp=1;
			 $cate=array_reverse($cate);
			 array_push($cate,$tmp);
			 break;
	    case "Electronics":
		     $tmp=2;
			 $cate=array_reverse($cate);
			 array_push($cate,$tmp);
			 break;
	    case "Furnitures":
		     $tmp=3;
			 $cate=array_reverse($cate);
			 array_push($cate,$tmp);
			 break;
	    case "Dorm items/ Necessities":
		     $tmp=4;
			 $cate=array_reverse($cate);
			 array_push($cate,$tmp);
			 break;
	    case "Clothes":
		     $tmp=5;
			 $cate=array_reverse($cate);
			 array_push($cate,$tmp);
			 break;
        case "Stationery":
		     $tmp=6;
			 $cate=array_reverse($cate);
			 array_push($cate,$tmp);
			 break;
        case "Others":
		     $tmp=7;
			 $cate=array_reverse($cate);
			 array_push($cate,$tmp);
	};	
};	
$tmp=array_pop($type);
//change $type from string to int
if ($tmp=="new"){
	$type=1;
}
else{
	$type=2;
}
$query="select id from member where username='".$_SESSION['username']."'";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);
$id=$row['id'];
//need add mid
$sql ="INSERT INTO product(name,type,price,info,mid) VALUES('$itemname',$type,$price,'$info',$id)";
$conn->query($sql);
//get pid and insert category
$len=count($cate);
$pid=$conn->insert_id;
for ($i=0; $i<$len; $i++){
	$num=array_pop($cate);
	$sqll ="INSERT INTO categories(category,pid) VALUES($num,$pid)";
	$conn->query($sqll);
}


?>	
</body>
</html>