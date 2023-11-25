<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>
<!-- <link rel="stylesheet" href="./style.css"> -->
<style>
    .mainContainer {
        display: relative;
        justify-content: left;
        background-color: #f0f0f0;
        padding: 0%;
    }

    h1 {
        text-align: center;
        color: #333;

    }

    a {
        text-decoration: none;
        color: black;
    }

    form {

        max-width: 450px;
        /* margin: 0 auto;
        background-color: #fff;
        padding: 2%;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); */

    }

    label {
        display: block;
        margin-bottom: 10px;
        color: #333;
    }

    input[type="text"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        /* margin-bottom: 20px; */
    }

    .button-container {
        /* display: flex; */
        justify-content: space-between;

    }

    .format-selector {
        margin-top: 10px;
        margin: 10px;
    }


    #pinkslip {
        display: block;
        margin: 1.5% auto;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        background-image: url('pink_slip.png');
        background-size: cover;
        background-position: center;
        padding: 1%;
        max-width: 100%;

        background-repeat: no-repeat;

    }


    .certificate-title {
        font-size: 24px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
    }

    .recipient-name {
        font-size: 20px;
        text-align: center;
        margin-bottom: 10px;
    }

    .achievement {
        font-size: 18px;
        text-align: center;
        margin-bottom: 30px;
    }

    .signature {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .signature img {
        width: 200px;
        height: 100px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .date {
        text-align: right;
        font-style: italic;
        color: #888;
    }

    /* #signatureContainer {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 5%;
        text-align: center;


    } */

    #signatureCanvas {
        border: 1px solid #ccc;
        background: #fff;
        border-radius: 4px;
        margin: 10px auto;

        width: 450px;
    }

    #signatureInstructions {
        color: black;
        font-style: italic;
        margin-top: 10px;
    }

    .left {
        float: left;
        padding: 0%;
    }

    .right {
        position: flex;

    }
</style>