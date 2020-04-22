$("#transaction-form").on("submit", function (event) {
  event.preventDefault();
  $.ajax({
    url: "/product/buy/transactionprocess.php",
    type: "POST",
    data: $("#transaction-form").serialize(),
    success: function (data) {
      var dataObj = JSON.parse(data);
      if (dataObj["canSubmit"] == 1) {
        if (dataObj["paymethod"] == 1) {
          $("#transaction").html(
            "<a>Your preference has been recorded! Click here to arrange a pick up time with the seller.</a>"
          );
        } else {
          var str1 =
            "<a>Below is the FPS information of the seller. Please transfer the amount accordingly.</a><br><a>FPS: ";
          var str2 = str1.concat(dataObj["transfps"]);
          var str3 = "</a>";
          var str4 = str2.concat(str3);
          $("#transaction").html(str4);
        }
      } else {
        $("#trans1Err").html(dataObj["trans1Err"]);
      }
    },
  });
});
