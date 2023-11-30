var signatureCanvas = document.getElementById("signatureCanvas");
var signatureCtx = signatureCanvas.getContext("2d");
var isDrawing = false;
var lastX = 0;
var lastY = 0;

var oldRollNumber = "";
var studentInfo;
var debug = true;

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

function clearSignatureCanvas() {
  signatureCtx.clearRect(0, 0, signatureCanvas.width, signatureCanvas.height);
  isDrawing = false;
  lastX = 0;
  lastY = 0;
}

function fillVerticalList(ctx, list, X, yStart, yGap) {
  for (const [index, value] of list.entries()) {
    ctx.fillText(value, X, yStart + index * yGap);
  }
}

async function generateCertificate() {
  // Retrieve input values
  var studentroll = document
    .getElementById("studentroll")
    .value.toUpperCase()
    .trim();

  if (studentroll === "" || !/^[0-9]{2}[A-Z]?[0-9]{4,}$/.test(studentroll)) {
    alert("Please enter a valid roll number.");
    return false;
  }

  var fromDate = document.getElementById("fromDate").value;
  var toDate = document.getElementById("toDate").value;

  if (fromDate === "") {
    alert("Please enter the validity period.");
    return false;
  }

  if (studentroll !== oldRollNumber) {
    try {
      studentInfo = await $.ajax({
        type: "GET",
        url: "get_student.php",
        data: { roll: studentroll },
        dataType: "json",
      });
    } catch (err) {
      alert(err.responseJSON.error);
      return false;
    }
  }

  oldRollNumber = studentroll;

  var achievement = document.getElementById("achievement").value;
  var doctorname = document.getElementById("doctorname").value;

  const isValidForOneDay = fromDate === toDate;
  // Get canvas and context
  var canvas = document.getElementById("pinkslip");
  var ctx = canvas.getContext("2d");

  let centerX = canvas.width / 2;
  let xGap = canvas.width / 8;
  let yGap = canvas.height / 20;
  let centerXWOffset = centerX - xGap;

  // Clear the canvas
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  // Draw certificate border
  ctx.strokeStyle = "black";
  ctx.lineWidth = 5;

  // Draw certificate header
  ctx.font = "bold 40px Arial";
  ctx.textAlign = "center";
  ctx.fillText("MEDICAL CERTIFICATE", centerX, 150);

  let yStart = 190;
  // Draw student's name
  ctx.font = "bold 20px Arial";
  ctx.textAlign = "left";
  fillVerticalList(
    ctx,
    [
      "Student's Name",
      "Student's Roll No",
      "Department",
      "Doctor [M.B.B.S]",
      "Validity",
    ],
    xGap,
    yStart,
    yGap
  );

  fillVerticalList(
    ctx,
    [":", ":", ":", ":", ":"],
    centerXWOffset - 20,
    yStart,
    yGap
  );

  // Draw student's roll number
  fillVerticalList(
    ctx,
    [
      studentInfo.name,
      studentInfo.rollNumber,
      studentInfo.department,
      doctorname,
      isValidForOneDay ? fromDate : `${fromDate} to ${toDate}`,
    ],
    centerXWOffset,
    yStart,
    yGap
  );

  // Draw achievement title
  ctx.textAlign = "center";
  ctx.font = "15px Arial";
  ctx.fillText(`REASON FOR PINKSLIP : ${achievement}`, centerX, 390);

  // Draw version control : for better optimization
  ctx.font = "bold 15px Arial";
  ctx.textAlign = "right";
  ctx.fillText("FORMAT : V5", canvas.width, 600);

  ctx.drawImage(
    signatureCanvas,
    canvas.width / 6 + 5,
    (2 * canvas.height) / 3 + 10,
    200,
    100
  );
}

async function downloadCertificate() {
  if ((await generateCertificate()) === false) return;
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
  doc.text(
    " ♥ Medical Certificate IITB",
    doc.internal.pageSize.getWidth() / 2,
    40,
    {
      align: "center",
    }
  );

  doc.setFontSize(16);
  doc.text(
    "Recipient's Name: " + document.getElementById("recipientName").value,
    20,
    60
  );
  doc.text(
    "Achievement: " + document.getElementById("achievement").value,
    20,
    80
  );

  doc.text(
    "studentroll: " + document.getElementById("studentroll").value,
    20,
    80
  );
  doc.text(
    "doctorname: " + document.getElementById("doctorname").value,
    20,
    80
  );

  // Draw signature image on the PDF

  signatureImage.src = signatureCanvas.toDataURL();
  signatureImage.onload = function () {
    doc.addImage(
      signatureImage,
      "PNG",
      doc.internal.pageSize.getWidth() / 2 - 40,
      90,
      80,
      40
    );

    // Save the PDF and initiate download
    doc.save("PinkSlip.pdf");
  };
}

async function downloadAsImage(format) {
  var overlayCanvas = document.getElementById("pinkslip");
  var studentroll = document.getElementById("studentroll").value;

  let canvas = document.createElement("canvas");
  canvas.height = overlayCanvas.height; //get original canvas height
  canvas.width = overlayCanvas.width; // get original canvas width

  var ctx = canvas.getContext("2d");

  let backgroundImage = new Image();

  backgroundImage.crossOrigin = "anonymous";
  backgroundImage.src =
    "/assets/images/pink_slip.png";

  backgroundImage.onload = async function () {
    ctx.drawImage(backgroundImage, 0, 0, canvas.width, canvas.height);
    ctx.drawImage(overlayCanvas, 0, 0);

    let image;
    if (format === "png") {
      image = canvas.toDataURL("image/png");
    } else if (format === "jpeg") {
      image = canvas.toDataURL("image/jpeg", 1.0);
    }
    var link = document.createElement("a");
    link.href = await encryptImage(image);
    link.download = `${studentroll}_PinkSlip.${format}`;
    link.click();
  };
}

async function encryptImage(dataURL) {
  let [fileType, imageBinaryString] = dataURL.split(",");
  // Make an AJAX call to encrypt.php
  const response = await $.ajax({
    type: "POST",
    url: "crypt_api.php",
    data: { method: "enc", image: imageBinaryString },
    dataType: "json",
  });
  return fileType + "," + response.imageData;
}
