<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index2.php");
    exit();
}

include 'db.php';

$userid = $_SESSION['user_id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$address = $_POST['address'];
$phone = $_POST['phone_number'];
$email = $_POST['email'];

$sql = "UPDATE users SET first_name=?, last_name=?, address=?, phone_number=?, email=? WHERE userID=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sssssi', $first_name, $last_name, $address, $phone, $email, $userid);

if ($stmt->execute()) {
    $_SESSION['success_message'] = "Account updated successfully.";
    header("Location: reload_session.php");
    exit();
} else {
    $_SESSION['error_message'] = "Error updating profile. Please try again later.";
    header("Location: edit_account.php");
    exit();
}

$stmt->close();
$conn->close();
?>