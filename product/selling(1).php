<!DOCTYPE HTML>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/style-nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Trade2CU - Selling</title>
</head>
<style>
.content p1{
 padding: 30px;
 font-size: 200%;
 }
.imagecss {
  float: left;
  width: 45%;
  padding: 25px;
  }
.inputcss {
  float: right;
  width: 45%;
  padding: 20px;
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

    </div>
    <br><br><br><br><br><br><br><br>
	<div class="main">
	<div class="content">
	<p1>Start selling your items!!!</p1>
	<form action="/action_page.php">
	  <div class="imagecss">
           <label for="img">Please Upload Item's Image:<br></label>
           <input type="file" id="img" name="img" accept="image/*" required onchange="loadFile(event)" /><br>
		   <img id="output" width="400 height="400" />
	  </div>

	  <div class="inputcss">
	      <label for="itemname">Name your item:</label><br>
		  <input type="text" id="itemname" name="itemname" size="50" required><br>
		  <p>Categories your Item:(You can choose more than one)</p>
		  <input type="checkbox" id="b&s" name="cate" value="b&s">
		  <label for="b&s">Textbook and Sources</label><br>
		  <input type="checkbox" id="elect" name="cate" value="elect">
		  <label for="elect">Electronics</label><br>
		  <input type="checkbox" id="Furnitures" name="cate" value="Furnitures">
		  <label for="Furnitures">Furnitures</label><br>
		  <input type="checkbox" id="daily" name="cate" value="daily">
		  <label for="daily">Dorm items/ Necessities</label><br>
		  <input type="checkbox" id="cloth" name="cate" value="cloth">
		  <label for="cloth">clothes</label><br>
		  <input type="checkbox" id="stat" name="cate" value="stat">
		  <label for="stat">Stationery</label><br>
		  <input type="checkbox" id="other" name="cate" value="other">
		  <label for="other">Others</label><br>

	      <p>Type:</p>
	      <input type="radio" id="new" name="type" value="new" required>
		  <label for="new">New</label><br>
		  <input type="radio" id="2h" name="type" value="2h">
		  <label for="2h">Second-hand</label><br>
		  <br>
		  <label for="Price">Set your Price:</label><br>
		  <input type="number" id="price" name="price" min="0" required><br>
		  <br>
		  <label for="info">Additional infomation:(Optional)</label><br>
		  <textarea rows="6" cols="50" name="info">Additional information...</textarea>
		  <br><br>

		  <input type="submit" value="Submit" onclick="ValidateSelection()">&emsp;&emsp;
		  <input type="reset">
	  </div>
	</form>
	</div>
	</div>
<script type="text/javascript">  
function ValidateSelection()  
{  
    var checkboxes = document.getElementsByName("cate");  
    var numberOfCheckedItems = 0;  
    for(var i = 0; i < checkboxes.length; i++)  
    {  
        if(checkboxes[i].checked)  
            numberOfCheckedItems++;  
    }  
    if(numberOfCheckedItems <1)  
    {  
        alert("Please select at least one category");  
		event.preventDefault()
        return false;  
    }  
}  

var loadFile = function(event) {
	var image = document.getElementById('output');
	image.src = URL.createObjectURL(event.target.files[0]);
};
</script>
	
</body>


</html>