<?php

include("database.php");
/** @var mysqli $conn */


function fetchWeather($city) {
    
    $apiUrl = "http://api.weatherapi.com/v1/current.json";
    
    
    $apiKey = "859725e2682f4028943120214240107";
    
   
    $url = $apiUrl . "?key=" . $apiKey . "&q=" . urlencode($city);

    $ch = curl_init();

   
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

   
    $response = curl_exec($ch);

    
    if ($response === false) {
        $error = curl_error($ch);
        curl_close($ch);
        return [
            'error' => true,
            'message' => "cURL Error: " . $error
        ];
    }

    
    curl_close($ch);

    
    $weatherData = json_decode($response, true);

    
    if (isset($weatherData['error'])) {
        return [
            'error' => true,
            'message' => "API Error: " . $weatherData['error']['message']
        ];
    }

   
    return [
        'error' => false,
        'data' => $weatherData
    ];
}

$sql = "SELECT id, image, turfname, address, email FROM owners";
$result = $conn->query($sql);

$turfs = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $city = $row['address'];
        $weatherResult = fetchWeather($city);
        if (!$weatherResult['error']) {
            $row['weather'] = $weatherResult['data'];
        } else {
            $row['weather'] = ['current' => ['temp_c' => 'N/A', 'condition' => ['text' => 'N/A']]];
        }
        $turfs[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turf List</title>
    <link rel="stylesheet" href="turf_list.css">
</head>
<body>
    
    <div class="header">
        <?php include("header.php"); ?>
    </div>
    <div class="main_container">
        <?php foreach ($turfs as $turf): ?>
            <div class="items">
                <div class="left">
                    <img src="<?php echo htmlspecialchars($turf['image']); ?>" alt="">
                    <form action="book_turf.php" method="get">
                        <button class="book" type="submit" name="id" value="<?php echo htmlspecialchars($turf['id']); ?>">BOOK</button>
                    </form>
                </div>
                <style>
                    
                </style>
                <div class="right">
                    <h1 class="turfname" style="background-color:rgb(209, 213, 215);">turf name  :<?php echo htmlspecialchars($turf['turfname']); ?></h1>
                    <h2 class="mail" style="background-color:rgb(209, 213, 215);">mail  :<?php echo htmlspecialchars($turf['email']); ?></h2>
                    <h2 class="location" style="background-color:rgb(209, 213, 215);">location  :<?php echo htmlspecialchars($turf['address']); ?></h2>
                    <h2 class="weather" style="background-color:rgb(209, 213, 215);">
                        Weather: <?php echo "Temperature: " . htmlspecialchars($turf['weather']['current']['temp_c']) . "°C, Condition: " . htmlspecialchars($turf['weather']['current']['condition']['text']); ?>
                    </h2>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="footer">
        <!-- Footer content -->
    </div>

</body>
</html>
