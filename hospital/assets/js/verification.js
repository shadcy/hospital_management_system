function formatTimestamp(timestamp) {
  // Convert the timestamp to milliseconds
  var date = new Date(timestamp * 1000);

  // Define formatting options
  var options = {
    year: "numeric",
    month: "short",
    day: "numeric",
    hour: "2-digit",
    minute: "2-digit",
    second: "2-digit",
    timeZoneName: "short",
  };

  // Format the date
  var formattedDate = date.toLocaleDateString("en-US", options);

  return formattedDate;
}

function decryptImage() {
  var file = document.getElementById("image").files[0];
  var reader = new FileReader();
  reader.onload = function (e) {
    let [fileType, encryptedBinaryString] = e.target.result.split(",");
    // Make an AJAX call to decrypt.php
    $.ajax({
      type: "POST",
      url: "/api/encryption/decryption_api.php",
      data: { image: encryptedBinaryString },
      dataType: "json",
      success: function (response) {
        // If response data is empty, password was invalid
        let decryptedDataURL = fileType + "," + response.imageData;
        let dataString = `Doctor Name: <b>${response.doctor
          }</b><br>Generated at: ${formatTimestamp(response.timestamp)}`;

        // Update UI with decrypted data
        updateUI("pinkslip", "decrypted-link", decryptedDataURL, dataString);
      },
      error: function (xhr) {
        // Handle error
        if (xhr.status === 400) alert(xhr.responseJSON.error);

        updateUI("pinkslip", "decrypted-link", "", "");
      },
    });
  };
  reader.readAsDataURL(file);
}

function updateUI(imageId, linkId, dataURL, dataString) {
  var image = document.getElementById(imageId);
  var link = document.getElementById(linkId);
  var text = document.getElementsByName("decryption-metadata")[0];

  image.src = dataURL;
  image.style.display = dataURL !== "" ? "block" : "none";
  link.href = dataURL;
  link.style.display = dataURL !== "" ? "inline" : "none";
  text.innerHTML = dataString;
}

function dragOverHandler(ev) {
  ev.preventDefault();
}

function dropHandler(ev) {
  ev.preventDefault();
  var file = ev.dataTransfer.files[0];
  document.getElementById("image").files = file;
  previewImage();
}
