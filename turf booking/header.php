<?php
session_start();

if (isset($_GET['header'])) {
    if ($_GET['header'] == 'bookings') {
        header('Location: log.php');
        exit;
    }
    if ($_GET['header'] == 'home') {
        header('Location: turf_list.php');
        exit;
    }

    if ($_GET['header'] == 'logout') {

        setcookie("id", "", time() - 3600, "/");
        setcookie("email", "", time() - 3600, "/");


        header('Location: index.html');
        exit;
    }
}


?>
<link rel="stylesheet" href="header.css">

<div class="header_container">

    <form action="header.php" method="get">
        <button name="header" value="home" class="home">Home</button>
        <button name="header" value="bookings" class="bookings">Bookings</button>
        <button name="header" value="logout" class="logout">Logout</button>
    </form>

</div>