<?php
// Database connection
include ('../connection/connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $book_id = $_POST['book_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $code = $_POST['code'];
    $bookname = $_POST['bookname'];
    $amount = $_POST['amount'];

    // Prepare an SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO buybooks_payment (book_id, name, email, phone, reference_code, bookname, amount) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    // Bind parameters
    $stmt->bind_param("isssssd", $book_id, $name, $email, $phone, $code, $bookname, $amount);

    // Execute the statement and check for errors
    if ($stmt->execute()) {
        // Redirect to 'bookbill.php' after successful insertion
        header('Location: bookbill.php');
        exit(); // Ensure no further code is executed after the redirect
    } else {
        // Display error message
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
