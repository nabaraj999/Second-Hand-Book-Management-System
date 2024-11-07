<?php
include('../connection/connection.php');

if (isset($_GET['book_id'])) {
    $bookId = $_GET['book_id'];

    // Fetch book details from the database using the book ID
    $sql = "SELECT * FROM books WHERE id='$bookId' AND status='approved'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
    } else {
        echo "Book not found.";
        exit();
    }
} else {
    echo "No book ID provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard | By Code Info</title>
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


        <li><a href="order.php">
          <i class="fas fa-box"></i>
          <span class="nav-item">Order</span>
        </a></li>
        <li><a href="message.php">
          <i class="fas fa-comment"></i>
          <span class="nav-item">Message</span>
        </a></li>
        <li><a href="buy.php">
          <i class="fas fa-shopping-cart"></i>
          <span class="nav-item">Buy</span>
        </a></li>
        <li><a href="sell.html">
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
<link rel="stylesheet" href="bookDetails.css">
</head>
<body>
    <div class="book-details">
    <img id="bookPhoto" src="<?php echo htmlspecialchars('../uploads/' . $book['photo']); ?>" alt="Book Image">
        <div class="details">
            <h1><?php echo htmlspecialchars($book['book_name']); ?></h1>
            <p>Author: <?php echo htmlspecialchars($book['author']); ?></p>
            <p>ISBN: <?php echo htmlspecialchars($book['isbn']); ?></p>
            <p>Description: <?php echo htmlspecialchars($book['description']); ?></p>
            <p>Category: <?php echo htmlspecialchars($book['book_category']); ?></p>
            <p>Level: <?php echo htmlspecialchars($book['level']); ?></p>
            <p>Class: <?php echo htmlspecialchars($book['class']); ?></p>
            <p class="price">Price: Rs <?php echo htmlspecialchars($book['price']); ?></p>
            <p class="discount">Discount: <?php echo htmlspecialchars($book['discount']); ?>%</p>
            <button class="buy-now" onclick="confirmPurchase()">Confirm Purchase</button>
        </div>
        <input type="hidden" id="bookId" value="<?php echo htmlspecialchars($book['id']); ?>">
        <input type="hidden" id="bookName" value="<?php echo htmlspecialchars($book['book_name']); ?>">
        <input type="hidden" id="bookPrice" value="<?php echo htmlspecialchars($book['price']); ?>">
    </div>

    <!-- Modal for viewing the photo -->
    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="img01">
    </div>

    <script>
        // JavaScript for modal functionality
        var modal = document.getElementById("myModal");
        var img = document.getElementById("bookPhoto");
        var modalImg = document.getElementById("img01");
        var span = document.getElementsByClassName("close")[0];

        img.onclick = function(){
            modal.style.display = "block";
            modalImg.src = this.src;
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        function confirmPurchase() {
            var bookId = document.getElementById("bookId").value;
            var bookName = document.getElementById("bookName").value;
            var bookPrice = document.getElementById("bookPrice").value;

            if (bookId && bookName && bookPrice) {
                // Redirect to paymentmethod.php with book details
                window.location.href = "paymentmethod.php?book_id=" + encodeURIComponent(bookId) +
                                       "&book_name=" + encodeURIComponent(bookName) +
                                       "&book_price=" + encodeURIComponent(bookPrice);
            } else {
                alert("Book details are missing.");
            }
        }
    </script>
</body>
</html>
