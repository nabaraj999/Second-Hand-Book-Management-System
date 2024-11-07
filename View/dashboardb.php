<?php
// Database connection
$servername = "localhost";
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$dbname = "booknest"; // replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $code = $_POST['code'];
    $bookname = $_POST['bookname'];
    $amount = $_POST['amount'];
    
    // Insert data into the database
    $sql = "INSERT INTO paymentdetails (name, email, phone, reference_code, bookname, amount, created_at)
            VALUES ('$name', '$email', '$phone', '$code', '$bookname', '$amount', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "Payment details recorded successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
