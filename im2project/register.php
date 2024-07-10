<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password

    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, dob, address, phone_number, email, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    if ($stmt === false) {
        die('MySQL prepare error: ' . $conn->error);
    }

    $stmt->bind_param("sssssss", $first_name, $last_name, $dob, $address, $phone_number, $email, $password);

    if ($stmt->execute()) {
        echo "Registration successful";
        header("Location: index2.php"); // Redirect to landing page after successful registration
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>
