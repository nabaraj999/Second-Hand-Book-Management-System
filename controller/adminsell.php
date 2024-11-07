<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="adminsell.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="admin-container">
        <div class="arrow-button-container">
            <a href="../View/adminpanelindex.php" class="arrow-link">
                <span>&larr;</span> Dashboard
            </a>
        </div>
        <div class="content">
            <h1>Admin Panel</h1>
            <table class="book-table">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Seller Name</th>
                        <th>Email Address</th>
                        <th>Book Name</th>
                        <th>Author</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Category</th>
                        <th>Bank Name</th>
                        <th>Account Number</th>
                        <th>Wallet Name</th>
                        <th>Wallet Number</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- PHP code to fetch data from the database and display it -->
                    <?php
                    include('../connection/connection.php');
                    $sql = "SELECT * FROM books";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                            <td>
    <img src="<?php echo htmlspecialchars('uploads/' . $row['photo']); ?>" class="book-photo" alt="Book Photo">
</td>

                                <td><?php echo htmlspecialchars($row['seller_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['book_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['author']); ?></td>
                                <td><?php echo htmlspecialchars($row['price']); ?></td>
                                <td><?php echo htmlspecialchars($row['discount']); ?>%</td>
                                <td><?php echo htmlspecialchars($row['book_category']); ?></td>
                                <td><?php echo htmlspecialchars($row['bank_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['account_number']); ?></td>
                                <td><?php echo htmlspecialchars($row['wallet_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['wallet_number']); ?></td>
                                <td>
                                    <form action="../View/book_action.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">

                                        <!-- Approve Button -->
                                        <button type="submit" name="action" value="approve"
                                                <?php echo ($row['status'] == 'approved' || $row['status'] == 'rejected') ? "disabled style='color:green;'" : ""; ?>>
                                            <?php echo ($row['status'] == 'approved') ? "✔ Approved" : "Approve"; ?>
                                        </button>

                                        <!-- Reject Button -->
                                        <button type="submit" name="action" value="reject"
                                                <?php echo ($row['status'] == 'rejected' || $row['status'] == 'approved') ? "disabled style='color:red;'" : ""; ?>>
                                            <?php echo ($row['status'] == 'rejected') ? "✖ Rejected" : "Reject"; ?>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr><td colspan="12">No books found</td></tr> <!-- Adjusted colspan to match columns -->
                        <?php
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="admin.js"></script> <!-- Link to your JS file -->
</body>
</html>
