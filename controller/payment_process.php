<?php
// Database connection
include('../connection/connection.php');

// Fetch payment data from the 'payments' table
$sql = "SELECT * FROM payments";
$result = $conn->query($sql);

// Check if the 'accept' button was clicked
if (isset($_GET['accept'])) {
    $payment_id = $_GET['accept'];
    
    // Fetch the book ID associated with this payment
    $fetch_sql = "SELECT book_id FROM payments WHERE id = ?";
    $stmt = $conn->prepare($fetch_sql);
    $stmt->bind_param("i", $payment_id);
    $stmt->execute();
    $stmt->bind_result($book_id);
    $stmt->fetch();
    $stmt->close();

    // Delete the book from the 'bookadd' table
    $delete_book_sql = "DELETE FROM bookadd WHERE id = ?";
    $delete_stmt = $conn->prepare($delete_book_sql);
    $delete_stmt->bind_param("i", $book_id);
    
    if ($delete_stmt->execute()) {
        // Optionally, mark the payment as accepted (you can add an 'accepted' column)
        $update_sql = "UPDATE payments SET status = 'accepted' WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("i", $payment_id);
        $update_stmt->execute();
        $update_stmt->close();
        
        echo "<script>alert('Payment accepted and book removed successfully.');</script>";
    } else {
        echo "<script>alert('Error removing book.');</script>";
    }

    $delete_stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Payments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .action-btn {
            background-color: #28a745;
            color: white;
            padding: 8px 15px;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }

        .action-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<h2>Pending Payments</h2>

<table>
    <thead>
        <tr>
            <th>Payment ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Book Title</th>
            <th>Amount</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Check if there are any payments to display
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['booktitle']}</td>
                        <td>{$row['amount']}</td>
                        <td><a href='payment_process.php?accept={$row['id']}' class='action-btn' onclick='return confirm(\"Are you sure you want to accept this payment and remove the book?\")'>Accept Payment</a></td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No payments available</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>
