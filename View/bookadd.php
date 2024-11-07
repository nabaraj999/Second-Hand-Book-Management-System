<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a Book</title>
    <link rel="stylesheet" href="bookadd.css">
    <link rel="stylesheet" href="adminpanelindex.css" />
    <!-- Font Awesome Cdn Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <style>
        /* Style for the Account and Remove Book buttons */
        .action-buttons {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            gap: 20px;
        }

        .action-buttons button {
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .action-buttons button:hover {
            background-color: #218838;
        }

        .action-buttons .remove-book-btn {
            background-color: #dc3545;
        }

        .action-buttons .remove-book-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
  <div class="container">
    <nav>
      <ul>
        <li><a href="#" class="logo">
          <img src="../Photo/Black and Orange Simple Book Store Logo.png" alt="Logo">
          <span class="nav-item">BOOKNEST</span>
        </a></li>

        <li><a href="adminpanelindex.php">
          <i class="fas fa-home"></i>
          <span class="nav-item">Home</span>
        </a></li>

        <li><a href="users.php">
          <i class="fas fa-user"></i>
          <span class="nav-item">User</span>
        </a></li>

        <li><a href="bookmanage.php">
          <i class="fas fa-shopping-cart"></i>
          <span class="nav-item">Buy</span>
        </a></li>

        <li><a href="adminsell.php">
          <i class="fas fa-dollar-sign"></i>
          <span class="nav-item">Sell</span>
        </a></li>
        <li><a href="signupa.php" class="logout">
          <i class="fas fa-sign-out-alt"></i>
          <span class="nav-item">Log out</span>
        </a></li>
      </ul>
    </nav>

    <!-- Action buttons for Account and Remove Book -->
    <div class="action-buttons">
        <button onclick="window.location.href='../controller/payment_process.php'">Account</button>
        <button class="remove-book-btn" onclick="window.location.href='../controller/removebook.php'">Remove Book</button>
    </div>

    <div class="form-container">
        <h2>Add a Book</h2>
        <form action="../controller/addbook.php" method="post" enctype="multipart/form-data">
            <label for="title">Book Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="author">Author:</label>
            <input type="text" id="author" name="author" required>

            <label for="isbn">ISBN:</label>
            <input type="text" id="isbn" name="isbn" required>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" required>

            <label for="published_date">Published Date:</label>
            <input type="date" id="published_date" name="published_date" required>

            <label for="category">Category:</label>
            <select id="category" name="category[]" multiple required>
                <option value="Fiction">Fiction</option>
                <option value="Non-Fiction">Non-Fiction</option>
                <option value="Science Fiction">Science Fiction</option>
                <option value="Fantasy">Fantasy</option>
                <option value="Mystery">Mystery</option>
                <option value="Biography">Biography</option>
                <option value="Self-Help">Self-Help</option>
                <option value="Children's Books">Children's Books</option>
                <option value="Educational">Educational</option>
                <option value="Novel">Novel</option>
            </select>

            <label for="language">Language:</label>
            <input type="text" id="language" name="language" required>

            <label for="pages">Pages:</label>
            <input type="number" id="pages" name="pages" required>

            <label for="cover">Book Cover:</label>
            <input type="file" id="cover" name="cover" accept="image/*" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea>

            <button type="submit">Add Book</button>
        </form>
    </div>

    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            var category = document.getElementById('category');
            if (category.selectedOptions.length < 1) {
                alert('Please select at least one category.');
                e.preventDefault();
            }
        });
    </script>

</body>
</html>
