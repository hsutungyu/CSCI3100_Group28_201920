<html>
<body>

<?php
session_start();
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
echo "Categories: ",implode(", ",$cate),"<br>";
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
$target_dir="../img/product/";
$target_file=$target_dir.basename($_FILES["fileToUpload"]["name"]);
$imageFileType=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$randomName=uniqid();
$target_file=$target_dir.$randomName.'.'.$imageFileType;
move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file);
$sql ="INSERT INTO product(name,type,price,info,mid,img) VALUES('$itemname',$type,$price,'$info',$id,'$randomName')";
$conn->query($sql);
$pid=$conn->insert_id;



//get pid and insert category
$len=count($cate);
for ($i=0; $i<$len; $i++){
	$num=array_pop($cate);
	$sqll ="INSERT INTO categories(category,pid) VALUES($num,$pid)";
	$conn->query($sqll);
}

header("Location: /product/buy/status.php");
?>	
</body>
</html>