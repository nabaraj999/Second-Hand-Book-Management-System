<?php
include('../connection/connection.php');
session_start();

// Ensure the session is started and the user is logged in
if (!isset($_SESSION['username'])) {
    echo "You need to log in first.";
    exit();
}

$username = $_SESSION['username'];

function displayBook($row, $isSellSection) {
    $statusClass = '';
    $statusMessage = '';

    if ($isSellSection) {
        if ($row['status'] == 'approved') {
            $statusClass = 'status-approved';
            $statusMessage = 'Approved - Waiting for a buyer';
        } else if ($row['status'] == 'pending') {
            $statusClass = 'status-pending';
            $statusMessage = 'Pending admin approval';
            // Show cancel button if status is pending
            echo "<form action='cancel_order.php' method='POST' style='display:inline-block;'>";
            echo "<input type='hidden' name='book_id' value='" . htmlspecialchars($row['id']) . "'>";
            echo "<button type='submit'>Cancel Order</button>";
            echo "</form>";
        } else if ($row['buyer_purchased']) {
            $statusClass = 'status-sold';
            $statusMessage = 'Sold';
        }
    } else {
        $statusClass = 'status-purchased';
        $statusMessage = 'Purchased';
    }

    echo "<div class='book'>";
    echo "<img src='../uploads/" . htmlspecialchars($row['photo']) . "' alt='Book Photo'>";
    echo "<div>";
    echo "<h2>" . htmlspecialchars($row['book_name']) . "</h2>";
    echo "<p class='$statusClass'>Status: $statusMessage</p>";
    echo "</div>"; // End of book details
    echo "</div>"; // End of book
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Section</title>
    <link rel="stylesheet" href="index.css" />
  <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
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


    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .order-container {
            max-width: 1000px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-left: 500px;
        }

        .section-title {
            font-size: 2em;
            margin-bottom: 20px;
            border-bottom: 2px solid #ccc;
            padding-bottom: 10px;
        }

        .book {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            background-color: #f9f9f9;
            display: flex;
            align-items: center;
        }

        .book img {
            max-width: 100px;
            margin-right: 20px;
        }

        .book h2 {
            font-size: 1.5em;
            margin: 0;
        }

        .book p {
            margin: 5px 0;
        }

        button {
            background-color: #f44336;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #e53935;
        }

        .status-approved {
            color: green;
            font-weight: bold;
        }

        .status-pending {
            color: orange;
            font-weight: bold;
        }

        .status-sold {
            color: red;
            font-weight: bold;
        }

        .status-purchased {
            color: blue;
            font-weight: bold;
        }
        
        .coming-soon {
            font-size: 1.5em;
            color: #666;
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="order-container">
        <!-- Sell Section -->
        <h1 class="section-title">Your Listed Books</h1>
        <?php
        // Fetch books where the current user is the seller
        $sql = "SELECT * FROM books WHERE seller_name = ? AND status IN ('approved', 'pending')";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            echo "<p>Error preparing the SQL statement: " . htmlspecialchars($conn->error) . "</p>";
            exit();
        }
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                displayBook($row, true);
            }
        } else {
            echo "<p>No books found in your sell section.</p>";
        }

        $stmt->close();
        ?>

        <!-- Buy Section -->
        <h1 class="section-title">Books You've Purchased</h1>
        <p class="coming-soon">Coming Soon: This feature is not yet available.</p>
    </div>
</body>
</html>
