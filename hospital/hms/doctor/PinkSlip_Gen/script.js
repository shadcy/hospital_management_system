var signatureCanvas = document.getElementById("signatureCanvas");
var signatureCtx = signatureCanvas.getContext("2d");
var isDrawing = false;
var lastX = 0;
var lastY = 0;

// var images = ['pink_slip.png'];
// var loadedImages = {};
// var promiseArray = images.map(function (imgurl) {
//   var prom = new Promise(function (resolve, reject) {
//     var img = new Image();
//     img.onload = function () {
//       loadedImages[imgurl] = img;
//       resolve();
//     };
//     img.src = imgurl;
//   });
//   return prom;
// });

// Promise.all(promiseArray);

signatureCanvas.addEventListener("mousedown", (e) => {
  isDrawing = true;
  [lastX, lastY] = [e.offsetX, e.offsetY];
});

signatureCanvas.addEventListener("mousemove", drawSignature);

signatureCanvas.addEventListener("mouseup", () => {
  isDrawing = false;
});

signatureCanvas.addEventListener("mouseout", () => {
  isDrawing = false;
});

function drawSignature(e) {
  if (!isDrawing) return;
  signatureCtx.beginPath();
  signatureCtx.moveTo(lastX, lastY);
  signatureCtx.lineTo(e.offsetX, e.offsetY);
  signatureCtx.strokeStyle = "#000";
  signatureCtx.lineWidth = 2;
  signatureCtx.stroke();
  [lastX, lastY] = [e.offsetX, e.offsetY];
}

function generateCertificate() {
  // Retrieve input values
  var recipientName = document.getElementById("recipientName").value;
  var achievement = document.getElementById("achievement").value;
  var studentroll = document.getElementById("studentroll").value;
  var doctorname = document.getElementById("doctorname").value;

  // Get canvas and context
  var canvas = document.getElementById("pinkslip");
  var ctx = canvas.getContext("2d");

  // Clear the canvas
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  // Draw certificate border
  ctx.strokeStyle = "black";
  ctx.lineWidth = 5;
  ctx.strokeRect(50, 50, 700, 500);

  // Draw certificate header
  ctx.font = "bold 40px Arial";
  ctx.textAlign = "center";
  ctx.fillText("MEDICAL CERTIFICATE", canvas.width / 2, 150);

  // Draw student's name
  ctx.font = "bold 20px Arial";
  ctx.fillText("Student's Name     :", canvas.width / 3.7, 250);
  ctx.fillText(recipientName, canvas.width / 1.6, 250);

  // Draw student's roll number
  ctx.font = "bold 20px Arial";
  ctx.fillText("Student's Roll No  :", canvas.width / 3.7, 290);
  ctx.fillText(studentroll, canvas.width / 1.6, 290);

  // Draw Doctor
  ctx.font = "bold 20px Arial";
  ctx.fillText("Doctor [M.B.B.S]   :", canvas.width / 3.7, 330);
  ctx.fillText(doctorname, canvas.width / 1.6, 330);


  // Draw achievement title
  ctx.font = "15px Arial";
  ctx.fillText("REASON FOR PINKSLIP", canvas.width / 2, 400);
  ctx.fillText(achievement, canvas.width / 2, 450);



  // Draw version control : for better optimization
  ctx.font = "bold 15px Arial";
  ctx.fillText("FORMAT : V4.2.5", canvas.width / 1.101, 600);

  ctx.drawImage(signatureCanvas, canvas.width / 2.6 - 220, 390, 240, 120);
}

function downloadCertificate() {
  generateCertificate();
  var format = document.getElementById("format").value;

  if (format === "pdf") {
    downloadAsPDF();
  } else if (format === "png") {
    downloadAsImage("png");
  } else if (format === "jpeg") {
    downloadAsImage("jpeg");
  }
}

function downloadAsPDF() {
  var doc = new jsPDF();

  // Add certificate content to the PDF
  doc.setFontSize(20);
  doc.text(" ♥ Medical Certificate IITB", doc.internal.pageSize.getWidth() / 2, 40, {
    align: "center"
  });

  doc.setFontSize(16);
  doc.text("Recipient's Name: " + document.getElementById("recipientName").value, 20, 60);
  doc.text("Achievement: " + document.getElementById("achievement").value, 20, 80);

  doc.text("studentroll: " + document.getElementById("studentroll").value, 20, 80);
  doc.text("doctorname: " + document.getElementById("doctorname").value, 20, 80);

  // Draw signature image on the PDF

  signatureImage.src = signatureCanvas.toDataURL();
  signatureImage.onload = function () {
    doc.addImage(signatureImage, "PNG", doc.internal.pageSize.getWidth() / 2 - 40, 90, 80, 40);

    // Save the PDF and initiate download
    doc.save("PinkSlip.pdf");
  };
}



function downloadAsImage(format) {
  var overlayCanvas = document.getElementById("pinkslip");
  var studentroll = document.getElementById("studentroll").value;

  let canvas = document.createElement("canvas");
  canvas.height = 640; //get original canvas height
  canvas.width = 840; // get original canvas width

  var ctx = canvas.getContext("2d");

  let backgroundImage = new Image();

  backgroundImage.crossOrigin = 'anonymous';
  backgroundImage.src = "https://i.imgur.com/DFGdARj.png";

  backgroundImage.onload = function () {
    ctx.drawImage(backgroundImage, 0, 0, canvas.width, canvas.height);
    ctx.drawImage(overlayCanvas, 20, 20);

    if (format === "png") {
      var image = canvas.toDataURL("image/png");
      var link = document.createElement("a");
      link.href = image;
      link.download = studentroll + "_PinkSlip.png";
      link.click();
    } else if (format === "jpeg") {
      var image = canvas.toDataURL("image/jpeg", 1.0);
      var link = document.createElement("a");
      link.href = image;
      link.download = studentroll + "_PinkSlip.jpeg";
      link.click();
    }
  }
}
// function downloadAsImage(format) {
//   var canvas = document.getElementById("canvas");
//   var ctx = canvas.getContext("2d");
//   var studentroll = document.getElementById("studentroll").value;

//   var backgroundImage = new Image();
//   backgroundImage.src = "pink_slip.png"; // Assuming pinkslip.png is in the same directory

//   // Wait for the image to load before drawing it on the canvas
//   backgroundImage.onload = function () {
//     ctx.drawImage(backgroundImage, 0, 0, canvas.width, canvas.height);

//     if (format === "png") {
//       var image = canvas.toDataURL("image/png");
//       var link = document.createElement("a");
//       link.href = image;
//       link.download = studentroll + "_PinkSlip.png";
//       link.click();
//     } else if (format === "jpeg") {
//       var image = canvas.toDataURL("image/jpeg", 1.0);
//       var link = document.createElement("a");
//       link.href = image;
//       link.download = studentroll + "_PinkSlip.jpeg";
//       link.click();
//     }
//   };
// }



// function downloadAsImage(format) {
//   var canvas = document.getElementById("canvas");

//   if (format === "png") {
//     var image = canvas.toDataURL("image/png");
//     var link = document.createElement("a");
//     link.href = image;
//     link.download = recipientName + "_PinkSlip.png";
//     link.click();
//   } else if (format === "jpeg") {
//     var image = canvas.toDataURL("image/jpeg", 1.0);
//     var link = document.createElement("a");
//     link.href = image;
//     link.download = recipientName +"_PinkSlip.jpeg";
//     link.click();
//   }
// }