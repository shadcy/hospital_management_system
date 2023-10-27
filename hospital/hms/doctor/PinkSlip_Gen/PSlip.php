<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>IITB HMS</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>
  <link rel="stylesheet" href="./style.css">
  <style>
    /* Style for the navigation bar */
    .navbar {
      overflow: hidden;
      background-color: #0000ff;
      border-radius: 20px;
    }

    /* Style for the navigation bar links */
    .navbar a {
      float: left;
      display: block;
      color: #f2f2f2;
      border-radius: 20px;
      text-align: center;
      padding: 14px 20px;
      text-decoration: none;
    }

    /* Change the color of the navigation bar links on hover */
    .navbar a:hover {
      background-color: #ddd;
      color: black;
    }

    button {
      padding: 10px 20px;
      background-color: #0000ff;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #0000ff;
    }
  </style>

</head>

<body>
  <header>
    <!-- Header Section with Navigation Bar -->
    <div class="navbar">
      <a href="#home">Home</a>
      <a href="#enc">Encryption</a>
      <a href="#db">DataBase</a>
      <a href="#admin">Admin</a>
      <a href="#">Verification</a>

      <a
        href=" https://www.canva.com/design/DAFx-3U4PbE/5dmDlF5Ev1_sS6dYy2424w/edit?utm_content=DAFx-3U4PbE&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton">PinkSlip
        Format</a>
    </div>

  </header>
  <!-- partial:index.partial.html -->
  <h1>IIT BOMBAY HOSPITAL MANAGEMENT SYSTEM | MEDICAL CERTIFICATE</h1>

  <div class="mainContainer">

    <div class="left">




      <form>
        <label for="recipientName">Student's Name:</label>
        <input type="text" id="recipientName" required>
        <label for="achievement">Reason:</label>
        <input type="text" id="achievement" required>
        <label for="studentroll">Student's Roll No:</label>
        <input type="text" id="studentroll" required>
        <label for="doctorname">Doctor's Name:</label>
        <input type="text" id="doctorname" required>
        <div class="button-container">
          <button type="button" onclick="generateCertificate()">Generate Certificate</button>
          <div class="format-selector">
            <label for="format">Download Format:</label>
            <select id="format">
              <option value="pdf">PDF</option>
              <option value="png">PNG</option>
              <option value="jpeg">JPEG</option>
            </select>
          </div>
          <button id="downloadButton" type="button" onclick="downloadCertificate()">Download Certificate</button>
        </div>
      </form>





      <div id="signatureContainer">
        <canvas id="signatureCanvas" width="450" height="225"></canvas>
        <div id="signatureInstructions">Click and drag to draw your signature</div>
      </div>
    </div>



  </div>




  <canvas id="pinkslip" width="800" height="600"></canvas>



  </div>


  <footer style="background-color:  #0000ff;     overflow: hidden;
   
    border-radius: 20px; padding: 20px; text-align: center; position: flex; bottom: 0; ;">
    <p>&copy; 2023 IITB HMS <a href=" http://nxt.nxtdevelopers.xyz"> Made with ♥ by SHREYASH </a></p>
  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>
  <!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js'></script>
  <script src="./script.js"></script>

</body>

</html>