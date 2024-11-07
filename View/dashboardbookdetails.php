<?php
include('../connection/connection.php');

// Check if book_id is set and is numeric
if (isset($_GET['book_id']) && is_numeric($_GET['book_id'])) {
    $bookId = intval($_GET['book_id']);

    // Prepare SQL query to fetch book details
    $sql = "SELECT * FROM bookadd WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing the SQL statement: " . $conn->error);
    }

    // Bind parameters and execute the query
    $stmt->bind_param("i", $bookId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
    } else {
        echo "Book not found.";
        $stmt->close();
        $conn->close();
        exit();
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "No valid book ID provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Details | BookNest</title>
  <link rel="stylesheet" href="index.css" />
  <link rel="stylesheet" href="bookDetails.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
</head>
<body>

</style>
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

    <div class="book-details">
      <img id="bookPhoto" src="../uploads/<?php echo htmlspecialchars($book['cover']); ?>" alt="Book Image">
      <div class="details">
        <h1><?php echo htmlspecialchars($book['title']); ?></h1>
        <p>Author: <?php echo htmlspecialchars($book['author']); ?></p>
        <p>ISBN: <?php echo htmlspecialchars($book['isbn']); ?></p>
        <p>Category: <?php echo htmlspecialchars($book['category']); ?></p>
        <p>Language: <?php echo htmlspecialchars($book['language']); ?></p>
        <p class="price">Price: Rs <?php echo htmlspecialchars($book['price']); ?></p>
        <p class="published-date">Published Date: <?php echo htmlspecialchars($book['published_date']); ?></p>
        <p class="pages">Pages: <?php echo htmlspecialchars($book['pages']); ?></p>
        <button class="buy-now" onclick="confirmPurchase()">Confirm Purchase</button>
      </div>
      <input type="hidden" id="bookId" value="<?php echo htmlspecialchars($book['id']); ?>">
      <input type="hidden" id="bookTitle" value="<?php echo htmlspecialchars($book['title']); ?>">
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
        var bookTitle = document.getElementById("bookTitle").value;
        var bookPrice = document.getElementById("bookPrice").value;

        if (bookId && bookTitle && bookPrice) {
          // Redirect to paymentmethod.php with book details
          window.location.href = "dpaymentmethod.php?book_id=" + encodeURIComponent(bookId) +
                                 "&book_title=" + encodeURIComponent(bookTitle) +
                                 "&book_price=" + encodeURIComponent(bookPrice);
        } else {
          alert("Book details are missing.");
        }
      }
    </script>
  </div>
</body>
</html>
