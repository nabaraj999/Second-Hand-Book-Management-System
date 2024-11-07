<?php
include('../connection/connection.php'); // Include the database connection

// Fetch feedback data
$sql = "SELECT name, email, message, submitted_at FROM feedback";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback - BOOKNEST</title>
    <link rel="stylesheet" href="feedback.css">
</head>
<body>
    <a href="adminpanelindex.php" class="back-button">Back</a> <!-- Replace 'previous_page_url.php' with the actual URL -->

    <div class="container">
        <h1>Feedback Entries</h1>

        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                $name = htmlspecialchars($row['name']);
                $email = htmlspecialchars($row['email']);
                $message = htmlspecialchars($row['message']);
                $submitted_at = new DateTime($row['submitted_at']);
                $formatted_date = $submitted_at->format('F j, Y \a\t g:i A'); // Example: August 31, 2024 at 2:15 PM

                echo "<div class='feedback-entry'>";
                echo "<h3>$name</h3>";
                echo "<p><strong>Email:</strong> $email</p>";
                echo "<p><strong>Message:</strong> $message</p>";
                echo "<p><strong>Submitted At:</strong> $formatted_date</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No feedback available.</p>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
