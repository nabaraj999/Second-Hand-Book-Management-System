<?php
// Include the database connection file
include('../connection/connection.php');

// Retrieve and sanitize form data
$seller_name = $_POST['sname'];
$email = $_POST['email'];
$book_category = $_POST['bookCategory'];
$level = isset($_POST['level']) ? $_POST['level'] : '';
$class = isset($_POST['class']) ? $_POST['class'] : '';
$book_name = $_POST['book_name'];
$author = $_POST['author'];
$price = $_POST['price'];
$discount = $_POST['discount'];
$isbn = $_POST['isbn'];
$description = $_POST['description'];

// Handle book photo upload
$photo = $_FILES['photo']['name'];
$photo_tmp = $_FILES['photo']['tmp_name'];
$photo_target = "../uploads/" . basename($photo);

// Move uploaded photo to target directory if a file exists
if ($photo) {
    if (move_uploaded_file($photo_tmp, $photo_target)) {
        echo "Photo uploaded successfully.";
        header ('location: sell.php');
        exit(); // exit the script after successful insert.
    } else {
        echo "Error uploading photo.";
    }
} else {
    $photo_target = null; // or set a default photo if needed
}

// Prepare SQL query to insert data into the database
$sql = "INSERT INTO books (seller_name, email, book_category, level, class, book_name, author, price, discount, isbn, photo, description)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare and bind
$stmt = $conn->prepare($sql);
$stmt->bind_param(
    'ssssssssssss',
    $seller_name, $email, $book_category, $level, $class, $book_name, $author, $price, $discount, $isbn, $photo, $description
);

// Execute and check
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
