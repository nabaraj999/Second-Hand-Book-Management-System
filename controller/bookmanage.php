<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "booknest";

$conn = new mysqli($servername, $username, $password, $dbname, 3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if an action is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $payment_id = $_POST['id'];
    $book_id = $_POST['book_id'];

    if (isset($_POST['accept'])) {
        // Compare book_id from both tables
        $sql_check = "SELECT * FROM books WHERE id = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("i", $book_id);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            // Delete the book from the `books` table
            $sql_delete = "DELETE FROM books WHERE id = ?";
            $stmt_delete = $conn->prepare($sql_delete);
            $stmt_delete->bind_param("i", $book_id);
            $stmt_delete->execute();

            // Update the status of the payment to "Accepted"
            $sql_update = "UPDATE buybooks_payment SET status = 'Accepted' WHERE id = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("i", $payment_id);
            $stmt_update->execute();

            $message = "Payment accepted and book deleted.";
        } else {
            $message = "Book not found. Cannot accept the payment.";
        }
    } elseif (isset($_POST['reject'])) {
        // Update the status of the payment to "Rejected"
        $sql_update = "UPDATE buybooks_payment SET status = 'Rejected' WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("i", $payment_id);
        $stmt_update->execute();

        $message = "Payment rejected.";
    }
}

// Fetch payment details
$sql = "SELECT * FROM buybooks_payment";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Management</title>
   
</head>
<body>
    <a href="../View/adminpanelindex.php">← Back to Dashboard</a>
    <h1>Payment Details</h1>
    <link rel="stylesheet" href="bookmanage.css">
    
    <?php if (!empty($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Reference Code</th>
                <th>Book Name</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Book ID</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['reference_code']; ?></td>
                        <td><?php echo $row['bookname']; ?></td>
                        <td><?php echo $row['amount']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td><?php echo $row['book_id']; ?></td>
                        <td>
                            <?php if ($row['status'] == 'Pending'): ?>
                                <form action="" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <input type="hidden" name="book_id" value="<?php echo $row['book_id']; ?>">
                                    <button type="submit" name="accept">Accept</button>
                                    <button type="submit" name="reject">Reject</button>
                                </form>
                            <?php else: ?>
                                <span><?php echo $row['status']; ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10">No records found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conn->close();
?>
