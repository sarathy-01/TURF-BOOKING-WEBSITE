<?php
// Start a TCP/IP server
$address = 'localhost';
$port = 8080;

$server = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_set_option($server, SOL_SOCKET, SO_REUSEADDR, 1);
socket_bind($server, $address, $port);
socket_listen($server);

echo "WebSocket server started at ws://$address:$port\n";

// Clients and their sockets
$clients = [];
$sockets = [$server];

while (true) {
    // Manage multiple sockets
    $readSockets = $sockets;
    $writeSockets = null;
    $exceptSockets = null;

    socket_select($readSockets, $writeSockets, $exceptSockets, null);

    foreach ($readSockets as $socket) {
        if ($socket === $server) {
            // New client connection
            $client = socket_accept($server);
            $sockets[] = $client;
            $clients[] = $client;
            echo "New client connected\n";
        } else {
            // Handle client messages
            $msg = socket_read($socket, 2048, PHP_BINARY_READ);
            if ($msg === false) {
                // Client disconnected
                $key = array_search($socket, $clients);
                unset($clients[$key]);
                unset($sockets[$key]);
                socket_close($socket);
                echo "Client disconnected\n";
                continue;
            }
            
            // Broadcast received message to all clients
            foreach ($clients as $client) {
                if ($client !== $server && $client !== $socket) {
                    socket_write($client, $msg, strlen($msg));
                }
            }
        }
    }
}

// Close server socket
socket_close($server);
?>
