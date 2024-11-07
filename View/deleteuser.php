<?php
include('connection.php'); // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['user_id'])) {
        $userId = $_POST['user_id'];

        // Prepare the SQL query to delete the user
        $deleteQuery = "DELETE FROM users WHERE id = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("i", $userId);

        if ($stmt->execute()) {
            echo "User deleted successfully.";
        } else {
            die("Failed to delete user: " . $conn->error);
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();

        // Redirect back to the user list page
        header("Location: userlist.php"); // Adjust the URL as needed
    } else {
        die("User ID is missing.");
    }
} else {
    die("Invalid request method.");
}
?>
