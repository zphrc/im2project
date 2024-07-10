<?php
session_start();
include 'db.php';

// Step 2: Fetch prescription based on appointment ID
if (isset($_GET['appointmentId'])) {
    $appointmentId = $_GET['appointmentId'];

    // Prepare SQL statement
    $sql = "SELECT prescription FROM appointments WHERE id = ?";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $appointmentId);

    // Execute query
    $stmt->execute();

    // Bind result variables
    $stmt->bind_result($prescription);

    // Fetch prescription
    if ($stmt->fetch()) {
        // Display prescription details
        echo "<h2>Prescription Details</h2>";
        echo "<p>$prescription</p>";
    } else {
        echo "<p>No prescription found for this appointment.</p>";
    }

    // Close statement
    $stmt->close();
} else {
    echo "<p>Appointment ID not provided.</p>";
}

// Close connection
$conn->close();
?>
