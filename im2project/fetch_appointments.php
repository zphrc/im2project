<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index2.php");
    exit();
}

include 'db.php'; // Include your database connection file

$userId = $_SESSION['user_id']; // Fetch the user ID from session

$sql = "SELECT * FROM appointments WHERE userID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $userId);
$stmt->execute();
$result = $stmt->get_result();

$appointments = [];
while ($row = $result->fetch_assoc()) {
    $appointments[] = $row;
}

$stmt->close();
$conn->close();

// Output JSON for AJAX handling
echo json_encode($appointments);
?>
