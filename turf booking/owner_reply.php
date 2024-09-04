<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Reply</title>
</head>
<body>
    <h1>Owner Reply</h1>
    <div id="questions"></div>

    <script>
        const socket = new WebSocket("ws://localhost:8080");

        socket.onmessage = function(event) {
            const message = JSON.parse(event.data);
            if (message.type === 'question') {
                const question = message.content;
                const reply = prompt(`Question: ${question}\nEnter your reply:`);
                socket.send(JSON.stringify({ type: 'reply', content: reply }));
            }
        };
    </script>
</body>
</html>
