const input = document.querySelector('[type="color"]');
const inputRange = document.querySelector('[type="range"]');
const backgroundSelectorEditor = document.getElementById(
  "background-select-editor"
);
const backgroundSelectorOuter = document.getElementById(
  "background-select-outer"
);
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

function setBackground(url) {
  fabCanvas.cstmSetBackground(url);
  backgroundSelectorOuter.value = url;
  backgroundSelectorEditor.value = url;
}

const filenameInput = document.getElementById("filenameInput");

document.getElementById("exportForm")?.addEventListener("click", () => {
  // Get the data URL of the canvas
  const dataURL = fabCanvas.toDataURL({
    format: "png",
    multiplier: 2, // Increase the multiplier for higher resolution
  });

  // Get the filename from the input field or use a default if not provided
  const filename = filenameInput.value || "untitled";

  // Create a link element
  const link = document.createElement("a");

  // Set the href attribute to the data URL
  link.href = dataURL;

  // Set the download attribute with the filename
  link.download = `${filename}.png`;

  // Append the link to the document
  document.body.appendChild(link);

  // Trigger a click on the link to start the download
  link.click();

  // Remove the link from the document
  document.body.removeChild(link);
});

fabCanvas.cstmSetBackground("edoc/prototyp.png");