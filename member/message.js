var msgboxbtn = document.getElementsByClassName("messagebox-button");
var msgbox = document.getElementsByClassName("messagebox");
var msginput = document.getElementById("message-input");
var msgsubmit = document.getElementById("message-submit");
var msgreceiveid = document.getElementById("message-receive");
var msgpid = document.getElementById("message-pid");

for (var i = 0; i < msgboxbtn.length; i++)
  (function (i) {
    msgboxbtn[i].onclick = function () {
      msgbox[i].style.display = "block";
      msginput.style.display = "inline-block";
      msgsubmit.style.display = "inline-block";
      var temp = msgboxbtn[i].innerHTML;
      temp = temp.split(" ").slice(-1);
      msgreceiveid.value = temp;
      temp = msgboxbtn[i].innerHTML;
      temp = temp.split(" ").slice(0, 1);
      msgpid.value = temp;
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
    success: function () {
      alert("Message sent!");
      window.location.reload();
    },
  });
});
