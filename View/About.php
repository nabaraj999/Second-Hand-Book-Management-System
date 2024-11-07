<?php
session_start(); // Start the session

// Example of setting a session variable (for demonstration purposes)
if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = 'Guest'; // Default value if not logged in
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - BOOKNEST</title>
    <link rel="stylesheet" href="index.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            margin-left: 300px;
            padding: 20px;
            width: 80%;
        }

        .about, .feedback {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .feedback {
            margin-left: 300px;
            width: 79%;
        }

        .about h1, .feedback h2 {
            color: #333;
            text-align: center;
        }

        .about p, .feedback label {
            margin-bottom: 10px;
            line-height: 1.6;
        }

        .feedback form {
            display: flex;
            flex-direction: column;
            width: 85%;
        }

        .feedback label {
            margin-top: 10px;
        }

        .feedback input, .feedback textarea {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .feedback button {
            margin-top: 10px;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .feedback button:hover {
            background-color: #0056b3;
        }

        .team-photo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }

        .team-section {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .team-info {
            margin-left: 20px;
        }

        .team-info h3 {
            margin: 0;
        }

        .team-info p {
            margin: 5px 0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                margin-left: 0;
            }

            .team-section {
                flex-direction: column;
                align-items: flex-start;
            }

            .team-photo {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
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

    <div class="container">
        <section class="about">
            <h1>About BOOKNEST</h1>
            <p><strong>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</strong></p>
            <p><strong>Mission Statement:</strong> At BOOKNEST, our mission is to connect book enthusiasts with their favorite reads through an easy-to-use online platform. We aim to offer a seamless experience for buying and selling books while fostering a vibrant community of readers and sellers.</p>
            <p><strong>Features:</strong> Our platform includes a comprehensive book management system, real-time messaging for communication, detailed order management, and an intuitive interface for browsing and purchasing books. We also offer a range of tools for users to manage their sales and purchases efficiently.</p>
            <p><strong>History:</strong> BOOKNEST was established in 2081 (B.S.) with the goal of revolutionizing the online book market. Since our inception, we have continuously evolved, adding new features and improving our services to meet the needs of our users.</p>
            <p><strong>Team:</strong> BOOKNEST is developed and maintained by a dedicated team.</p>

            <div class="team-section">
                <img src="../photo/pp.jpg" alt="Nabaraj Acharya" class="team-photo">
                <div class="team-info">
                    <h3>Nabaraj Acharya</h3>
                    <p><strong>Developer</strong></p>
                    <p>Email: <a href="mailto:nabarajacharya999@gmail.com">nabarajacharya999@gmail.com</a></p>
                    <p>Website: <a href="https://nabrajacharya.com.np" target="_blank">nabrajacharya.com.np</a></p>
                </div>
            </div>

            <div class="team-section">
                <img src="../photo/sushil.jpg" alt="Sushil Timalshina" class="team-photo">
                <div class="team-info">
                    <h3>Sushil Timalshina</h3>
                    <p><strong> Developer</strong></p>
                    <p>Email: <a href="mailto:sushiltimalshina@gmail.com">sushiltimalshina@gmail.com</a></p>
                    <p>LinkedIn: <a href="https://www.linkedin.com/in/sushil-timalshina" target="_blank">linkedin.com/in/sushil-timalshina</a></p>
                </div>
            </div>

            <p><strong>Contact Information:</strong> For any inquiries or support, please reach out to us at <a href="mailto:support@booknest.com">support@booknest.com</a> or through our contact page.</p>
            <p><strong>Values:</strong> We value customer satisfaction, transparency, and innovation. Our goal is to provide a platform that is reliable, user-friendly, and continuously improving to meet the needs of our community.</p>
        </section>
    </div>

    <section class="feedback">
        <h2>We Value Your Feedback</h2>
        <form action="submit_feedback.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Feedback:</label>
            <textarea id="message" name="message" rows="5" required></textarea>

            <button type="submit">Submit Feedback</button>
        </form>
    </section>
</body>
</html>
