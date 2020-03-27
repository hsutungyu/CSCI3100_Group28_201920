<!DOCTYPE HTML>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/style-message.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Trade2CU - Message</title>
    <link href="https://fonts.googleapis.com/css?family=Baloo+2&display=swap" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>

<body>
<?php
    session_start();
    include_once('../member/register.php');
    ?>
    <div class="navbar">

        <ul>
            <li><a href="product/buy/buying.html" class="navbar-text navbar-dropdown1-button">Buying</a>
            </li>
            <li><a href="product/selling.html" class="navbar-text">Selling</a></li>
            <li><a href="index.html" class="navbar-img active"><img src="img/test.png" height="30px" align="middle"></a>
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
            <li><a href="member/information.html" class="navbar-text">Member</a></li>

        </ul>
<h1 style="color:#eb6100; position:fixed"><b>Message Box</b></h1>
<div class="split left">
<div id="wrapper">
    <div id="menu">
        <p class="welcome"><b>Product Name</b></p>
        <div style="clear:both"></div>
    </div>
     
    <div id="chatbox"></div>
     
    <form name="message" action="">
        <input name="usermsg" type="text" id="usermsg" size="63" />
        <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
    </form>
</div>
</div>

<div class="split right">
  <div class="centered">
    <img src="test.jpg" alt="Avatar man">
    <h3>Product Name</h3>
    <p>Product Description</p>
  </div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<script type="text/javascript">
// jQuery Document
$(document).ready(function(){
 
});
</script>
<footer class="footer">
    <h4 style="text-align:center">Trade2CU</h4>
    <a style="text-align:center" href="/aboutus/aboutus.php">About Us</a><br>
    <a style="text-align:center;margin-bottom:10px;" href="/aboutus/faq.php">FAQ</a><br>
</footer>
<script src="/member/register.js"></script>
</body>


</html>