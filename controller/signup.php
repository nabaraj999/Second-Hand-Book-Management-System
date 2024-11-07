<?php
include('connection.php');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate inputs
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit();
    }

    // Check if email or username already exists
    $checkQuery = "SELECT * FROM users WHERE email = ? OR username = ?";
    $stmt = $conn->prepare($checkQuery);
    if ($stmt === false) {
        die("Failed to prepare statement: " . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("ss", $email, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Email or Username already exists.";
    } else {
        // Hash the password before storing it
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert new user
        $query = "INSERT INTO users (email, username, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            die("Failed to prepare statement: " . htmlspecialchars($conn->error));
        }

        $stmt->bind_param("sss", $email, $username, $hashedPassword);

        if ($stmt->execute()) {
            echo "Signup successful.";
        } else {
            echo "Signup failed: " . htmlspecialchars($stmt->error);
        }
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>
