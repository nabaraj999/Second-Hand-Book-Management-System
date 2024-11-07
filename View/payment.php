<?php
include('connection.php'); // Include your database connection file

// Capture the form data sent via POST
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$reference_code = $_POST['reference-code'];
$amount = $_POST['amount'];
$bookname = $_POST['bookname'];
// Prepare the SQL statement
$sql = "INSERT INTO PaymentDetails (name, email, phone, reference_code, amount, bookname) 
        VALUES ('$name', '$email', '$phone', '$reference_code', '$amount', '$bookname')";

// Execute the SQL statement
if ($conn->query($sql) === TRUE) {
    // Output success message or redirect to a success page
    
} else {
    // Display an error message if the query fails
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
