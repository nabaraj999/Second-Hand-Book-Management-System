<?php
// Start the session
session_start();

// Check if the user is logged in
if(!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Get the username from the session
$username = $_SESSION['username'];
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

        <li><a href="order_section.php">
          <i class="fas fa-box"></i>
          <span class="nav-item">Order</span>
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
  </div>

  <div class="containera">
      <form id="bookSellForm" action="sells.php" method="POST" enctype="multipart/form-data">
          <h2>Sell Your Book</h2>

          <!-- Seller Name (Read-only, populated from session) -->
          <div class="form-group">
              <label for="sellerName">Seller Name</label>
              <input type="text" id="sellerName" name="sname" value="<?php echo $username; ?>" readonly>
          </div>

          <div class="form-group">
              <label for="email">Email Address</label>
              <input type="email" id="email" name="email" required>
          </div>

          <div class="form-group">
              <label for="bookCategory">Book Category</label>
              <select id="bookCategory" name="bookCategory" onchange="handleCategoryChange()" required>
                  <option value="">Select Category</option>
                  <option value="Academic">Academic</option>
                  <option value="Literature">Literature</option>
                  <option value="History">History</option>
                  <option value="Other">Other</option>
              </select>
          </div>

          <div id="academicFields" style="display:none;">
              <div class="form-group">
                  <label for="level">Level</label>
                  <input type="text" id="level" name="level">
              </div>
              <div class="form-group">
                  <label for="class">Class</label>
                  <input type="text" id="class" name="class">
              </div>
          </div>

          <div class="form-group">
              <label for="bookName">Book Name</label>
              <input type="text" id="bookName" name="book_name" required>
          </div>

          <div class="form-group">
              <label for="author">Author</label>
              <input type="text" id="author" name="author" required>
          </div>

          <div class="form-group">
              <label for="price">Price (in Rs)</label>
              <input type="number" id="price" name="price" required>
          </div>

          <div class="form-group">
              <label for="discount">Discount (%)</label>
              <input type="number" id="discount" name="discount">
          </div>

          <div class="form-group">
              <label for="isbn">ISBN Number</label>
              <input type="text" id="isbn" name="isbn">
          </div>

          <div class="form-group">
              <label for="bookPhoto">Book Photo</label>
              <input type="file" id="bookPhoto" name="photo" required>
          </div>

          <div class="form-group">
              <label for="aboutBook">About the Book</label>
              <textarea id="aboutBook" name="description"></textarea>
          </div>

          <button type="submit">Submit</button>
      </form>
  </div>

  <style>
    /* General Form Container */
    .containera {
      max-width: 80%;
      width: 600px;
      background-color: #f9f9f9;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 5px);
      margin-left: 550px;
      border-radius: 8px;
    }
    .containera h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    /* Form Group Styling */
    .form-group {
        margin-bottom: 15px;
        margin-left: 100px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #555;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 450px;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    /* Input and Select Fields */
    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="number"],
    .form-group input[type="file"],
    .form-group select {
        background-color: #fff;
        color: #333;
    }

    .form-group input[type="text"]:focus,
    .form-group input[type="email"]:focus,
    .form-group input[type="number"]:focus,
    .form-group input[type="file"]:focus,
    .form-group select:focus {
        border-color: #4CAF50;
        outline: none;
    }

    /* Textarea */
    .form-group textarea {
        resize: vertical;
        height: 130px;
    }

    /* Academic Fields Group */
    #academicFields {
        margin-top: 15px;
    }

    /* Submit Button */
    button[type="submit"] {
        width: 100px;
        padding: 12px;
        background-color: #4CAF50;
        border: none;
        border-radius: 5px;
        color: white;
        font-size: 18px;
        cursor: pointer;
        margin-top: 10px;
        margin-left: 300px;
        margin-bottom: 20px;
    }

    button[type="submit"]:hover {
        background-color: #45a049;
    }

    /* Responsive Design */
    @media (max-width: 600px) {
        .containera {
            padding: 15px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            font-size: 14px;
        }

        button[type="submit"] {
            font-size: 16px;
        }
    }
  </style>

  <script>
    function handleCategoryChange() {
        var category = document.getElementById("bookCategory").value;
        var academicFields = document.getElementById("academicFields");
        academicFields.style.display = category === 'Academic' ? 'block' : 'none';
    }
  </script>
</body>
</html>
