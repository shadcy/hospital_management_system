<div class="mainContainer">

    <div class="left">




        <form action="mail.php" method="post">
            <label for="recipientName">Student's Name:</label>
            <input type="text" id="recipientName" required>
            <label for="achievement">Reason:</label>
            <input type="text" id="achievement" required>
            <label for="studentroll">Student's Roll No:</label>
            <input type="text" id="studentroll" required>
            <label for="doctorname">Doctor's Name:</label>
            <input type="text" id="doctorname" value="<?php echo $doctorName; ?>">
            <br><br>
            <div class="button-container">



                <div class="col-lg-4 col-md-6">

                    <div class="mt-3">
                        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBoth" aria-controls="offcanvasBoth">
                            Generate
                        </button>
                        <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasBoth" aria-labelledby="offcanvasBothLabel">
                            <div class="offcanvas-header">
                                <h5 id="offcanvasBothLabel" class="offcanvas-title">IIT Bombay Hospital</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <br>
                            <div class="offcanvas-body my-auto mx-0 flex-grow-0">
                                <p class="text-center">

                                    IIT Bombay Hospital Management System
                                <div class="format-selector">
                                    <label for="format">Download Format:
                                        <select id="format">
                                            <!-- <option value="pdf">PDF</option> -->
                                            <option value="png">PNG</option>
                                            <option value="jpeg">JPEG</option>
                                            <option value="pdf">PDF</option>
                                        </select></label>
                                </div>
                                <br>
                                </p>
                                <button type="button" class="btn btn-primary mb-2 d-grid w-100" onclick="generateCertificate()">Generate</button>

                                <button type="button" class="btn btn-primary mb-2 d-grid w-100" onclick="downloadCertificate()">Download</button>


                                <button type="button" class="btn btn-outline-secondary d-grid w-100" data-bs-dismiss="offcanvas">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </form>





        <div id="signatureContainer">
            <canvas id="signatureCanvas" width="450" height="225"></canvas>
            <div id="signatureInstructions">Click and drag to draw your signature</div>
        </div>
    </div>


</div> <canvas id="pinkslip" width="800" height="600"></canvas>

</div>