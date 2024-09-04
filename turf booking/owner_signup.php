<?php
session_start();
include("database.php");

/** @var mysqli $conn */

if (isset($_POST['signup'])) {
    $turfname = htmlspecialchars(trim($_POST['turfname']), ENT_QUOTES, 'UTF-8');
    $address = htmlspecialchars(trim($_POST['address']), ENT_QUOTES, 'UTF-8');
    $mobile = htmlspecialchars(trim($_POST['mobile']), ENT_QUOTES, 'UTF-8');
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = htmlspecialchars(trim($_POST['password']), ENT_QUOTES, 'UTF-8');


    // Validate inputs
    $errors = [];
    if (empty($turfname)) {
        $errors[] = "Turf name is required.";
    }
    if (empty($address)) {
        $errors[] = "Address is required.";
    }
    if (empty($mobile) || !preg_match('/^[0-9]{10}$/', $mobile)) {
        $errors[] = "A valid 10-digit mobile number is required.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "A valid email address is required.";
    }
    if (empty($password) || strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }

    if (empty($errors)) {
        // Handle file upload
        $image = $_FILES['image']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($image);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // Insert data into database
            $query = "INSERT INTO owners (turfname, address, image,mobile, email, password) 
                  VALUES ('$turfname', '$address', '$target_file', '$mobile', '$email','$password')";

            if (mysqli_query($conn, $query)) {

                $slot_query = "select id from owners where email='$email' and password='$password'";
                $result = mysqli_query($conn, $slot_query);
                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    $id = $row["id"];
                    $slot_insert = "INSERT INTO slots VALUES ('$id', 'available', 'available', 'available', 'available', 'available', 'available', 'available')";
                    if (mysqli_query($conn, $slot_insert)) {
                        header("Location: login_interface.php");
                        exit();
                    }
                } else {
                    echo "slot not updated";
                }
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
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
        <form action="owner_signup.php" method="post" enctype="multipart/form-data">
            <input type="text" name="turfname" placeholder="Enter turf name" required>
            <input type="text" name="address" placeholder="Enter address" required>
            <label for="image-upload" class="custom-file-upload">Upload image</label>
            <input type="file" name="image" placeholder="Upload image" required>
            <input type="text" name="mobile" placeholder="Enter your mobile number" required>
            <input type="email" name="email" placeholder="enter your mail" required>
            <input type="password" name="password" placeholder="Enter your password" required>
            <button type="submit" name="signup" value="signup">Sign Up</button>
        </form>
    </div>
</body>

</html>