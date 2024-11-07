<?php
include('connection.php'); // Include the database connection

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO feedback (name, email, message) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $message);

// Set parameters and execute
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$stmt->execute();

echo "Feedback submitted successfully";

$stmt->close();
$conn->close();
?>
