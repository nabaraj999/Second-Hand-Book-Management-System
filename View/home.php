<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Home - BOOKNEST</title>
  <link rel="icon" href="../Photo/Black_and_Orange_Simple_Book_Store_Logo.png" type="image/png"/>
  <link rel="stylesheet" href="index.css" />
  <!-- Font Awesome CDN Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <link rel="stylesheet" href="home.css">
</head>
<body>
  
  <div class="container">
    <nav>
      <ul>
        <li><a href="home.php" class="logo">
          <img src="../Photo/Black and Orange Simple Book Store Logo.png" alt="Logo">
          <span class="nav-item">BOOKNEST</span>
        </a></li>

        <li><a href="home.php" class="active">
          <i class="fas fa-home"></i>
          <span class="nav-item">Home</span>
        </a></li>

        <li><a href="signupa.php">
          <i class="fas fa-user"></i>
          <span class="nav-item">Profile</span>
        </a></li>

        <li><a href="signupa.php">
          <i class="fas fa-box"></i>
          <span class="nav-item">Order</span>
        </a></li>
       
        <li><a href="signupa.php">
          <i class="fas fa-shopping-cart"></i>
          <span class="nav-item">Buy</span>
        </a></li>
        <li><a href="signupa.php">
          <i class="fas fa-dollar-sign"></i>
          <span class="nav-item">Sell</span>
        </a></li>
        <li><a href="signupa.php">
          <i class="fas fa-info-circle"></i>
          <span class="nav-item">About</span>
        </a></li>
       
      </ul>
    </nav>

    <section class="main">
      <!-- Welcome Section -->
      <div class="welcome-section">
        <h1>Welcome to BOOKNEST</h1>
        <p>Your gateway to knowledge and books.</p>
        <button onclick="window.location.href='./signup.php'">Join Us</button>
      </div>

      <!-- Introduction Section -->
      <div class="introduction">
        <h2>About BOOKNEST</h2>
        <p>
          BOOKNEST is your one-stop platform for learning and book trading. We offer a range of free and paid courses,
          along with a dynamic marketplace to buy and sell books. Whether you are here to enhance your skills or to
          explore the world of books, BOOKNEST has something for everyone.
        </p>
      </div>

      <!-- Courses Section -->
      <div class="course-section">
        <h2>Upcomming Courses</h2>
        <div class="courses">
          <div class="course-card">
            <img src="../Photo/html.png" alt="HTML Course" class="course-img">
            <h3>HTML</h3>
            <p>Free</p>
          </div>
          <div class="course-card">
            <img src="../Photo/css.png" alt="CSS Course" class="course-img">
            <h3>CSS</h3>
            <p>Free</p>
          </div>
          <div class="course-card">
            <img src="../Photo/js.png" alt="JavaScript Course" class="course-img">
            <h3>JavaScript</h3>
            <p>Free</p>
          </div>
          <div class="course-card">
            <img src="../Photo/wordpress.png" alt="WordPress Course" class="course-img">
            <h3>WordPress</h3>
            <p>Paid</p>
          </div>
          <div class="course-card">
            <img src="../Photo/web-dev.png" alt="Web Development Course" class="course-img">
            <h3>Web Development</h3>
            <p>Paid</p>
          </div>
          <div class="course-card">
            <img src="../Photo/gd.png" alt="Graphic Design Course" class="course-img">
            <h3>Graphic Design</h3>
            <p>Paid</p>
          </div>
          <div class="course-card">
            <img src="../Photo/ios.png" alt="iOS Development Course" class="course-img">
            <h3>iOS Development</h3>
            <p>Paid</p>
          </div>
        </div>
      </div>

      <!-- Marketplace Section -->
      <div class="marketplace-section">
        <h2>Book Buy & Sell Platform</h2>
        <p>
          BOOKNEST offers a vibrant marketplace where you can buy and sell books. Discover your next favorite read or
          find a new home for your old books. Explore the possibilities today!
        </p>
        <button onclick="window.location.href='signupa.php'">Buy Books</button>
        <button onclick="window.location.href='signupa.php'">Sell Books</button>
      </div>

      <!-- Review Section -->
      <div class="review-section">
        <h2>What Our Users Say</h2>
        <div class="reviews">
          <div class="review">
            <img src="../Photo/random1.webp" alt="User Photo" class="user-img">
            <p>"BOOKNEST is a game-changer! I learned web development and sold my old textbooks here. Highly recommend!" - Jane Doe</p>
          </div>
          <div class="review">
            <img src="../Photo/random2.webp" alt="User Photo" class="user-img">
            <p>"The courses are fantastic and the book marketplace is very convenient. Love this platform!" - John Smith</p>
          </div>
          <div class="review">
            <img src="../Photo/randomg1.webp" alt="User Photo" class="user-img">
            <p>"An amazing platform with valuable resources and a user-friendly book exchange. Totally worth joining!" - Emily Johnson</p>
          </div>
          <div class="review">
            <img src="../Photo/random3.jpg" alt="User Photo" class="user-img">
            <p>"The course content is top-notch, and the book trading is seamless. Great job, BOOKNEST!" - Michael Brown</p>
          </div>
        </div>
      </div>

      <!-- Login Section -->
      <div class="login-section">
        <h2>Join BOOKNEST Today</h2>
        <p>
          Don't miss out on the incredible opportunities at BOOKNEST. Sign up today to start learning and trading, or
          log in if you're already a member.
        </p>
        <button onclick="window.location.href='../controller/login.php'">Sign Up</button>
        <button onclick="window.location.href='../controller/login.php'">Log In</button>
      </div>
    </section>
  </div>
</body>
</html>
