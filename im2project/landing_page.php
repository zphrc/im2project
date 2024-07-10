<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index2.php");
    exit();
}

$user_id = $_SESSION['user_id']; // Make sure this is correctly set
$user_first_name = $_SESSION['user_first_name'];
$last_login_timestamp = isset($_SESSION['last_login']) ? $_SESSION['last_login'] : null;

// Set default timezone to Philippines
date_default_timezone_set('Asia/Manila');

// Function to get the appropriate greeting based on the current time
function get_greeting() {
    $hour = date('G');
    if ($hour >= 5 && $hour < 12) {
        return "Good morning";
    } else if ($hour >= 12 && $hour < 18) {
        return "Good afternoon";
    } else {
        return "Good evening";
    }
}

$greeting = get_greeting();

// Format last login timestamp
$last_login_formatted = ($last_login_timestamp) ? date('F j, Y, g:i a', $last_login_timestamp) : 'Unknown';

include_once "db.php";

// Initialize variables for recent appointment
$date_preference = $time_preference = $appointment_type = $prescription = null;

// Retrieve the most recent confirmed appointment for the current user
$sql_recent_appointment = "SELECT id, date_preference, time_preference, appointment_type, reason, prescription FROM appointments WHERE userID = ? AND approved = 1 ORDER BY date_preference DESC, time_preference DESC LIMIT 1";
if ($stmt_recent = $conn->prepare($sql_recent_appointment)) {
    $stmt_recent->bind_param("i", $user_id);
    $stmt_recent->execute();
    $stmt_recent->bind_result($appointment_id, $date_preference, $time_preference, $appointment_type, $reason, $prescription);
    $stmt_recent->fetch();
    $stmt_recent->close();
} else {
    // Debug information
    echo "Error: " . $conn->error;
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Clinic</title>
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styles.css">
    <style>
        .content {
            max-height: 57vh;
            display: flex;
            flex-direction: column;
            width: 100%;
            margin: 0 25px;
        }  
        .content2 {
            flex-direction: column; /* Stack items vertically */
            margin: 0; /* Remove negative margin for stacking */
        }
        .appointment-container {
            max-width: 100%;
            padding: 30px;
            background-color: #f8f9fa; /* example background color */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            flex: 1;
            border-radius: 10px;
            margin: 10px 15px 20px;
            flex: 1; /* Take up equal space */
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 14px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .even-row {
            background-color: #f9f9f9;
        }
        .odd-row {
            background-color: #ffffff;
        }
        .greeting h1 {
            padding-left: 10px;
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="navbar-brand">
        <a href="landing_page.php"><img src="img/horizontallogo.png" alt="Logo"></a>
    </div>
    <div class="profile-container">
        <a href="#" class="profile-icon" onclick="toggleDropdown()"><i class="fas fa-user-circle"></i></a>
        <div id="profile-dropdown" class="dropdown-content">
            <a href="edit_account.php">Profile</a>
            <a href="app_history.php">Appointment history</a>
            <hr>
            <a href="index.php">Logout</a>
        </div>
    </div>
</nav>

<div class="content">
    <div class="welcome-message">
        <div class="greeting">
            <h1><?php echo $greeting . ', ' . htmlspecialchars($user_first_name) . '.'; ?></h1>
        </div>
        <?php if ($last_login_timestamp): ?>
            <div class="last-login">
                <p>Last login: <?php echo $last_login_formatted; ?></p>
            </div>
        <?php endif; ?>
    </div>
    <div class="content2">
        <div class="appointment-container">
            <h2>Most Recent Appointment</h2>
            <?php if ($date_preference && $appointment_type && $prescription): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Appointment Type</th>
                            <th>Reason</th>
                            <th>Prescription</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo htmlspecialchars($date_preference); ?></td>
                            <td><?php echo htmlspecialchars($time_preference); ?></td>
                            <td><?php echo htmlspecialchars($appointment_type); ?></td>
                            <td><?php echo htmlspecialchars($reason); ?></td>
                            <td><button class="btn" onclick="viewPrescription(<?php echo htmlspecialchars($appointment_id); ?>)"><i class="fas fa-file-prescription"></i> View Prescription</button></td>
                        </tr>
                    </tbody>
                </table>
            <?php else: ?>
                <p style="color: #777;">You have no recent appointments.</p>
            <?php endif; ?>
            <button type="submit" class="apphistorybtn"><a href="app_history.php" style="text-decoration: none; color: white;">View appointment history</a></button>
        </div>
        <div class="appointment-container">
            <h2>Scheduled Appointments</h2>
            <p style="color: #777;">You have no scheduled appointments.</p>
            <button type="submit" id="r-btn" class="bookappbtn">Book an appointment</button>
        </div>
    </div>
</div>

<footer>
    <!-- Footer content -->
</footer>
<script>
    function toggleDropdown() {
        var dropdown = document.getElementById("profile-dropdown");
        if (dropdown.style.display === "block") {
            dropdown.style.display = "none";
        } else {
            dropdown.style.display = "block";
        }
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.profile-icon i')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.style.display === "block") {
                    openDropdown.style.display = "none";
                }
            }
        }
    }

    function viewPrescription(appointmentId) {
        // Replace with your logic to handle viewing prescription for the specific appointment ID
        // Example: Redirect to a prescription viewing page
        window.location.href = `view_prescription.php?appointmentId=${appointmentId}`;
    }
</script>
</body>
</html>
