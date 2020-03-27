var modal = document.getElementById("register-modal");
var btn = document.getElementById("register-modal-button");
var span = document.getElementsByClassName("close")[0];

btn.onclick = function() {
  modal.style.display = "block";
};

span.onclick = function() {
  modal.style.display = "none";
};

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};

$("#register-form").on("submit", function(event) {
  event.preventDefault();
  $.ajax({
    url: "/member/registerprocess.php",
    type: "POST",
    data: $("#register-form").serialize(),
    success: function(data) {
      var dataObj = JSON.parse(data);
      if (dataObj["usernameErr"] != "") {
        $("#usernameErr").html(dataObj["usernameErr"]);
      }
      if (dataObj["passwordErr"] != "") {
        $("#passwordErr").html(dataObj["passwordErr"]);
      }
      if (dataObj["passwordConfirmErr"] != "") {
        $("#passwordConfirmErr").html(dataObj["passwordConfirmErr"]);
      }
      if (dataObj["emailErr"] != "") {
        $("#emailErr").html(dataObj["emailErr"]);
      }
      if (dataObj["canSubmit"] == 1) {
        window.location.reload();
      }
    }
  });
});
