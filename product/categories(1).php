<!DOCTYPE HTML>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/style-nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Trade2CU - Categories</title>
</head>
<style>
#cate{
  float: left;
  width: 20%;
  padding: 20px;
  }

#display{
  float: right;
  width: 70%;
  padding: 20px;
  }
#frame{
  width: 800px;
  height: 500px;
  border-style: none;
  }
.link{
  cursor: pointer;
  }
.main{
  width: 1200px;
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
	<div id="cate">
	  <ul>
	    <li><p onclick="change('https://tetris.com/play-tetris')" id="item" class="link"><u>Textbooks and Sources</u></p></li><br>
		<li><p onclick="change('https://tetris.com/play-tetris')" id="item" class="link"><u>Electronics</u></p></li><br>
		<li><p onclick="change('https://tetris.com/play-tetris')" id="item" class="link"><u>Furnitures</u></p></li><br>
		<li><p onclick="change('https://tetris.com/play-tetris')" id="item" class="link"><u>Dorm Items and Necesities</u></p></li><br>
		<li><p onclick="change('https://tetris.com/play-tetris')" id="item" class="link"><u>Textbooks and Sources</u></p></li><br>
		<li><p onclick="change('https://tetris.com/play-tetris')" id="item" class="link"><u>Clothes</u></p></li><br>
		<li><p onclick="change('https://tetris.com/play-tetris')" id="item" class="link"><u>Stationery</u></p></li><br>
		<li><p onclick="change('https://tetris.com/play-tetris')" id="item" class="link"><u>Others</u></p></li><br>
	  </ul>
	</div>
	<div id="display">
	    <iframe id="frame" src='https://www.cuhk.edu.hk/english/index.html'> </iframe>
	</div>
	</div>
	
<script type="text/javascript">  	
function change(link){
   document.getElementById("frame").src=link;
}
</script>	 
		
		
</body>
</html>