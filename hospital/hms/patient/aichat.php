<?php
session_start();

if (getenv('ENVIRONMENT') !== "development") {
    error_reporting(0);
}

include('../include/config.php');
$userType = UserTypeEnum::Patient->value;

include_once("../include/check_login_and_perms.php");
if (!check_login_and_perms($userType)) {
    exit;
}

$userTypeString = UserTypeAsString[$userType] ?>
<!DOCTYPE html>


<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="/assets2/" data-template="vertical-menu-template-free">

<head>
    <title> <?php echo $userTypeString; ?> | NXT AI</title>

    <link rel="stylesheet" href="chatapi.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,1,0" />


    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />


    <meta name="description" content="" />
    <?php include('../include/csslinks.php'); ?>

    <style>
        .chat-container {
            max-width: 90%;
            margin: 10% auto;
            padding: 2%;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

        }

        .chatbox {
            list-style: none;
            margin: 0;
            padding: 10px;

        }

        .chat {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .incoming {
            flex-direction: row;
        }

        .material-symbols-outlined {
            margin-right: 10px;
            font-size: 24px;
        }

        .chat p {
            margin: 0;
            padding: 10px;
            background-color: #e6e6e6;
            border-radius: 8px;
        }

        .chat-input {
            display: flex;
            align-items: center;
            padding: 10px;
            border-top: 1px solid #ccc;

        }

        textarea {
            flex: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: none;
        }

        .material-symbols-rounded {
            cursor: pointer;
            font-size: 24px;
            margin-left: 10px;
            color: #007bff;
        }

        .progress {
            width: 100%;
            /* Adjust the width of the progress bar container */
        }
    </style>
    </style>
</head>

<body>



    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <?php include_once("./include/nav.php"); ?>

            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <?php include('../include/navbar.php'); ?>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Doctor/</span> NXT AI</h4>

                        <div class="col-xl">
                            <div class="card mb-4">
                                <div class="card-body">









                                    <ul class="chatbox">
                                        <li class="chat incoming">
                                            <span class="material-symbols-outlined">smart_toy</span>
                                            <p>Hi there 👋<br>I am Doctor's AI health assistant <br>How can I help you?</p>
                                        </li>
                                        <li class="chat incoming">
                                            <span class="material-symbols-outlined">smart_toy</span>
                                            <p>Shall I manage appointments for you? <a href="ambulance.php">Manage Appointments</a> </p>

                                        </li>
                                        <li class="chat incoming">
                                            <span class="material-symbols-outlined">smart_toy</span>
                                            <p>Drugs Info <a href="ambulance.php"> Info</a> </p>

                                        </li>
                                    </ul>



                                    <div class="progress">
                                        <div id="progress-bar" class="progress-bar bg-primary" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="chat-input">
                                        <textarea placeholder="Enter a message..." spellcheck="false" required></textarea>
                                        <span id="send-btn" class="material-symbols-rounded">send</span>
                                    </div>




                                    <div class="content-backdrop fade"></div>

                                    <!-- Content wrapper -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Layout page -->


                    <!-- Overlay -->
                    <div class="layout-overlay layout-menu-toggle"></div>
                </div>

            </div>
        </div>
    </div>


    <?php include('../include/links.php'); ?>

    <script>
        // Function to update the progress bar width
        function updateProgressBar() {
            var progressBar = document.getElementById('progress-bar');
            var width = 0;
            var interval = setInterval(function() {
                if (width >= 100) {
                    clearInterval(interval);
                } else {
                    width++;
                    progressBar.style.width = width + '%';
                    progressBar.setAttribute('aria-valuenow', width);
                }
            }, 50); // Adjust the interval as needed
        }

        // Call the function on page load
        window.onload = function() {
            updateProgressBar();
        };









        jQuery(document).ready(function() {
            Main.init();
            FormElements.init();
        });
    </script>
    <script>
        const chatbotToggler = document.querySelector(".chatbot-toggler");
        const closeBtn = document.querySelector(".close-btn");
        const chatbox = document.querySelector(".chatbox");
        const chatInput = document.querySelector(".chat-input textarea");
        const sendChatBtn = document.querySelector(".chat-input span");

        let userMessage = null; // Variable to store user's message
        const API_KEY = "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"; // Paste your API key here
        const inputInitHeight = chatInput.scrollHeight;

        const createChatLi = (message, className) => {
            // Create a chat <li> element with passed message and className
            const chatLi = document.createElement("li");
            chatLi.classList.add("chat", `${className}`);
            let chatContent = className === "outgoing" ? `<p></p>` : `<span class="material-symbols-outlined">smart_toy</span><p></p>`;
            chatLi.innerHTML = chatContent;
            chatLi.querySelector("p").textContent = message;
            return chatLi; // return chat <li> element
        }

        const generateResponse = (chatElement) => {
            const API_URL = "https://api.openai.com/v1/chat/completions";
            const messageElement = chatElement.querySelector("p");

            // Define the properties and message for the API request
            const requestOptions = {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": `Bearer ${API_KEY}`
                },
                body: JSON.stringify({
                    model: "gpt-3.5-turbo",
                    messages: [{
                        role: "user",
                        content: userMessage
                    }],
                })
            }

            // Send POST request to API, get response and set the reponse as paragraph text
            fetch(API_URL, requestOptions).then(res => res.json()).then(data => {
                console.log(data); //////////hata dena baad me
                messageElement.textContent = data.choices[0].message.content.trim();
            }).catch(() => {
                console.log(error);
                messageElement.classList.add("error");
                messageElement.textContent = "Oops! Something went wrong. Please try again.";
            }).finally(() => chatbox.scrollTo(0, chatbox.scrollHeight));
        }

        const handleChat = () => {
            userMessage = chatInput.value.trim(); // Get user entered message and remove extra whitespace
            if (!userMessage) return;

            // Clear the input textarea and set its height to default
            chatInput.value = "";
            chatInput.style.height = `${inputInitHeight}px`;

            // Append the user's message to the chatbox
            chatbox.appendChild(createChatLi(userMessage, "outgoing"));
            chatbox.scrollTo(0, chatbox.scrollHeight);

            setTimeout(() => {
                // Display "Thinking..." message while waiting for the response
                const incomingChatLi = createChatLi("Thinking...", "incoming");
                chatbox.appendChild(incomingChatLi);
                chatbox.scrollTo(0, chatbox.scrollHeight);
                generateResponse(incomingChatLi);
            }, 600);
        }

        chatInput.addEventListener("input", () => {
            // Adjust the height of the input textarea based on its content
            chatInput.style.height = `${inputInitHeight}px`;
            chatInput.style.height = `${chatInput.scrollHeight}px`;
        });

        chatInput.addEventListener("keydown", (e) => {
            // If Enter key is pressed without Shift key and the window 
            // width is greater than 800px, handle the chat
            if (e.key === "Enter" && !e.shiftKey && window.innerWidth > 800) {
                e.preventDefault();
                handleChat();
            }
        });

        sendChatBtn.addEventListener("click", handleChat);
        closeBtn.addEventListener("click", () => document.body.classList.remove("show-chatbot"));
        chatbotToggler.addEventListener("click", () => document.body.classList.toggle("show-chatbot"));
    </script>

</body>



</html>



</var>

<?php  ?>