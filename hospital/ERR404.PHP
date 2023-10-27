<!DOCTYPE html>
<html>

<head>
    <style>
        :root {
            --verdigris: #43BFC7;
        }

        body {
            background-color: var(--verdigris);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .error-container {
            text-align: center;
            color: white;
        }

        .error-code {
            font-size: 120px;
            font-weight: bold;
            margin: 0;
        }

        .error-message {
            font-size: 36px;
            margin: 20px 0;
        }

        .button-container {
            margin-top: 20px;
        }

        .button {
            background-color: white;
            color: var(--verdigris);
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: var(--verdigris);
            color: white;
            text-align: center;
            padding: 10px 0;
        }

        :root {
            --verdigris: #43BFC7;
            --text-color: white;
        }

        body {
            background-color: var(--verdigris);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: var(--text-color);
        }

        .error-container {
            text-align: center;
        }

        .error-code {
            font-size: 120px;
            font-weight: bold;
            margin: 0;
        }

        .error-message {
            font-size: 36px;
            margin: 20px 0;
        }
    </style>
</head>

<body>

    <div class="error-container">
        <h1 class="error-code">404</h1>
        <p class="error-message">Oops! The page you are looking for does not exist.</p>
        <div class="button-container">
           
            <a href="./hms/user-login.php">  <button class="button" onclick="window.location.href='student_login.html'">Student Login</button></a>
            <a href="./hms/doctor">      <button class="button" onclick="window.location.href='doctor_login.html'">Doctor Login</button></a>
            <a href="./hms/admin"> <button class="button" onclick="window.location.href='admin_login.html'">Admin Login</button></a>
          
            
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2023 IIT Bombay HMS All rights reserved.</p>
    </div>

</body>

</html>