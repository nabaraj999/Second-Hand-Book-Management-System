<?php
include('connection.php'); // Include your database connection file

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user ID from POST request
    $user_id = isset($_POST['user_id']) ? (int)$_POST['user_id'] : 0;

    // Validate user ID
    if ($user_id <= 0) {
        echo "Invalid user ID.";
        exit();
    }

    // Check current number of admin users
    $checkQuery = "SELECT COUNT(*) AS admin_count FROM users WHERE role = 'admin' AND status = 'active'";
    $checkStmt = $conn->prepare($checkQuery);

    if ($checkStmt === false) {
        die("Failed to prepare statement: " . htmlspecialchars($conn->error));
    }

    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    $adminCount = $checkResult->fetch_assoc()['admin_count'];

    $checkStmt->close();

    // Limit admins to 2
    if ($adminCount >= 2) {
        echo "Cannot approve new admin. The maximum number of admin users has been reached.";
        exit();
    }

    // Prepare the SQL query to update the user's role and status
    $query = "UPDATE users SET role = 'admin', status = 'active' WHERE id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die("Failed to prepare statement: " . htmlspecialchars($conn->error));
    }

    // Bind parameters and execute the query
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        echo "User role has been approved.";
    } else {
        echo "Failed to approve user role: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();
} else {
    echo "Invalid request method.";
}

// Close the database connection
$conn->close();
?>
