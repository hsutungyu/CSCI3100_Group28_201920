<?php
defined('DB_SERVER') or define('DB_SERVER', 'localhost');
defined('DB_USERNAME') or define('DB_USERNAME', 'root');
defined('DB_PASSWORD') or define('DB_PASSWORD', '123456');
defined('DB_NAME') or define('DB_NAME', 'project');
$link=mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
$query="select * from member where username='".$_SESSION['username']."'";
$result=mysqli_query($link,$query);
$row=mysqli_fetch_assoc($result);
?>
<div class="modal" id="modifyinfo-modal">
<div class="modal-content">
<span class="close2">&times;</span><br>
<form class="modifyinfo-form" id="modifyinfo-form" action="" method="post">
<h1>Modify Your Information<br><span style="font-size:20px;">(Leave Blank if Necessary)<span></h1><br>
        <a class="modifyinfo-text">Password:<br><span style="font-size:15px;">(8 characters or more, with at least one uppercase letter and one lowercase letter)<span></a><br>
        <input class="modifyinfo-input" type="password" id="modifyinfo-password" name="modifyinfo-password"><a>      </a><a class="modifyinfo-err" id="passwordErr1"></a><br>
        <a class="modifyinfo-text">Confirm Password: </a><br>
        <input class="modifyinfo-input" type="password" id="modifyinfo-password-confirm" name="modifyinfo-password-confirm"><a>      </a><a class="modifyinfo-err" id="passwordConfirmErr1"></a><br>
        <a class="modifyinfo-text">Email:</a><br>
        <input class="modifyinfo-input" type="text" style="width:30vw;" id="modifyinfo-email" name="modifyinfo-email"><a>      </a><a class="modifyinfo-err" id="emailErr1"></a><br>
        <a class="modifyinfo-text">Telephone No.:</a><br>
        <input class="modifyinfo-input" type="text" id="modifyinfo-telephone" name="modifyinfo-telephone"><a>      </a><a class="modifyinfo-err" id="telephoneErr1"></a><br>
        <a class="modifyinfo-text">FPS payment method:</a><br>
        <input class="modifyinfo-input" type="text" id="modifyinfo-fps" name="modifyinfo-fps"><br>
        <input class="modifyinfo-submit" id="modifyinfo-submit" name="modifyinfo-submit" type="submit" value="Register"><br>
        <a></a>
    </form>
</div>
</div>

