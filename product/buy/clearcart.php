<?php
session_start();
unset($_SESSION["shopping-cart"]);
header("Location: cart.php");
?>