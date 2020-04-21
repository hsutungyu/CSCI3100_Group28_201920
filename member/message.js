var msgboxbtn = document.getElementsByClassName("messagebox-button");
var msgbox = document.getElementsByClassName("messagebox");
var msginput = document.getElementById("message-input");
var msgsubmit = document.getElementById("message-submit");

for (var i = 0; i < msgboxbtn.length; i++)
  (function (i) {
    msgboxbtn[i].onclick = function () {
      msgbox[i].style.display = "block";
      msginput.style.display = "inline-block";
      msgsubmit.style.display = "inline-block";
      for (var j = 0; j < msgboxbtn.length; j++)
        (function (j) {
          if (i != j) {
            msgbox[j].style.display = "none";
          }
        })(j);
    };
  })(i);

$("#message-form").on("submit", function (event) {
  event.preventDefault();
  $.ajax({
    url: "/member/messageprocess.php",
    type: "POST",
    data: $("#message-form").serialize(),
    success: function (data) {
      var dataObj = JSON.parse(data);
      if (dataObj["canSubmit"] == 1) {
        window.location.reload();
      }
    },
  });
});
