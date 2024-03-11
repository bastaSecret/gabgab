<!DOCTYPE html> 
<html lang="en"> 
<head>
    <title>Welcome to my website!</title>
    <link rel="stylesheet" href="mess.css"/>
</head>
<body>
    <div class="container">
        <textarea id="user-message" placeholder="Type your message here..."></textarea>
        <button class="send-button" onclick="sendMessage()">Send</button>
    </div>

    <script>
        function sendMessage() {
            var message = document.getElementById('user-message').value;
            
            // Check if the message is not empty
            if (message.trim() !== '') {
                // Ask for confirmation
                var confirmation = confirm('Are you sure you want to send this message?');

                // If user confirms, show a success message
                if (confirmation) {
                    alert('Message sent successfully!');
                    // You can add additional actions here, such as sending the message via AJAX
                }
            } else {
                alert('Please type a message before sending.');
            }
        }
    </script>
</body>
</html>