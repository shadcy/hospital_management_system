<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Email</title>
</head>
<body>
    <form class="" action="send.php" method="post">
        <br>
        Email <input type="text " name="email " value=""> <br>
        Subject <input type="text" name="subject" value=""> <br>
        Message <input type="text " name="message " value=""> <br>

        <button type="submit" name="Send"></button>
    </form>
</body>
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Email</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(to bottom right,gray, #fff);
        }

        form {
            width: 100%;
            max-width: 600px;
            padding: 40px;
            margin: auto;
            border-radius: 4px;
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.5);
            box-shadow: 0 8px 32px 0 gray;
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        input[type="text"] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="text"][name="message"] {
            height: 100px; /* Adjust the height as per your requirement */
        }

        button[type="submit"] {
            width: 100%;
            background-color: blue;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: blue;
        }
    </style>
</head>
<body>
    <form class="" action="send.php" method="post">
        <br>
        Email <input type="text" name="email" value=""> <br>
        Subject <input type="text" name="subject" value=""> <br>
        Message <input type="text" name="message" value=""> <br>

        <button type="submit" name="send">Send</button>
    </form>
</body>
</html>
