var modal = document.getElementById("modifyinfo-modal");
var btn = document.getElementById("modifyinfo-modal-button");

btn.onclick = function () {
  modal.style.display = "block";
};

window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};

$("#modifyinfo-form").on("submit", function (event) {
  event.preventDefault();
  $.ajax({
    url: "/member/modifyinfoprocess.php",
    type: "POST",
    data: $("#modifyinfo-form").serialize(),
    success: function (data) {
      var dataObj = JSON.parse(data);
      if (dataObj["telephoneErr"] != "") {
        $("#telephoneErr1").html(dataObj["telephoneErr"]);
      }
      if (dataObj["passwordErr"] != "") {
        $("#passwordErr1").html(dataObj["passwordErr"]);
      }
      if (dataObj["passwordConfirmErr"] != "") {
        $("#passwordConfirmErr1").html(dataObj["passwordConfirmErr"]);
      }
      if (dataObj["emailErr"] != "") {
        $("#emailErr1").html(dataObj["emailErr"]);
      }
      if (dataObj["canSubmit"] == 1) {
        window.location.reload();
      }
    },
  });
});
