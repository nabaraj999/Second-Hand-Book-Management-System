<?php
// Database connection
$servername = "localhost";
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$dbname = "booknest"; // replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname,3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the most recent payment record
$sql = "SELECT id, name, email, phone, reference_code, bookname, amount, created_at FROM buybooks_payment ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the payment details
    $row = $result->fetch_assoc();

    $billNo = $row['id'];
    $name = $row['name'];
    $email = $row['email'];
    $phone = $row['phone'];
    $referenceCode = $row['reference_code'];
    $bookName = $row['bookname'];
    $amount = $row['amount'];
    $createdAt = $row['created_at'];
    
    // Calculate final amount (adding delivery charge of 40)
    $deliveryCharge = 40;
    $finalAmount = $amount + $deliveryCharge;
    
} else {
    echo "No payment records found.";
    $conn->close();
    exit();
}

$conn->close();
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

    <title>Bill #<?php echo $billNo; ?></title>
    <style>
        .bill-container {
          width: 550px;
          margin: auto;
          padding: 20px;
          border: 1px solid #ccc;
          box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
          font-family: Arial, sans-serif;
          margin-top: 5px;
      }
      .bill-header {
          text-align: center;
          margin-bottom: 30px;
          position: relative;
      }
      .bill-header img {
          position: absolute;
          left: 0;
          top: 0;
          width: 80px;
          height: auto;
          box-shadow: 3px 3px 8px rgba(0, 0, 0, 0.3); /* Added shadow to logo */
      }
      .bill-header h2 {
          margin: 0;
      }
      .bill-header h3 {
          margin: 0;
          font-size: 18px;
      }
      .bill-info {
          display: flex;
          justify-content: space-between;
          margin-bottom: 20px;
      }
      .bill-info div {
          width: 48%;
      }
      .bill-table {
          width: 100%;
          border-collapse: collapse;
          margin-bottom: 20px;
      }
      .bill-table, .bill-table th, .bill-table td {
          border: 1px solid #ccc;
      }
      .bill-table th, .bill-table td {
          padding: 10px;
          text-align: left;
      }
      .bill-footer {
          text-align: center;
          margin-top: 30px;
          line-height: 1.5;
      }
      .bill-footer .thank-you {
          margin-bottom: 10px;
          font-weight: bold;
      }
      .bill-actions {
          text-align: center;
          margin-top: 20px;
      }
      .bill-actions button {
          padding: 10px 20px;
          margin: 5px;
          border: none;
          background-color: #007BFF;
          color: white;
          cursor: pointer;
          font-size: 16px;
      }
      .bill-actions button:hover {
          background-color: #0056b3;
      }

      @media print {
    /* Hide the sidebar */
    nav {
        display: none;
    }
    
    /* Hide the header */
    header {
        display: none;
    }

    /* Hide the print and download buttons */
    .bill-actions {
        display: none;
    }

    /* Ensure the bill content is centered and uses the full width */
    .bill-container {
        width: 100%;
        margin: 0;
        box-shadow: none;
        border: none;
    }
}

  </style>
</head>
<body>
  <div class="bill-container">
      <div class="bill-header">
          <img src="../Photo/Black and Orange Simple Book Store Logo.png" alt="Company Logo">
          <h2>BookNest</h2>
          <h3>Payment Receipt</h3>
      </div>
      <div class="bill-info">
          <div>
              <p><strong>Bill No:</strong> #<?php echo $billNo; ?></p>
          </div>
          <div style="text-align: right;">
              <p><strong>Date & Time:</strong> <?php echo date("d-m-Y H:i:s", strtotime($createdAt)); ?></p>
          </div>
      </div>
      
      <table class="bill-table">
          <tr>
              <th>Book Name</th>
              <td><?php echo $bookName; ?></td>
          </tr>
          <tr>
              <th>Customer Name</th>
              <td><?php echo $name; ?></td>
          </tr>
          <tr>
              <th>Email</th>
              <td><?php echo $email; ?></td>
          </tr>
          <tr>
              <th>Phone</th>
              <td><?php echo $phone; ?></td>
          </tr>
          <tr>
              <th>Payment Reference Code</th>
              <td><?php echo $referenceCode; ?></td>
          </tr>
          <tr>
              <th>Amount Paid</th>
              <td>Rs. <?php echo number_format($amount, 2); ?></td>
          </tr>
          <tr>
              <th>Delivery Charge</th>
              <td>Rs. <?php echo number_format($deliveryCharge, 2); ?></td>
          </tr>
          <tr>
              <th>Total Amount</th>
              <td><strong>Rs. <?php echo number_format($finalAmount, 2); ?></strong></td>
          </tr>
      </table>

      <div class="bill-footer">
          <div class="thank-you">Thank you for your purchase!</div>
          <hr>
          <div>Admin Mail: booknestjbc.com@gmail.com</div>
          <div>JBC Lalitpur Nepal | Tel: 9861404971</div>
      </div>

      <div class="bill-actions">
          <button onclick="window.print()">Print</button>
          <button onclick="downloadBill()">Download</button>
      </div>
  </div>

  <script>
      function downloadBill() {
          window.print(); // You can replace this with actual download logic if needed
      }
  </script>
</body>
</html>