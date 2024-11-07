<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Login</title>
    <link rel="stylesheet" href="adminpanellogin.css">
</head>
<body>

    <div class="container">
        <img src="../Photo/Black and Orange Simple Book Store Logo.png" alt="Logo"> <!-- Placeholder for your logo -->
    
        <!-- Login Form -->
        <form id="login-form" action="../controller/adminpl.php" method="POST">
            <h2>Login</h2>
            <div class="form-group">
                <label for="login-username">Username</label>
                <input type="text" id="login-username" name="username" required>
            </div>
            <div class="form-group">
                <label for="login-password">Password</label>
                <input type="password" id="login-password" name="password" required>
                <span class="toggle-password" onclick="togglePassword('login-password')">Show</span>
            </div>
            <div class="form-group">
                <button type="button" onclick="submitLoginForm()">Login</button>
            </div>
            <div class="button-group">
                <button type="button" onclick="submitLoginForm('admin')">Admin</button>
                <button type="button" onclick="submitLoginForm('user')">User</button>
            </div>
            <div class="form-group forgot-password">
                <a href="#" onclick="showForgotPassword()">Forgot Password?</a>
            </div>
        </form>
    
        <!-- Forgot Password Form -->
        <form id="forgot-password-form" action="forgotpassword.php" method="POST">
            <h2>Reset Password</h2>
            <div class="form-group">
                <label for="forgot-email">Email</label>
                <input type="email" id="forgot-email" name="email" required>
            </div>
            <div class="form-group">
                <label for="forgot-new-password">New Password</label>
                <input type="password" id="forgot-new-password" name="new_password" required>
                <span class="toggle-password" onclick="togglePassword('forgot-new-password')">Show</span>
            </div>
            <div class="form-group">
                <label for="forgot-confirm-password">Confirm New Password</label>
                <input type="password" id="forgot-confirm-password" name="confirm_password" required>
                <span class="toggle-password" onclick="togglePassword('forgot-confirm-password')">Show</span>
            </div>
            <div class="form-group">
                <button type="submit">Reset Password</button>
            </div>
            <div class="form-group forgot-password">
                <a href="#" onclick="showLogin()">Back to Login</a>
            </div>
        </form>
        
    </div>

<script>
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        input.type = input.type === 'password' ? 'text' : 'password';
    }

    function submitLoginForm(role) {
        const form = document.getElementById('login-form');
        
        if (role === 'admin') {
            form.action = 'adminpanellogin.php';
        } else if (role === 'user') {
            form.action = 'signupa.php';
        } else {
        }
        
        form.submit();
    }

    function showLogin() {
        document.getElementById('login-form').style.display = 'block';
        document.getElementById('forgot-password-form').style.display = 'none';
    }

    function showForgotPassword() {
        document.getElementById('login-form').style.display = 'none';
        document.getElementById('forgot-password-form').style.display = 'block';
    }
</script>

</body>
</html>
