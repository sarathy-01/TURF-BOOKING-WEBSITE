<?php
include("database.php");
include("header.php");
/** @var mysqli $conn */
$final_status = 0;
///turf section
//session_start();

if (isset($_SESSION['turf_id'])) {

    $turf_id = $_SESSION['turf_id'];
    $turf_query = "select * from owners where id='$turf_id'";
    $turf_result = mysqli_query($conn, $turf_query);
    if ($turf_result) {
        $row = mysqli_fetch_assoc($turf_result);
        $turf_name = $row["turfname"];
        $turf_email = $row["email"];
        $turf_mobile = $row["mobile"];
        // echo $turf_name.$turf_email.$turf_mobile;
    } else {
        echo "not fetched turf details";
    }
}
else{
    echo"session problem";
}
///user section
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $user_query = "select * from users where id='$user_id'";
    $user_result = mysqli_query($conn, $user_query);
    if ($user_result) {
        $row = mysqli_fetch_assoc($user_result);
        $user_name = $row["name"];
        $user_email = $row["email"];
        $user_mobile = $row["mobile"];
        // echo $user_name.$user_email.$user_mobile;
    } else {
        echo "not fetched turf details";
    }
}
//status section
if (isset($_GET['slot'])) {
    $slot = $_GET['slot'];
    //echo "<br>You have selected the " . $slot . " slot.";
}




if ($turf_email) /////////////////////////////////////////////////////////email
{

    $email = "sa@gmail.com";
    $subject = "NEW TURF BOOKING ALERT";
    $message = "we are pleased to inform that new booking has been made 
        NAME : $user_name
        EMAIL : $user_email
        SLOT : $slot";
    $to = "$turf_email";
    $headers = "from: $email";

    if (mail($to, $subject, $message, $headers)) // mailgfunction
    {
        $final_status += 1;

        $slot_query = "UPDATE slots SET `$slot` = 'unavailable' WHERE id = $turf_id"; //unavilable
        if (mysqli_query($conn, $slot_query)) {
           // echo "slot updated";
            $final_status += 1;
        } else {
            echo "slot not updated";
        }

        $booking_date=date('Y-m-d');
        $sql = "INSERT INTO booking_logs (customer_id, turf_id, turf_name, slot, booking_date)
        VALUES ('$user_id', '$turf_id', '$turf_name', '$slot', '$booking_date')";

        if ($conn->query($sql) === TRUE) {
           // echo "New booking log created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        
    } else {
        echo "not sent";
    }
}

//include("header.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="confirmation.css">
    <title>Booking Confirmation</title>
</head>

<body>

    <div class="container">
        <div class="header">
            <h1>Booking Confirmation</h1>
        </div>
        <div class="content">
            <div class="booking-details">
                <h2>Booking Details</h2>
                <ul>
                    <li><strong>TURF NAME:</strong> <?php echo $turf_name; ?></li>
                    <li><strong>TURF MOBILE:</strong> <?php echo $turf_mobile; ?></li>
                    <li><strong>TURF EMAIL:</strong> <?php echo $turf_email; ?></li>
                    <li><strong>SLOT:</strong> <?php echo $slot; ?></li>
                </ul>
            </div>
            <div class="status">
                <h2>Status</h2>
                <?php
                if ($final_status == 2) {
                    echo "<p class='success'>CONFIRMED</p>";
                } else {
                    echo "<p class='fail'>FAILED</p>";
                }
                ?>
            </div>
        </div>

             <form action="user_enquiry.php" method="get">
                <button type="submit" name="user_enquiry" value="<?php echo"$turf_id"; ?>">ENQUIRY</button>
             </form>   

    </div>
</body>

</html>