const input = document.querySelector('[type="color"]');
const inputRange = document.querySelector('[type="range"]');
// const selectLineCap = document.querySelector("select");

function setWidth(width) {
  fabCanvas.myProps.width = parseInt(width, 10);
  fabCanvas.freeDrawingBrush.width = fabCanvas.myProps.width;
  inputRange.value = fabCanvas.myProps.width;
}

function setColor(event, color) {
  // Use the selected color
  fabCanvas.myProps.color = input.value;
  if (fabCanvas.myProps.mode === "draw")
    fabCanvas.freeDrawingBrush.color = color;

  document.querySelectorAll(".color-preset").forEach(function (preset) {
    preset.classList.remove("selected");
  });

  if (event.target.classList.contains("color-preset")) {
    // Apply the selected class to the clicked color preset
    event.target.classList.add("selected");
  }
}

document.getElementById("exportForm")?.addEventListener("click", () => {
  // Get the data URL of the canvas
  const dataURL = fabCanvas.toDataURL({
    format: "png",
    multiplier: 2, // Increase the multiplier for higher resolution
  });

  // Add the AJAX request to upload to Google Cloud Storage
  uploadToGoogleCloud(dataURL);
});

// Function to upload to Google Cloud Storage
function uploadToGoogleCloud(dataURL) {
  const urlParams = new URLSearchParams(window.location.search);
  const apptId = urlParams.get('id');

  // Make an AJAX request to your PHP API endpoint
  $.ajax({
    type: "POST",
    url: '/api/doctor/submit_prescription.php',
    data: {
      id: apptId, // Replace with the actual value
      data: dataURL,
    },
    dataType: "json",
    success: function (response) {
      if (response.success) {
        confirmationMessage = 'The appointment has ended.';
        window.location.href = 'dashboard.php';
      } else {
        // Handle the case where the upload was not successful
        console.error('Upload failed:', data.error);
      }
    },
  })
    .catch(error => {
      // Handle errors
      console.error('Error:', error);
    });
}


fabCanvas.cstmSetBackground("edoc/prescription-sheet.png");
fabCanvas.toLocal = true;