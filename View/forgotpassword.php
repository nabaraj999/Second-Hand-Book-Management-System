<?php
include 'connection.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the required fields are set
    if (isset($_POST['email']) && isset($_POST['old_password']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
        $email = $_POST['email'];
        $oldPassword = $_POST['old_password'];
        $newPassword = $_POST['new_password'];
        $confirmNewPassword = $_POST['confirm_password'];

        // Check if the new passwords match
        if ($newPassword !== $confirmNewPassword) {
            $error = "New passwords do not match.";
        } else {
            // Retrieve user from the database
            $query = "SELECT * FROM users WHERE email = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if a user was found
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();

                // Verify the old password
                if (password_verify($oldPassword, $user['password'])) {
                    // Hash the new password
                    $hashedNewPassword = password_hash($newPassword, PASSWORD_BCRYPT);

                    // Update the password in the database
                    $updateQuery = "UPDATE users SET password = ? WHERE email = ?";
                    $stmt = $conn->prepare($updateQuery);
                    $stmt->bind_param("ss", $hashedNewPassword, $email);

                    if ($stmt->execute()) {
                        header("Location: success.php"); // Redirect to a success page
                        exit();
                    } else {
                        $error = "Failed to update password: " . $conn->error;
                    }
                } else {
                    $error = "Old password is incorrect.";
                }
            } else {
                $error = "No user was found with that email.";
            }
        }
    } else {
        $error = "Required fields are missing.";
    }
} else {
    $error = "Invalid request method.";
}

if (isset($error)) {
    echo $error; // Display the error message on the frontend
}
?>
