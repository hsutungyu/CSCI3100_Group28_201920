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
                <?php
                if(isset($_SESSION['username'])){
                echo('<li><a class="navbar-text" href="/member/information.php">Welcome '.$_SESSION['username'].'</a>');
                ?>
                <ul class="navbar-dropdown1-content"><li><a href="/member/logout.php" class="navbar-text">Logout</a></li></ul>
                <?php
                }
                if(!isset($_SESSION['username'])){
                    ?>
                    <li><a class="navbar-text">Welcome Guest</a>
                    <ul class="navbar-login-content"><li><div class="form"><form action="" method="post"><a>Account:</a><input type="text" id="username" name="username"><a>Password:</a><input type="password" id="password" name="password"><input type="submit" name="login" value="Login"></form></div></li></ul></li>
                    <?php
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