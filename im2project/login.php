<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check if the email and password are valid
    $query = "SELECT * FROM users WHERE email = ?"; 
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Successful login
            $_SESSION['user_id'] = $user['userID'];
            $_SESSION['user_first_name'] = $user['first_name']; // Assuming 'first_name' is the column name for the user's first name in your database
            $_SESSION['last_login'] = time(); // Store last login time in Unix timestamp format if needed
            header("Location: landing_page.php");
            exit();
        } else {
            // Incorrect password
            $_SESSION['login_error'] = 'Invalid email or password';
        }
    } else {
        // Email not found
        $_SESSION['login_error'] = 'Invalid email or password';
    }

    header("Location: landing_page.php");
    exit();
}
?>
