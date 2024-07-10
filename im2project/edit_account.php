<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index2.php");
    exit();
}

// Include your database connection file
include_once "db.php"; // Adjust this as per your actual file name and location

// Retrieve current user details from the database
$userid = $_SESSION['user_id'];
$sql = "SELECT first_name, last_name, address, dob, phone_number, email FROM users WHERE userID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userid);
$stmt->execute();
$stmt->bind_result($currentFirstName, $currentLastName, $currentAddress, $currentDOB, $currentPhoneNumber, $currentEmail);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Clinic</title>
    <link rel="icon" type="image/x-icon" href="img\logo.png">
    <title>Medical Clinic</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styles.css">
    <style>
        .content {
            max-height: 50vh;
            display: flex;
            flex-direction: column;
            align-items: center !important;/* Center content horizontally */
            padding: 30px;
        }
        .appointment-container {
            width: 100%;
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .appointment-container h2 {
            margin-top: 0;
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
                <a href="index2.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="content">
        <div class="appointment-container">
            <a class="return-link" href="landing_page.php">Return to dashboard</a>
            <h2>Edit Account</h2>
            <form id="editAccountForm" action="update_account.php" method="post">
                <label for="first_name">First Name</label>
                <input type="text" id="fname" name="first_name" value="<?php echo htmlspecialchars($currentFirstName); ?>" required>
                <label for="last_name">Last Name</label>
                <input type="text" id="lname" name="last_name" value="<?php echo htmlspecialchars($currentLastName); ?>" required>
                <label for="address">Address</label>
                <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($currentAddress); ?>" required>
                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($currentDOB); ?>" readonly>
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone_number" pattern="[0-9]{4} [0-9]{3} [0-9]{4}" value="<?php echo htmlspecialchars($currentPhoneNumber); ?>" maxlength="13" required>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($currentEmail); ?>" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="Enter a valid email address" required>
                <button type="submit" class="updatebtn">Save changes</button>
            </form>
        </div>
    </div>
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

</script>
</body>
</html>