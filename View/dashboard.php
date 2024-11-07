<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Include database connection
include '../connection/connection.php';

// Fetch search query
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// Prepare SQL query
$sql = "SELECT * FROM bookadd WHERE 1=1";
$params = [];

if (!empty($searchQuery)) {
    $sql .= " AND (title LIKE ? OR author LIKE ?)";
    $params[] = "%" . $searchQuery . "%";
    $params[] = "%" . $searchQuery . "%";
}

// Prepare statement
$stmt = $conn->prepare($sql);

// Bind parameters
if (!empty($params)) {
    $stmt->bind_param(str_repeat('s', count($params)), ...$params);
}

// Execute the query
$stmt->execute();

// Get result
$result = $stmt->get_result();

// Handle SQL errors
if ($result === false) {
    echo "Error: " . $conn->error;
    $conn->close();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buy Books</title>
    <link rel="icon" href="../Photo/Black_and_Orange_Simple_Book_Store_Logo.png" type="png">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .main-content {
            margin-left: 300px;
            padding: 25px;
        }
        .search {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .search input {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-right: 10px;
        }
        .search button {
            background-color: #28a745;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .search button:hover {
            background-color: #218838;
        }
        .book-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .book-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 18%;
            margin-bottom: 20px;
            transition: transform 0.3s;
            text-align: center;
        }
        .book-card:hover {
            transform: translateY(-5px);
        }
        .book-card img {
            width: 150px;
            height: 220px;
            object-fit: cover;
            border-radius: 10px;
            margin: 10px auto;
            box-shadow: 0 0 8px rgba(0,0,0,0.3);
        }
        .book-card h3 {
            font-size: 20px;
            margin: 10px 0;
            color: #333;
        }
        .book-card p {
            font-size: 15px;
            margin: 5px 10px;
        }
        .book-card .price {
            color: #dc3545;
            font-weight: bold;
        }
        .book-card button {
            background-color: #28a745;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            width: calc(100% - 20px);
            margin: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .book-card button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <nav>
            <ul>
                <li><a href="dashboard.php" class="logo">
                <img src="../Photo/Black and Orange Simple Book Store Logo.png" alt="Logo">
                    <span class="nav-item">BOOKNEST</span>
                </a></li>
                <li><a href="dashboard.php">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="nav-item">Dashboard</span>
                </a></li>
                <li><a href="profile.php">
                    <i class="fas fa-user"></i>
                    <span class="nav-item">Profile</span>
                </a></li>
                <li><a href="order_section.php">
                    <i class="fas fa-box"></i>
                    <span class="nav-item">Order</span>
                </a></li>
                
                <li><a href="buy.php">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="nav-item">Buy</span>
                </a></li>
                <li><a href="sell.php">
                    <i class="fas fa-dollar-sign"></i>
                    <span class="nav-item">Sell</span>
                </a></li>
                <li><a href="about.php">
                    <i class="fas fa-info-circle"></i>
                    <span class="nav-item">About</span>
                </a></li>
                <li><a href="logout.php" class="logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="nav-item">Log out</span>
                </a></li>
            </ul>
        </nav>
    </div>

    <div class="main-content">
        <div class="search">
            <input type="text" id="search" placeholder="Search by book name or author" value="<?= htmlspecialchars($searchQuery) ?>">
            <button onclick="searchBooks()">Search</button>
        </div>

        <div class="book-list">
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="book-card">
                        <img src="<?= htmlspecialchars($row['cover']); ?>" alt="<?= htmlspecialchars($row['title']); ?>">
                        <h3><?= htmlspecialchars($row['title']); ?></h3>
                        <p>Author: <?= htmlspecialchars($row['author']); ?></p>
                        <p class="price">Price: Rs.<?= htmlspecialchars($row['price']); ?></p>
                        <button onclick="purchaseBook(<?= htmlspecialchars($row['id']); ?>)">Purchase</button>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No books found.</p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function searchBooks() {
            const search = document.getElementById('search').value;
            window.location.href = `dashboard.php?search=${search}`;
        }

        function purchaseBook(bookId) {
            window.location.href = `dashboardbookdetails.php?book_id=${bookId}`;
        }
    </script>
</body>
</html>
