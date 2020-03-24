<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/css/style-nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Trade2CU - View Item Status</title>
</head>

<body>
<?php
    session_start();
    ?>
    <div class="navbar">

<ul>
        <li><a href="/product/buy/buying.php" class="navbar-text navbar-dropdown1-button">Buying</a>
            <ul class="navbar-dropdown1-content">
                <li><a href="/product/buy/buying.php">Search for Products</a>
                    <a href="/product/categories.php">View Categories</a>
                </li>
            </ul>
        </li>
        <li><a href="/product/selling.php" class="navbar-text">Selling</a></li>
        <li><a href="/index.php" class="navbar-img active"><img src="/img/test.png" height="30px" align="middle"></a>
        </li>
        <li><a class="navbar-dropdown2-button">Search</a>
            <ul class="navbar-dropdown2-content">
                <li>
                    <form>
                        <input type="text" placeholder="Search..">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </li>
            </ul>
        </li>
        <li>
            <?php
            if(isset($_SESSION['username'])){
            echo('<a class="navbar-text" href="/member/information.php">Welcome '.$_SESSION['username'].'</a>');
            echo('<ul class="navbar-dropdown1-content"><li><a href="/member/logout.php" class="navbar-text">Logout</a></li></ul>');
            }else{
                echo('<form action="" method="post">
                <a class="navbar-login-text" style="display: inline;
                text-decoration: none;
                color: #7e3204;
                font-size: 10px;
                font-family: monospace;
                text-align: center;">Account:</a><br>
                <input type="text" id="username" name="username"><br>
                <a class="navbar-login-text" style="display: inline;
                text-decoration: none;
                color: #7e3204;
                font-size: 10px;
                font-family: monospace;
                text-align: center;">Password:</a><br>
                <input type="password" id="password" name="password"><br>
                <input type="submit" name="login" value="Login" style="font-family:monospace;">
                </form>');
            }
            define('DB_SERVER','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','123456');
    define('DB_NAME','project');

    $link=mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);

            if(isset($_POST['login'])){
                $username=$_POST['username'];
                $password=$_POST['password'];
                $query=mysqli_query($link,"select * from member where username='$username' and password='$password'");
                if(mysqli_num_rows($query)==1){
                    $_SESSION['username']=$username;
                    header("Refresh:0");
                }else{
                    echo("Error");
                }
            }
            ?>
            <!--<a href="member/information.php" class="navbar-text">Member</a></li>-->

    </ul>

</div>

</div>
    <br><br><br><br><br><br><br><br>


</body>
</html>