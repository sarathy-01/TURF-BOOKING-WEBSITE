<?php

include("database.php");

/** @var mysqli $conn */
session_start();

if (isset($_POST["owner_login"])) {
    $mail = filter_var($_POST["mail"], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);

    if (filter_var($mail, FILTER_VALIDATE_EMAIL) && !empty($password)) {
        $sql = "select * from owners where email='$mail' and password='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_mail'] = $row['email'];
            $_SESSION['error_message'] = ''; // Clear error message
            header("Location: owner_reply.php");
            exit();
        } else {
            echo "error";
        }
    } else {
        echo "Invalid email or password format.";
    }
}

if (isset($_POST["customer_login"])) {
    $mail = filter_var($_POST["mail"], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
    //$password=password_verify($password, $row['password']);


    if (filter_var($mail, FILTER_VALIDATE_EMAIL) && !empty($password)) {
        $sql = "select * from users where email='$mail'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            if (password_verify($password, $row['password'])) { ////////////////////////////////hash
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_mail'] = $row['email'];

                setcookie("id", $row['id'], time() + 86400, "/");
                setcookie("email", $row['email'], time() + 86400, "/");

                $_SESSION['error_message'] = ''; // Clear error message
                header("Location: turf_list.php");
                exit();
            } else {
                echo "Invalid email or password.";
            }
        } else {
            echo "error";
        }
    } else {
        echo "Invalid email or password format.";
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Document</title>
</head>

<body>
    <div class="logins">

        <div class="owner">
            <h2>TURF OWNER</h2>
            <form action="login_interface.php" method="post">
                <input type="text" name="mail" placeholder="ENTER YOUR MAIL ID">
                <input type="password" name="password" placeholder="ENTER PASSWORD">
                <button type="submit" name="owner_login" value="owner_login">login</button>
            </form>
            <a href="owner_signup.php">new user</a>


        </div>

        <div class="customer">
            <h2>CUSTOMERS</h2>
            <form action="login_interface.php" method="post">
                <input type="text" name="mail" placeholder="ENTER YOUR MAIL ID">
                <input type="password" name="password" placeholder="ENTER PASSWORD">
                <button type="submit" name="customer_login" value="customer_login">login</button>
            </form>
            <a href="customer_signup.php">new user</a>

        </div>
    </div>
</body>

</html>