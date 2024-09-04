<?php
include("database.php");
/** @var mysqli $conn */
session_start();

if (isset($_GET['turfName'])) {
    $turfName = $_GET['turfName'];
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM booking_logs WHERE turf_name = '$turfName'and customer_id='$user_id'";
    $result = mysqli_query($conn, $sql);
    ob_start();
    echo "<table class='booking-table'>
            <tr>
                <th>Turf Name</th>
                <th>Slot</th>
                <th>Booking Date</th>
            </tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['turf_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['slot']) . "</td>";
        echo "<td>" . htmlspecialchars($row['booking_date']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    $output = ob_get_clean();
    echo $output;

} else {
    echo "No turf name entered.";
}
?>

<style>
    .booking-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    
    .booking-table th, .booking-table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }
    
    .booking-table th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    .booking-table td {
        background-color: #f9f9f9;
        font-size: 14px;
    }
</style>
