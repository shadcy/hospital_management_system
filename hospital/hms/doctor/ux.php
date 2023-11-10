<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail Sent Successfully</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f3f4f6;
            font-family: Arial, sans-serif;
        }

        .card {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .tickSvg {
            width: 80px;
            height: 80px;
        }

        .message {
            margin-top: 20px;
            text-align: center;
            color: #333;
        }

        .buttonContainer {
            display: flex;
            margin-top: 20px;
        }

        .acceptButton,
        .declineButton {
            padding: 10px 20px;
            margin: 0 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .acceptButton {
            background-color: #4caf50;
            color: #fff;
        }

        .declineButton {
            background-color: #f44336;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="card">
        <svg class="tickSvg" version="1.1" id="tickSvg" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
            <path d="M472.036,113.299c-15.66-15.66-41.076-15.66-56.736,0L192.073,361.645l-91.972-91.972c-15.66-15.66-41.076-15.66-56.736,0
            c-15.66,15.66-15.66,41.076,0,56.736l109.653,109.653c7.83,7.83,18.12,11.745,28.368,11.745c10.245,0,20.538-3.915,28.368-11.745
            l287.436-287.436C487.696,154.375,487.696,128.959,472.036,113.299z" fill="#4CAF50" />
        </svg>
        <p class="message">Mail has been sent successfully</p>
        <div class="buttonContainer">
            <button class="acceptButton"><a href="dashboard.php" style="text-decoration:none; color:white;">Dashboard</a></button>
            <button class="acceptButton"><a href="mail.php" style="text-decoration:none; color:white;">Mail</a></button>
            <button class="acceptButton"><a href="gen.php" style="text-decoration:none; color:white;">Pinkslip</a></button>
            <button class="acceptButton"><a href="ambulance.php" style="text-decoration:none; color:white;">Ambulance</a></button>
        </div>
    </div>
</body>

</html>