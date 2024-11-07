<?php
// Start the session
session_start();

// Include the database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "booknest";
$port = 3307; // Define the port if it's different from the default

// Create a new mysqli connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the delete button was pressed
if (isset($_GET['delete'])) {
    $book_id = $_GET['delete'];

    // Prepare the delete query
    $delete_sql = "DELETE FROM bookadd WHERE id = ?";
    if ($stmt = $conn->prepare($delete_sql)) {
        $stmt->bind_param("i", $book_id);
        if ($stmt->execute()) {
            echo "<script>alert('Book with ID $book_id has been deleted.');</script>";
        } else {
            echo "Error deleting book: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing delete statement.";
    }
}

// Fetch all books from the database
$sql = "SELECT id, title, author, isbn, price FROM bookadd";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove Book</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to your custom CSS file -->
    <style>
        /* General Page Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        /* Back Button Styles */
        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
        }

        .back-button:hover {
            background-color: #0056b3;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 40px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f8f9fa;
            color: #333;
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
        }

        /* Remove Button Styles */
        a.remove-btn {
            background-color: #dc3545;
            color: white;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
        }

        a.remove-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

    <!-- Back Button -->
    <a href="../View/bookadd.php" class="back-button">Back to Admin Panel</a>

    <h2>Remove a Book</h2>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>ISBN</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['title']}</td>
                            <td>{$row['author']}</td>
                            <td>{$row['isbn']}</td>
                            <td>{$row['price']}</td>
                            <td><a href='removebook.php?delete={$row['id']}' class='remove-btn' onclick='return confirm(\"Are you sure you want to delete this book?\")'>Remove</a></td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No books available</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <?php
    // Close the connection
    $conn->close();
    ?>
</body>
</html>
