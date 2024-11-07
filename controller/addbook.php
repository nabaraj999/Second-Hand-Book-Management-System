<?php
// Start the session
session_start();

// Include the database connection file
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $title = $_POST['title'];
    $author = $_POST['author'];
    $isbn = $_POST['isbn'];
    $price = $_POST['price'];
    $published_date = $_POST['published_date'];
    $category = implode(", ", $_POST['category']); // Convert array to comma-separated string
    $language = $_POST['language'];
    $pages = $_POST['pages'];
    $description = $_POST['description'];

    // Handle file upload
    $cover = $_FILES['cover']['name'];
    $target_dir = "../uploads/"; // Corrected the target directory syntax
    $target_file = $target_dir . basename($cover);
    move_uploaded_file($_FILES['cover']['tmp_name'], $target_file);

    // Prepare SQL query
    $sql = "INSERT INTO bookadd (title, author, isbn, price, published_date, category, language, pages, cover, description) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {  // Replace $mysql with $conn
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("ssssssssss", $title, $author, $isbn, $price, $published_date, $category, $language, $pages, $target_file, $description);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            header('Location:../View/bookadd.php');
            exit(); // Exit the script after successful insertion
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Error: Could not prepare the SQL statement.";
    }

    // Close the database connection
    $conn->close();
}
?>
