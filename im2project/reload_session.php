<?php
session_start();

// Include your database connection file
include_once "db.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index2.php");
    exit();
}

// Retrieve updated user data from the database
$userid = $_SESSION['user_id'];
$sql = "SELECT first_name, last_name, address, dob, phone_number, email FROM users WHERE userID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userid);
$stmt->execute();
$stmt->bind_result($first_name, $last_name, $address, $dob, $phone_number, $email);
$stmt->fetch();

// Update session variables
$_SESSION['first_name'] = $first_name;
$_SESSION['last_name'] = $last_name;
$_SESSION['address'] = $address;
$_SESSION['dob'] = $dob;
$_SESSION['phone_number'] = $phone_number;
$_SESSION['email'] = $email;

$stmt->close();
$conn->close();

// Redirect to the dashboard
header("Location: landing_page.php");
exit();
?>