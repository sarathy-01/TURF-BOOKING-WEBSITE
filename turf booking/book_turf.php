<?php
// book_turf.php
include("database.php");
date_default_timezone_set('Asia/Kolkata');

$current_time = date('H:i'); 
include("header.php");


//session_start();
/** @var mysqli $conn */
if (isset($_GET['id'])) {
    $turf_id = $_GET['id'];
    $_SESSION['turf_id'] = $turf_id;

    $status = "select * from slots where id='$turf_id'";
    $result = mysqli_query($conn, $status);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $slot1 = $row["8am - 10am"];
        $slot2 = $row["10am - 12pm"];
        $slot3 = $row["1pm - 3pm"];
        $slot4 = $row["3pm - 5pm"];
        $slot5 = $row["5pm - 7pm"];
        $slot6 = $row["7pm - 9pm"];
        $slot7 = $row["9pm - 11pm"];
    }
} else {
    echo "No turf ID provided.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="book_turf.css">
    <title>Book Turf Slots</title>
</head>

<body>
    <div class="heading">
        <?php
            //include("header.php");
        ?>
    </div>
    <div class="main_container">
        <?php 
                  echo "User ID: " . htmlspecialchars($_COOKIE['id']) . "<br>";
                  echo "User Email: " . htmlspecialchars($_COOKIE['email']) . "<br> <br> <br>";
        ?>
    <h1>Book Turf Slots</h1>

        <h2>Available Slots</h2>
        <table class="slots-table">
            <tr>
                <th>8am - 10am</th>
                <th>10am - 12pm</th>
                <th>1pm - 3pm</th>
                <th>3pm - 5pm</th>
                <th>5pm - 7pm</th>
                <th>7pm - 9pm</th>
                <th>9pm - 11pm</th>
            </tr>
            <tr>
                <form action="confirmation.php" method="get">

                    <td>
                        <?php
                        
                        if (strtotime('08:00') > strtotime($current_time) && $slot1 != "unavailable") {
                            echo '<button class="slot-button" name="slot" value="8am - 10am">BOOK</button>';
                        } 
                        ?>
                    </td>
                    <td>
                        <?php
                        if (strtotime('10:00') > strtotime($current_time) && $slot2 != "unavailable") {
                            echo '<button class="slot-button" name="slot" value="10am - 12pm">BOOK</button>';
                        } 
                        ?>
                    </td>
                    <td>
                        <?php
                        if (strtotime('13:00') > strtotime($current_time) && $slot3 != "unavailable") {
                            echo '<button class="slot-button" name="slot" value="1pm - 3pm">BOOK</button>';
                        } 
                        ?>
                    </td>
                    <td>
                        <?php
                        if (strtotime('15:00') > strtotime($current_time) && $slot4 != "unavailable") {
                            echo '<button class="slot-button" name="slot" value="3pm - 5pm">BOOK</button>';
                        } 
                        ?>
                    </td>
                    <td>
                        <?php
                        if (strtotime('17:00') > strtotime($current_time) && $slot5 != "unavailable") {
                            echo '<button class="slot-button" name="slot" value="5pm - 7pm">BOOK</button>';
                        } 
                        ?>
                    </td>
                    <td>
                        <?php
                        if (strtotime('19:00') > strtotime($current_time) && $slot6 != "unavailable") {
                            echo '<button class="slot-button" name="slot" value="7pm - 9pm">BOOK</button>';
                        } 
                        ?>
                    </td>
                    <td>
                        <?php
                        if (strtotime('24:00') > strtotime($current_time) && $slot7 != "unavailable") {
                            echo '<button class="slot-button" name="slot" value="9pm - 11pm">BOOK</button>';
                        } 
                        ?>
                    </td>





                </form>

            </tr>
        </table>
    </div>
    
</body>

</html>