<?php
include('connection.php'); // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the required fields are set
    if (isset($_POST['user_id']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
        // Retrieve form data
        $userId = $_POST['user_id'];
        $newPassword = $_POST['new_password'];
        $confirmNewPassword = $_POST['confirm_password'];

        // Check if the new passwords match
        if ($newPassword !== $confirmNewPassword) {
            die("New passwords do not match.");
        }

        // Hash the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the password in the database
        $updateQuery = "UPDATE Users SET password = ? WHERE id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("si", $hashedPassword, $userId);

        if ($stmt->execute()) {
            echo "Password updated successfully.";
        } else {
            die("Failed to update password: " . $conn->error);
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    } else {
        die("Required fields are missing.");
    }
} else {
    die("Invalid request method.");
}
?>
