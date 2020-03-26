<!DOCTYPE HTML>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/style-nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Trade2CU - Product</title>
</head>
<style>
.main{
  width: 1200px;
  }
.content{
  float: left;
  height: 400px;
  }
.productimg{
  width: 30%;
  padding: 15px;

  }
#test{
   width: 200px;
   height: 250px;
   }
.productinfo{
   width:45%;
   padding: 15px;

   }
#name{
   font-size: 150%;
   }
#rating{
font-size: 80%;
}
.buy{
   width: 15%;
   padding:10px;
   }
.main:after{
  content: "";
  display: table;
  clear: both;
  }

.fa-heart-o{
  color: red;
  cursor: pointer;
  font-size: 24px;
  }
.fa-heart{
  color: red;
  cursor: pointer;
  font-size: 24px;
  }
#cart{
   width:50px;
   height:50px;
   }
#comment{
   width: 1200px;
   position: static;
   top: 400px;
   boeder: 1px solid black;
   }
   

</style>

<body>
    <div class="navbar">

        <ul>
            <li><a href="product/buy/buying.html" class="navbar-text navbar-dropdown1-button">Buying</a>
                <ul class="navbar-dropdown1-content">
                    <li><a href="product/buy/buying.html">Search for Products</a>
                        <a href="product/categories.html">View Categories</a>
                    </li>
                </ul>
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
    </div >
    <br><br><br><br><br><br><br><br>
	<div class="main">
	<div class="productimg content">
	     <img src="test.png" alt="test" id="test"/>
	</div>
	<div class="productinfo content">
	     <p id="name">Product Name Here</p>
		 <p id="rating">Rating Here(With number of rating/comments received)</p>
	     <hr>
		 <p id="price">Price Here</p>
		 <hr>
		 <p>Type(box is default)</p>
		 <input type="radio" id="new" name="type" value="new" checked>
		 <label for="new">New</label><br>
		 <input type="radio" id="2h" name="type" value="2h" disabled>
		 <label for="2h">Second-hand</label><br>
		 <p>Additional information</p>
		 <p>...</p>
	</div>

	<div class="buy content">
	      <p>My favourite</p>
		  <span id="heart"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
		  <p>Put in shopping cart</p>
		  <img src="cart.png" alt="cart" id="cart"/>
	</div>
	</div>
	<br><br><br>
	<div id="comment">
	<hr>
	    <p style="font-size: 150%" >Comment</p>
		<p>comment show below</p>
		<p>.</p>
	</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
</script>
<script>
$(document).ready(function(){
  $("#heart").click(function(){
     if (!($("#heart").hasClass("liked"))){
         $("#heart").html('<i class="fa fa-heart" aria-hidden="true"></i>');	
         $("#heart").addClass("liked");
     }else{
	     $("#heart").html('<i class="fa fa-heart-o" aria-hidden="true"></i>');	
         $("#heart").removeClass("liked");
		 }
	});
});

</script>
         	 
		        
	
			
		
</body>
</html>