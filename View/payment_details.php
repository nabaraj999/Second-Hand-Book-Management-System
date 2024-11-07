<?php
include('connection.php');
session_start();

$user_id = $_SESSION['user_id'];

$sql = "SELECT b.book_name, p.payment_status, p.payment_time 
        FROM books b 
        JOIN buybooks_payment p ON b.id = p.book_id 
        WHERE b.seller_id = ? AND p.payment_status = 'approved'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $sold_time = strtotime($row['payment_time']);
        $current_time = time();

        echo "<div class='payment-details'>";
        echo "<h2>Book: " . htmlspecialchars($row['book_name']) . "</h2>";
        echo "<p>Status: " . htmlspecialchars($row['payment_status']) . "</p>";

        if (($current_time - $sold_time) <= 172800) { // 48 hours in seconds
            echo "<p>Congratulations! Your book has been successfully sold.</p>";
        } else {
            echo "<p>Your book was sold successfully.</p>";
        }

        echo "</div>";
    }
} else {
    echo "<p>No successful payments found for your books.</p>";
}
$stmt->close();
$conn->close();
?>
