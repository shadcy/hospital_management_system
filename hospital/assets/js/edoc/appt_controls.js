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

  showLoadingIndicator();

  // Add the AJAX request to upload to Google Cloud Storage
  uploadToGoogleCloud(dataURL);
});

// Function to upload to Google Cloud Storage
function uploadToGoogleCloud(dataURL) {
  // Make an AJAX request to your PHP API endpoint
  $.ajax({
    type: "POST",
    url: '/api/doctor/submit_prescription.php',
    data: {
      id: fabCanvas.myProps.localVars.appointmentId, // Replace with the actual value
      timestamp: fabCanvas.myProps.localVars.apptTimestamp,
      data: dataURL,
    },
    dataType: "json",
    success: function (response) {
      if (response.success) {
        hideLoadingIndicator();
        alert('The appointment has ended.');
        warnOnLeaving = false;
        window.location.href = 'appointment-history.php?filter=cmp';
      } else {
        // Handle the case where the upload was not successful
        alert(error.error);
      }
    },
  })
    .catch(error => {
      hideLoadingIndicator();
      // Handle errors
      console.error('Error:', error);
    });
}

function showLoadingIndicator() {
  document.getElementById("loadingIndicator").style.display = "block";
}

// Function to hide the loading indicator
function hideLoadingIndicator() {
  document.getElementById("loadingIndicator").style.display = "none";
}

fabCanvas.myProps.toLocal = true;
fabCanvas.authLocalSession = () => { return apptTimestamp == localStorage.getItem('apptTimestamp'); }
fabCanvas.myProps.localVars = { appointmentId, patientId, apptTimestamp };

if (false && JSON.parse(localStorage.getItem('apptVars') ?? '{}').appointmentId === appointmentId) // ;-;
{
  const prevCanvasHistory = JSON.parse(localStorage.getItem('apptCanvasHistory'));
  fabCanvas.historyInit(false);

  fabCanvas.historyUndo = prevCanvasHistory.hu;
  fabCanvas.historyRedo = prevCanvasHistory.hr;
  fabCanvas.historyNextState = prevCanvasHistory.hn;

  fabCanvas.historyProcessing = true;
  fabCanvas.loadFromJSON(fabCanvas.historyNextState).renderAll();
  fabCanvas.once("after:render", () => {
    fabCanvas.historyProcessing = false;
  });
} else {
  fabCanvas.add(new fabric.Textbox(`Name: ${patientInfo.fullName}`, {
    left: 125,
    top: 285,
    width: 900, // Set the width as desired
    fontSize: 40,
    fill: 'black',
    // Add other text properties as needed
  }));

  fabCanvas.add(new fabric.Textbox(`Gender: ${patientInfo.gender ?? "Not specified"}`, {
    left: 125,
    top: 330,
    width: 900, // Set the width as desired
    fontSize: 40,
    fill: 'black',
    // Add other text properties as needed
  }));

  fabCanvas.cstmSetBackground("edoc/prescription-sheet.png", false);
}
