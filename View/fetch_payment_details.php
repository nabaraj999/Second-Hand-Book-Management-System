<?php
// Database connection
$servername = "localhost";
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$dbname = "booknest"; // replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, 3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the paymentdetails table
$sql = "SELECT id, name, email, phone, reference_code, bookname, amount, created_at FROM paymentdetails";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Details</title>
    <link rel="stylesheet" href="fetch_payment_details.css>
</head>
<body>

<a href="adminpanel.html" class="back-arrow">&larr; Home</a> <!-- Link to home page -->

<h2>Payment Details</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Reference Code</th>
        <th>Book Name</th>
        <th>Amount</th>
        <th>Date</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["phone"] . "</td>";
            echo "<td>" . $row["reference_code"] . "</td>";
            echo "<td>" . $row["bookname"] . "</td>";
            echo "<td>" . $row["amount"] . "</td>";
            echo "<td>" . $row["created_at"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No payment details found</td></tr>";
    }

    // Close the connection
    $conn->close();
    ?>

</table>

</body>
</html>
