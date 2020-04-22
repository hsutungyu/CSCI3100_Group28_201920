var modal1 = document.getElementById("icon-modal");
var btn1 = document.getElementById("icon-modal-button");
var span1 = document.getElementsByClassName("close1")[0];
var imageErr = document.getElementById("imageErr");

btn1.onclick = function () {
  modal1.style.display = "block";
};

window.onclick = function (event) {
  if (event.target == modal1) {
    modal1.style.display = "none";
  }
};

span1.onclick = function () {
  modal1.style.display = "none";
};

$("#icon-form").on("submit", function (event) {
  event.preventDefault();
  var formData = new FormData(this);
  $.ajax({
    url: "/member/uploadprocess.php",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (data) {
      var dataObj = JSON.parse(data);
      if (dataObj["imageErr"] != "") {
        $("#imageErr").html(dataObj["imageErr"]);
      }
      if (dataObj["canSubmit"] == 1) {
        window.location.reload();
      }
    },
  });
});
