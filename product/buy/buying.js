window.onload = function () {
  document.getElementById("redir").value = window.location.href;
};

var cartbtn = document.getElementById("cart-button");
var favbtn = document.getElementById("fav-form-submit");

favbtn.onclick = function (event) {
  event.preventDefault();
  $.ajax({
    url: "/product/buy/addfav.php",
    type: "POST",
    data: $("#fav-form").serialize(),
    success: function (data) {
      var dataObj = JSON.parse(data);
      if (dataObj["fav"] == 1) {
        $("#heart").html('<i class="fa fa-heart" aria-hidden="true"></i>');
        $("#heart").addClass("liked");
      } else {
        $("#heart").html('<i class="fa fa-heart-o" aria-hidden="true"></i>');
        $("#heart").removeClass("liked");
      }
    },
  });
};
