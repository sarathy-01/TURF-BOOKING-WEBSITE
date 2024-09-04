<?php
include("database.php");
/** @var mysqli $conn */

if (isset($_POST["signup"])) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $mobile = filter_var($_POST['mobile'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $password = password_hash($password, PASSWORD_DEFAULT); 
    $errors = [];
    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "A valid email address is required.";
    }
    if (empty($password) || strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }

    if (empty($errors)) {

        $query = "INSERT INTO users (name, mobile, email, password) VALUES ('$name', '$mobile', '$email', '$password')";

        if (mysqli_query($conn, $query)) {


            header("Location: login_interface.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="customer_signup.css">
    <title>Signup Form</title>
</head>

<body>
    <div class="signup-form">
        <center>
            <h2>Sign Up</h2>
        </center>
        <form action="customer_signup.php" method="post">
            <input type="text" name="name" placeholder="Enter your name" required>
            <input type="text" name="mobile" placeholder="Enter your mobile" required>
            <input type="email" name="email" placeholder="Enter your email" required>
            <input type="password" name="password" placeholder="Enter your password" required>
            <button type="submit" name="signup" value="signup">Sign Up</button>
        </form>
    </div>
</body>

</html>