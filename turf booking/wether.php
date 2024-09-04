<?php

// Function to fetch weather information
function fetchWeather($city) {
    // API endpoint
    $apiUrl = "http://api.weatherapi.com/v1/current.json";
    
    // Your API key (replace with your actual API key)
    $apiKey = "859725e2682f4028943120214240107";
    
    // Complete URL with query parameters
    $url = $apiUrl . "?key=" . $apiKey . "&q=" . urlencode($city);

    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL session
    $response = curl_exec($ch);

    // Check for cURL errors
    if ($response === false) {
        $error = curl_error($ch);
        curl_close($ch);
        return "cURL Error: " . $error;
    }

    // Close cURL session
    curl_close($ch);

    // Decode JSON response
    $weatherData = json_decode($response, true);

    // Return weather data
    return $weatherData;
}

// Example usage
$city = "no.12,bharathi street,uthiravagini pet, villianur puducherry";
$weatherData = fetchWeather($city);

if (isset($weatherData['current'])) {
    echo "Current weather in " . $city . ":\n";
    echo "Temperature: " . $weatherData['current']['temp_c'] . "°C\n";
    echo "Condition: " . $weatherData['current']['condition']['text'] . "\n";
} else {
    echo "Failed to fetch weather information.";
}

?>
