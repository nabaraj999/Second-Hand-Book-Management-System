<?php
// Start the session
session_start();

// Check if the user is logged in
if(!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: signupa.php");
    exit();
}

// Get the username from the session
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <!-- Font Awesome Cdn Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <!-- Modal CSS -->
</head>
<body>
<link rel="stylesheet" href="index.css" />
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
        <li><a href="message.php">
          <i class="fas fa-comment"></i>
          <span class="nav-item">Message</span>
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


    <link rel="stylesheet" href="paymentmethod.css">
    <div class="containerp">
        <h2>Make a Payment</h2>
        <p>Select a wallet & Bank to scan and complete your payment:</p>

        <div class="wallet-options">
            <img src="../photo/esewa.jpg" alt="eSewa" class="wallet-img" onclick="showModal(this);">
            <img src="../Photo/machhapuchchhre.jpg" alt="MBL" class="wallet-img" onclick="showModal(this);">
            <img src="../Photo/my prabhu bank.jpg" alt="Prabhu" class="wallet-img" onclick="showModal(this);">
        </div>

        <!-- Payment Form -->
        <form action="bill.php" method="post">
            <!-- Book ID (Non-editable) -->
            <div class="form-group">
                <label for="book-id">Book ID:</label>
                <input type="text" id="book-id" name="book_id" readonly>
            </div>

            <!-- Full Name (displayed as Username and non-editable) -->
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $username; ?>" readonly>
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email address" required>
            </div>

            <!-- Phone Number -->
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
            </div>

            <!-- Payment Reference Code -->
            <div class="form-group">
                <label for="code">Payment Reference Code:</label>
                <input type="text" id="reference-code" name="code" placeholder="Enter your payment reference code" required>
            </div>

            <!-- Book Name (Non-editable) -->
            <div class="form-group">
                <label for="book-name">Book Name:</label>
                <input type="text" id="book-name" name="bookname" readonly>
            </div>

            <!-- Amount Paid (Non-editable) -->
            <div class="form-group">
                <label for="amount">Amount Paid:</label>
                <input type="number" id="amount" name="amount" readonly>
            </div>

            <!-- Submit Button -->
            <button type="submit" value="send">Submit Payment</button>
        </form>
    </div>

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <img class="modal-content" id="img01">
        <div id="caption"></div>
    </div>

    <script>
        // Get URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const bookId = urlParams.get('book_id');
        const bookName = urlParams.get('book_name');
        const bookPrice = urlParams.get('book_price');

        // Set the form fields with the book ID, name, and price
        if (bookId && bookName && bookPrice) {
            document.getElementById('book-id').value = bookId;
            document.getElementById('book-name').value = bookName;
            document.getElementById('amount').value = bookPrice;
        }

        // Show the modal with the clicked image
        function showModal(imgElement) {
            var modal = document.getElementById("myModal");
            var modalImg = document.getElementById("img01");
            var captionText = document.getElementById("caption");

            modal.style.display = "block";
            modalImg.src = imgElement.src;
            captionText.innerHTML = imgElement.alt;
        }

        // Close the modal
        function closeModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
        }
    </script>
</div>
</body>
</html>