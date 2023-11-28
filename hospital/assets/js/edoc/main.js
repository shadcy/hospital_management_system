const BACKGROUND_COLOR = "rgba(0,0,0,0)";

const fabCanvas = new fabric.Canvas("pageCanvas", {
  isDrawingMode: true,
  backgroundColor: BACKGROUND_COLOR,
  perPixelTargetFind: true,
  myProps: {
    mode: "draw",
    color: "black",
    width: 5,
  },
});


fabCanvas.cstmSetBackground("edoc/prototyp.png");

function redoState() {
  fabCanvas.freeDrawingBrush =
    fabCanvas.myProps.mode === "erase"
      ? new fabric.EraserBrush(fabCanvas)
      : new fabric.PencilBrush(fabCanvas);

  fabCanvas.freeDrawingBrush.width = fabCanvas.myProps.width;
  fabCanvas.freeDrawingBrush.color =
    fabCanvas.myProps.mode === "draw"
      ? fabCanvas.myProps.color
      : "rgba(0,0,0,0)";

  document.querySelectorAll(".modeBtn").forEach((btn) => {
    btn.classList.remove("current");
  });
  document
    .getElementById(`${fabCanvas.myProps.mode}Btn`)
    .classList.add("current");
}







function resizeCanvas() {
  const canvas = document.getElementById('pageCanvas');
  canvas.width = canvas.offsetWidth;
  canvas.height = canvas.offsetHeight;
  // Add your drawing/rendering logic here if needed
}

// Initial call to set canvas size
resizeCanvas();









document.getElementById("drawBtn")?.addEventListener("click", () => {
  fabCanvas.isDrawingMode = true;
  fabCanvas.myProps.mode = "draw";
  fabCanvas.freeDrawingBrush.color = "black"; // Set drawing color
  redoState();
});

document.getElementById("objecteraseBtn")?.addEventListener("click", () => {
  fabCanvas.isDrawingMode = true;
  fabCanvas.myProps.mode = "objecterase";
  fabCanvas.freeDrawingBrush.color = "rgba(0,0,0,0)"; // Set eraser color (white to match fabCanvas background)
  redoState();
});

document.getElementById("eraseBtn")?.addEventListener("click", () => {
  fabCanvas.isDrawingMode = true;
  fabCanvas.myProps.mode = "erase";
  fabCanvas.freeDrawingBrush.color = BACKGROUND_COLOR; // Set eraser color (white to match fabCanvas background)
  redoState();
});

document.getElementById("undoBtn")?.addEventListener("click", () => {
  fabCanvas.cstmUndo();
});

document.getElementById("redoBtn")?.addEventListener("click", () => {
  fabCanvas.cstmRedo();
});

fabCanvas.on("mouse:move", function (options) {
  if (
    fabCanvas.myProps.mode === "objecterase" &&
    (options.e.buttons & 1) === 1
  ) {
    // When in Erase mode, remove the object (stroke) at the clicked position
    const target = fabCanvas.findTarget(options.e, false);
    fabCanvas.remove(target);
  }
});

redoState(); //Set the initial value
window.addEventListener('resize', resizeCanvas);

// document.getElementById("exportForm")?.addEventListener("click", () => {
//   // Get the data URL of the canvas
//   const dataURL = fabCanvas.toDataURL({
//     format: "png",
//     multiplier: 2, // Increase the multiplier for higher resolution
//   });

//   // Create a link element
//   const link = document.createElement("a");

//   // Set the href attribute to the data URL
//   link.href = dataURL;

//   // Set the download attribute with a desired filename (e.g., drawing.png)
//   link.download = "drawing.png";

//   // Append the link to the document
//   document.body.appendChild(link);

//   // Trigger a click on the link to start the download
//   link.click();

//   // Remove the link from the document
//   document.body.removeChild(link);
// });



// Add an input field for the filename
const filenameInput = document.getElementById("filenameInput");

document.getElementById("exportForm")?.addEventListener("click", () => {
  // Get the data URL of the canvas
  const dataURL = fabCanvas.toDataURL({
    format: "png",
    multiplier: 2, // Increase the multiplier for higher resolution
  });

  // Get the filename from the input field or use a default if not provided
  const filename = filenameInput.value || "NoName";

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
