<?php
include('connection.php');
session_start();

// Ensure the session is started and the user is logged in
if (!isset($_SESSION['username'])) {
    echo "You need to log in first.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $book_id = $_POST['book_id'];

    // Delete the book from the database
    $sql = "DELETE FROM books WHERE id = ? AND seller_name = ? AND status = 'pending'";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo "<p>Error preparing the SQL statement: " . htmlspecialchars($conn->error) . "</p>";
        exit();
    }

    $stmt->bind_param("is", $book_id, $_SESSION['username']);
    if ($stmt->execute()) {
        echo "<p>Order successfully canceled.</p>";
    } else {
        echo "<p>Error canceling the order: " . htmlspecialchars($stmt->error) . "</p>";
    }

    $stmt->close();
}

$conn->close();
header('Location: orders.php');
exit();
?>
