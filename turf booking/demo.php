<?php
// fetch_turfs.php
include("database.php");
/** @var mysqli $conn */

$sql = "SELECT image, turfname, address,email FROM owners";
$result = $conn->query($sql);

$turfs = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
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
    <title>Turfs List</title>
    <style>
        .turf {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            display: inline-block;
            text-align: center;
        }
        .turf img {
            max-width: 200px;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>List of Turfs</h1>
    <div class="turf-list">
        <?php foreach ($turfs as $turf): ?>
            <div class="turf">
                <img src="uploads/js2.1.png" alt="">
                <img src="C:/xampp/htdocs/turf booking/sample/js2.1.png" alt=""> 
                <h2><?php echo ($turf['turfname']); ?></h2>
                <p><?php echo ($turf['address']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
