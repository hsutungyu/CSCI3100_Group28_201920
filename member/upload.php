<div class="modal" id="icon-modal">
<div class="modal-content">
<form class="icon-form" id="icon-form" action="" method="post" enctype="multipart/form-data">
    <a>Select image to upload:</a>
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload" name="submit">
</form>
</div>
</div>

<?php
defined('DB_SERVER') or define('DB_SERVER', 'localhost');
defined('DB_USERNAME') or define('DB_USERNAME', 'root');
defined('DB_PASSWORD') or define('DB_PASSWORD', '123456');
defined('DB_NAME') or define('DB_NAME', 'project');
$link=mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

$target_dir="../img/member/";
$query="select id from member where username='".$_SESSION['username']."'";
$result=mysqli_query($link,$query);
$row=mysqli_fetch_assoc($result);
$id=$row['id'];
if(isset($_POST['submit'])){
    $target_file=$target_dir.basename($_FILES["fileToUpload"]["name"]);
    $imageFileType=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $randomName=uniqid();
    $target_file=$target_dir.$randomName.'.'.$imageFileType;
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file);
    $query="update member set icon='".$randomName."' where id=".$id;
    $result=mysqli_query($link,$query);
}
?>

