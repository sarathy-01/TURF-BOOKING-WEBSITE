<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Enquiry</title>
</head>
<body>
    <h1>User Enquiry</h1>
    <textarea id="question" placeholder="Enter your question"></textarea><br>
    <button onclick="sendQuestion()">Send Question</button>

    <div id="message-container">
       
    </div>

    <script>
        const socket = new WebSocket("ws://localhost:8080");

        function sendQuestion() {
            const question = document.getElementById('question').value;
            socket.send(JSON.stringify({ type: 'question', content: question }));
            document.getElementById('question').value = ''; 
        }

        socket.onmessage = function(event) {
            const message = JSON.parse(event.data);
            console.log('Received:', message);

            
            const messageElement = document.createElement('div');
            messageElement.textContent = message.content;
            document.getElementById('message-container').appendChild(messageElement);
        };
    </script>
</body>
</html>
