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
        var imageBinaryString = e.target.result.split(",")[1];
        // Make an AJAX call to encrypt.php
        $.ajax({
            type: "POST",
            url: "crypt_api.php",
            data: { method: "enc", image: imageBinaryString },
            dataType: 'json',
            success: function (response) {
                var encryptedDataURL = "data:image/png;base64," + response.imageData;
                // Update UI with encrypted data
                updateUI("encrypted-image", "encrypted-link", encryptedDataURL);
            },
        });
    };
    reader.readAsDataURL(file);
}

function decryptImage() {
    var file = document.getElementById("image").files[0];
    var reader = new FileReader();
    reader.onload = function (e) {
        var encryptedBinaryString = e.target.result.split(",")[1];
        // Make an AJAX call to decrypt.php
        $.ajax({
            type: "POST",
            url: "crypt_api.php",
            data: { method: "dec", image: encryptedBinaryString },
            dataType: 'json',
            success: function (response) {
                var decryptedDataURL = "data:image/png;base64," + response.imageData;
                // Update UI with decrypted data
                updateUI("decrypted-image", "decrypted-link", decryptedDataURL);
            },
            error: function (xhr) {
                // Handle error
                if (xhr.status === 400)
                    alert(xhr.responseJSON.error);

                updateUI("decrypted-image", "decrypted-link", "");
            }
        });
    };
    reader.readAsDataURL(file);
}

function updateUI(imageId, linkId, dataURL) {
    var image = document.getElementById(imageId);
    var link = document.getElementById(linkId);
    image.src = dataURL;
    image.style.display = dataURL !== "" ? "block" : "none";
    link.href = dataURL;
    link.style.display = dataURL !== "" ? "inline" : "none";
}

function dragOverHandler(ev) {
    ev.preventDefault();
}

function dropHandler(ev) {
    ev.preventDefault();
    var file = ev.dataTransfer.files[0];
    document.getElementById('image').files = file;
    previewImage();
}