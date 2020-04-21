var modal = document.getElementById("icon-modal");
var btn = document.getElementById("icon-modal-button");

btn.onclick = function () {
  modal.style.display = "block";
};

window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};
