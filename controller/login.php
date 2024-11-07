<?php
session_start(); // Start the session at the beginning

include('../connection/connection.php'); // Include your database connection file

$error = ''; // Initialize an empty error variable

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // SQL query to fetch user data with prepared statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $row['password'])) {
            // Store user information in session
            $_SESSION['email'] = $row['email']; // Store the email in the session
            $_SESSION['username'] = $row['username']; // Assuming you have a username field
            // Redirect to a single dashboard page
            header("Location:../View/dashboard.php");
            exit();  // Make sure to exit after redirect
        } else {
            $error = "Invalid password.";
            header("Location:../view/login.php?error=".$error);
        }
    } else {
        $error = "Invalid email.";
        header("Location:../view/login.php?error=".$error);
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>

