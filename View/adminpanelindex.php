<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard | By Code Info</title>
  <link rel="stylesheet" href="adminpanelindex.css" />
  <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
</head>
<body>
  <div class="container">
    <nav>
      <ul>
        <li><a href="#" class="logo">
          <img src="../Photo/Black and Orange Simple Book Store Logo.png" alt="Logo">
          <span class="nav-item">BOOKNEST</span>
        </a></li>

        <li><a href="#">
          <i class="fas fa-home"></i>
          <span class="nav-item">Home</span>
        </a></li>

        <li><a href="users.php">
          <i class="fas fa-user"></i>
          <span class="nav-item">User</span>
        </a></li>

        <li><a href="../controller/bookmanage.php">
          <i class="fas fa-shopping-cart"></i>
          <span class="nav-item">Buy</span>
        </a></li>

        <li><a href="../controller/adminsell.php">
          <i class="fas fa-dollar-sign"></i>
          <span class="nav-item">Sell</span>
        </a></li>
        <li><a href="signupa.php" class="logout">
          <i class="fas fa-sign-out-alt"></i>
          <span class="nav-item">Log out</span>
        </a></li>
      </ul>
    </nav>

    <section class="main">
      <div class="main-top">
        <h1 style="text-align: center;">Admin Panel </h1>
        <i class="fas fa-user-cog"></i>
      </div>
      <div class="main-skills">
        <div class="card">
          <i class="fas fa-">🛒</i>
          <h3>Buy</h3>
          <p>Book buyer details</p>
          <button onclick="location.href='../controller/bookmanage.php';">Details</button>
        </div>

        <div class="card">
          <i class="fab fa-dollar-sign">💸</i>
          <h3>Sell</h3>
          <p>Book Seller Details.</p>
          <button onclick="location.href='../controller/adminsell.php';">Details</button>
        </div>
        
        <div class="card">
          <i class="fab fa-dollar-sign">💸</i>
          <h3>Add Book</h3>
          <p>Book Seller Details.</p>
          <button onclick="location.href='bookadd.php';">Add Book</button>
        </div>

        <div class="card">
          <i class="fas fa-">✉️</i>
          <h3>Message</h3>
          <p>Message user to admin</p>
          <button>Details</button>
        </div>
        <div class="card">
          <i class="fab fa-user">👨🏻‍💻</i>
          <h3>User</h3>
          <p>User Manage</p>
          <button onclick="location.href='../controller/users.php';">Manage</button>
        </div>
      </div>

      <section class="main-course">
        <h1 style="text-align: center;">Other</h1>
        <div class="course-box">
          <ul>
            <li class="active">Other</li>
            
          </ul>
          <div class="course">
            <div class="box">
              <h3>Account</h3>
              <p>Total books sells payment details</p>
              <button>View Now</button>
              <i class="fab fa-money-Account">💳</i>
            </div>
            <div class="box">
        <h3>Feedback & Comment</h3>
        <p>User & Customer Comment</p>
        <button onclick="viewFeedback()">View Now</button>
        <i class="fab fa-comments">📝</i>
    </div>

            <div class="box">
              <h3>Updates</h3>
              <p>New features </p>
              <button>View Now</button>
              <i class="fab fa-">🆕</i>
            </div>
          </div>
        </div>
      </section>
    </section>
  </div>
  <script>
        function viewFeedback() {
            window.location.href = '../controller/feedback.php'; // Replace with the URL you want to navigate to
        }
    </script>
</body>
</html>
