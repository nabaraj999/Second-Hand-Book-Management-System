<?php
include ('connection.php');
session_start();

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Prepare and execute the statement
    $stmt = $conn->prepare("SELECT * FROM adminpanel WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Directly compare passwords (not secure, only for demonstration)
        if ($password === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: adminpanelindex.php");
            exit;
        } else {
            $error_message = 'Invalid password. Please try again.';
        }
    } else {
        $error_message = 'No account found with that username.';
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Same styling as previous */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }
        .logo img {
            width: 60px;
            margin-bottom: 20px;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
            position: relative;
            text-align: left;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            color: #333;
        }
        .form-group input {
            width: 95%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #888;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .btn-login {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-login:hover {
            background-color: #0056b3;
        }
        .additional-links {
            text-align: center;
            margin-top: 20px;
        }
        .admin-user-links {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }
        .button-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .button-link:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <img src="../Photo/Black and Orange Simple Book Store Logo.png" alt="Logo">
        </div>
        <h2>Admin Login</h2>

        <?php if (isset($error_message) && $error_message != '') { ?>
            <div class="error"><?php echo $error_message; ?></div>
        <?php } ?>
        

        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <span class="toggle-password" onclick="togglePassword()">👁️</span>
            </div>
            <button type="submit" name="login" class="btn-login">Login</button>
        </form>

        <div class="additional-links">
            <a href="#">Forgot Password?</a>

            <div class="admin-user-links">
                <a href="adminlogin.php" class="button-link">Admin</a>
                <a href="login.php" class="button-link">User</a>
            </div>

            <p>Don't have an account? <a href="#">Sign Up</a></p>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById("password");
            const passwordToggle = document.querySelector(".toggle-password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                passwordToggle.textContent = "🙈";
            } else {
                passwordField.type = "password";
                passwordToggle.textContent = "👁️";
            }
        }
    </script>
</body>
</html>
