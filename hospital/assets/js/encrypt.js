function previewImage() {
  var preview = document.getElementById("preview");
  var file = document.getElementById("image").files[0];
  var reader = new FileReader();
  reader.onload = function (e) {
    preview.src = e.target.result;
    preview.style.display = "block";
  };
  reader.readAsDataURL(file);
}

function encryptImage() {
  var file = document.getElementById("image").files[0];
  var reader = new FileReader();
  reader.onload = function (e) {
    let [fileType, imageBinaryString] = e.target.result.split(",");
    // Make an AJAX call to encrypt.php
    $.ajax({
      type: "POST",
      url: "crypt_api.php",
      data: { method: "enc", image: imageBinaryString },
      dataType: "json",
      success: function (response) {
        var encryptedDataURL = fileType + "," + response.imageData;
        // Update UI with encrypted data
        updateUI(
          "encrypted-image",
          "encrypted-link",
          encryptedDataURL,
          "enc_" + file.name
        );
      },
    });
  };
  reader.readAsDataURL(file);
}

function decryptImage() {
  var file = document.getElementById("image").files[0];
  var reader = new FileReader();
  reader.onload = function (e) {
    let [fileType, encryptedBinaryString] = e.target.result.split(",");
    // Make an AJAX call to decrypt.php
    $.ajax({
      type: "POST",
      url: "crypt_api.php",
      data: { method: "dec", image: encryptedBinaryString },
      dataType: "json",
      success: function (response) {
        var decryptedDataURL = fileType + "," + response.imageData;
        // Update UI with decrypted data
        updateUI(
          "decrypted-image",
          "decrypted-link",
          decryptedDataURL,
          "dec_" + file.name
        );
      },
      error: function (xhr) {
        // Handle error
        if (xhr.status === 400) alert(xhr.responseJSON.error);

        updateUI("decrypted-image", "decrypted-link", "");
      },
    });
  };
  reader.readAsDataURL(file);
}

function updateUI(imageId, linkId, dataURL, fileName) {
  var image = document.getElementById(imageId);
  var link = document.getElementById(linkId);

  image.src = dataURL;
  link.href = dataURL;
  if (dataURL === "") {
    image.style.display = "none";
    link.style.display = "none";
  } else {
    image.style.display = "block";
    link.style.display = "inline";
    link.setAttribute("download", fileName);
  }
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
