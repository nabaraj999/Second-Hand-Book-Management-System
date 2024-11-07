<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <title>BookNest</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="container">
        <nav>
            <ul>
                <li><a href="index.html" class="logo">
                    <img src="../Photo/Black and Orange Simple Book Store Logo.png" alt="Logo">
                    <span class="nav-item">BOOKNEST</span>
                </a></li>
                <li><a href="dashboard.php">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="nav-item">Dashboard</span>
                </a></li>
                <li><a href="dashboard.php">
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

        <link rel="stylesheet" href="buy.css">
        <div>
            <!-- PHP logic to handle book filtering and searching -->
            <?php
            include('../connection/connection.php');

            // Initialize variables
            $categoryFilter = isset($_GET['category']) ? $conn->real_escape_string($_GET['category']) : '';
            $searchQuery = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

            // SQL query to filter by category and search term
            $sql = "SELECT * FROM books WHERE status='approved'";

            if ($categoryFilter) {
                $sql .= " AND book_category='$categoryFilter'";
            }

            if ($searchQuery) {
                $sql .= " AND (book_name LIKE '%$searchQuery%' OR author LIKE '%$searchQuery%')";
            }

            $result = $conn->query($sql);

            // Check for query execution errors
            if ($result === FALSE) {
                echo "Error executing query: " . $conn->error;
                exit();
            }
            ?>

            <div class="filter-container">
                <!-- Book Category Filter -->
                <div class="form-group">
                    <label for="bookCategory">Book Category</label>
                    <select id="bookCategory" name="category" onchange="handleCategoryChange()" required>
                        <option value="">All Categories</option>
                        <option value="Academic" <?php echo $categoryFilter == 'Academic' ? 'selected' : ''; ?>>Academic</option>
                        <option value="Literature" <?php echo $categoryFilter == 'Literature' ? 'selected' : ''; ?>>Literature</option>
                        <option value="History" <?php echo $categoryFilter == 'History' ? 'selected' : ''; ?>>History</option>
                        <option value="Other" <?php echo $categoryFilter == 'Other' ? 'selected' : ''; ?>>Other</option>
                    </select>
                </div>

                <!-- Search Bar -->
                <div class="form-group">
                    <label for="searchBar">Search</label>
                    <input type="text" id="searchBar" name="search" placeholder="Search by book name or author" value="<?php echo htmlspecialchars($searchQuery); ?>">
                    <button type="button" onclick="handleSearch()">Search</button>
                </div>
            </div>

            <div class="book-grid">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="book-card">';
                    echo '<img src="../uploads/' . htmlspecialchars($row['photo']) . '" alt="Book Photo">';
                    echo '<h2>' . htmlspecialchars($row['book_name']) . '</h2>';
                    echo '<p>Author: ' . htmlspecialchars($row['author']) . '</p>';
                    echo '<p>Price: Rs ' . htmlspecialchars($row['price']) . '</p>';
                    echo '<p class="discount">Discount: ' . htmlspecialchars($row['discount']) . '%</p>';
                    
                    // Embedded form and button for buying the book
                    echo '<form id="buyForm_' . $row['id'] . '" action="bookDetails.php" method="get">';
                    echo '<input type="hidden" name="book_id" value="' . $row['id'] . '">';
                    echo '<button type="button" class="buy-button" onclick="buyNow(' . $row['id'] . ')">Buy</button>';
                    echo '</form>';

                    echo '</div>';
                }
            } else {
                echo '<p>No books found.</p>';
            }

            $conn->close();
            ?>
            </div>
        </div>
    </div>

    <script>
        function handleCategoryChange() {
            const selectedCategory = document.getElementById('bookCategory').value;
            const searchQuery = document.getElementById('searchBar').value;

            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('category', selectedCategory);
            urlParams.set('search', searchQuery);

            window.location.search = urlParams.toString();
        }

        function handleSearch() {
            const selectedCategory = document.getElementById('bookCategory').value;
            const searchQuery = document.getElementById('searchBar').value;

            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('category', selectedCategory);
            urlParams.set('search', searchQuery);

            window.location.search = urlParams.toString();
        }

        function buyNow(bookId) {
            document.getElementById('buyForm_' + bookId).submit();
        }
    </script>
</body>
</html>
