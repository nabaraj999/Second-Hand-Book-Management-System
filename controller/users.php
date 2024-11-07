<?php
include('../connection/connection.php'); // Include your database connection file

// Prepare the SQL query to fetch data from the Users table
$sql = "SELECT id, email, username, created_at FROM users"; // Removed 'password' from the SELECT statement

// Execute the query and store the result
$result = $conn->query($sql);

// Output the HTML and CSS
echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>User Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .back-button {
            position: fixed;
            top: 20px;
            left: 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        .back-button:hover {
            background-color: #45a049;
        }
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
            font-size: 18px;
            text-align: left;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .action-button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            font-size: 14px;
            border-radius: 3px;
            cursor: pointer;
        }
        .action-button:hover {
            background-color: #0056b3;
        }
        .delete-button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            font-size: 14px;
            border-radius: 3px;
            cursor: pointer;
        }
        .delete-button:hover {
            background-color: #c82333;
        }
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 30%;
            border-radius: 10px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .modal-content input[type='password'] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        .modal-content button {
            margin-top: 20px;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .modal-content button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>";

if ($result->num_rows > 0) {
    // Display the back button with a link
    echo "<a href='../View/adminpanelindex.php' class='back-button'>🔙 Back</a>";

    // Start the table
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Username</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>";

    // Fetch and display each row of data
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['id']) . "</td>
                <td>" . htmlspecialchars($row['email']) . "</td>
                <td>" . htmlspecialchars($row['username']) . "</td>
                <td>" . htmlspecialchars($row['created_at']) . "</td>
                <td>
                    <button class='action-button' onclick='openModal(" . $row['id'] . ")'>Change Password</button>
                    <form method='POST' action='deleteuser.php' style='display:inline;'>
                        <input type='hidden' name='user_id' value='" . htmlspecialchars($row['id']) . "'>
                        <button type='submit' class='delete-button'>Delete User</button>
                    </form>
                </td>
              </tr>";
    }

    echo "</table>";

    // Modal HTML
    echo "
    <div id='myModal' class='modal'>
      <div class='modal-content'>
        <span class='close' onclick='closeModal()'>&times;</span>
        <h2>Change Password</h2>
        <form id='change-password-form' method='POST' action='userpasswordchange.php'>
          <input type='hidden' name='user_id' id='user_id'>
          <label for='new-password'>New Password</label>
          <input type='password' id='new-password' name='new_password' required>
          <label for='confirm-password'>Confirm New Password</label>
          <input type='password' id='confirm-password' name='confirm_password' required>
          <button type='submit'>Update Password</button>
        </form>
      </div>
    </div>";

} else {
    echo "No records found.";
}

// Close the database connection
$conn->close();

echo "</body>
<script>
    function openModal(userId) {
        document.getElementById('user_id').value = userId;
        document.getElementById('myModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('myModal').style.display = 'none';
    }
</script>
</html>";
?>
