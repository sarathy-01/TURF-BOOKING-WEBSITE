<!-- log.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Booking Logs</title>
    <link rel="stylesheet" href="log.css"> <!-- Assuming you have a separate CSS file for styling -->
    <script>
        function showBookings() {
            var turfName = document.getElementById("turfName").value.trim(); // Get turf name from input field
            if (turfName === "") {
                alert("Please enter a turf name.");
                return;
            }

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("bookingTable").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "get_bookings.php?turfName=" + encodeURIComponent(turfName), true);
            xmlhttp.send();
        }
    </script>
</head>

<body>
  
        <style>
             input[type="text"] {
        padding: 10px;
        width: calc(70% - 10px); /* Adjust width to fit button and padding */
        margin-right: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
        font-size: 14px;
    }

    button[type="button"] {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
        border-radius: 3px;
        font-size: 14px;
    }
        </style>

    <?php
    include("header.php");
    ?>
    <h2>Enter Turf Name</h2>

    <input type="text" id="turfName" placeholder="Enter turf name" >
    <button type="button" onclick="showBookings()">Show Bookings</button>

    <br><br>

    <div id="bookingTable">
        <b>Booking information will be listed here...</b>
    </div>

</body>

</html>