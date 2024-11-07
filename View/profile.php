<?php
session_start();
include('../connection/connection.php');

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: signupa.php");
    exit();
}

$username = $_SESSION['username'];

// Fetch user details from the database
$query = "SELECT full_name, district, municipality, ward_no, email, phone_number, job_type, college_name, level, subject, company_name, post, avatar FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "User not found.";
    exit();
}

// Check for success message
$update_success = '';
if (isset($_SESSION['update_success'])) {
    $update_success = $_SESSION['update_success'];
    unset($_SESSION['update_success']);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <link rel="stylesheet" href="index.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <link rel="stylesheet" href="profile.css" />
</head>
<body onload="toggleJobFields();">
<div class="container">
    <nav>
        <ul>
            <li><a href="dashboard.php" class="logo">
                <img src="../Photo/Black and Orange Simple Book Store Logo.png" alt="Logo">
                <span class="nav-item">BOOKNEST</span>
            </a></li>
            <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i><span class="nav-item">Dashboard</span></a></li>
            <li><a href="profile.php"><i class="fas fa-user"></i><span class="nav-item">Profile</span></a></li>
            <li><a href="order_section.php"><i class="fas fa-box"></i><span class="nav-item">Order</span></a></li>
            <li><a href="buy.php"><i class="fas fa-shopping-cart"></i><span class="nav-item">Buy</span></a></li>
            <li><a href="sell.php"><i class="fas fa-dollar-sign"></i><span class="nav-item">Sell</span></a></li>
            <li><a href="about.php"><i class="fas fa-info-circle"></i><span class="nav-item">About</span></a></li>
            <li><a href="logout.php" class="logout"><i class="fas fa-sign-out-alt"></i><span class="nav-item">Log out</span></a></li>
        </ul>
    </nav>

    <div class="profile-container">
        <?php if ($update_success): ?>
            <div class="update-success">
                <p><?php echo htmlspecialchars($update_success); ?></p>
            </div>
        <?php endif; ?>
        
        <div id="profile-view" class="profile-view">
            <h1 style="text-align: center;">User Profile</h1>
            <div class="profile-avatar">
                <img src="<?php echo !empty($user['avatar']) ? '../uploads/' . htmlspecialchars($user['avatar']) : 'path/to/default-avatar.png'; ?>" alt="User Avatar">
            </div>
            <div class="profile-details">
                <p><strong>Full Name:</strong> <?php echo htmlspecialchars($user['full_name']); ?></p>
                <p><strong>District:</strong> <?php echo htmlspecialchars($user['district']); ?></p>
                <p><strong>Municipality:</strong> <?php echo htmlspecialchars($user['municipality']); ?></p>
            <p><strong>Ward No:</strong> <?php echo htmlspecialchars($user['ward_no']); ?></p>
            <p><strong>Job Type:</strong> <?php echo htmlspecialchars($user['job_type']); ?></p>

                <!-- More details omitted for brevity -->
            </div>
            <div class="profile-actions">
                <button onclick="showEditForm()">Edit Profile</button>
                <button onclick="showDetails()">View Details</button>
            </div>
        </div>

      <!-- CV-like Detail View -->
<div id="details-view" class="details-view" style="display: none;">
    <h1 style="text-align: center;">Personal Details</h1>
    <div class="cv-container">
        <!-- Profile Picture -->
        <div class="profile-avatar">
            <img src="<?php echo !empty($user['avatar']) ? '../uploads/' . htmlspecialchars($user['avatar']) : 'path/to/default-avatar.png'; ?>" alt="User Avatar" style="width:150px; height:150px; border-radius:50%; margin-bottom:20px;">
        </div>

        <!-- Personal Details in CV Format -->
        <div class="cv-details">
            <p><strong>Full Name:</strong> <?php echo htmlspecialchars($user['full_name']); ?></p>
            <p><strong>District:</strong> <?php echo htmlspecialchars($user['district']); ?></p>
            <p><strong>Municipality:</strong> <?php echo htmlspecialchars($user['municipality']); ?></p>
            <p><strong>Ward No:</strong> <?php echo htmlspecialchars($user['ward_no']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($user['phone_number']); ?></p>
            <p><strong>Job Type:</strong> <?php echo htmlspecialchars($user['job_type']); ?></p>

            <!-- Conditionally display educational details if they exist -->
            <?php if (!empty($user['college_name']) && !empty($user['level']) && !empty($user['subject'])): ?>
                <h3>Educational Information</h3>
                <p><strong>College Name:</strong> <?php echo htmlspecialchars($user['college_name']); ?></p>
                <p><strong>Level:</strong> <?php echo htmlspecialchars($user['level']); ?></p>
                <p><strong>Subject:</strong> <?php echo htmlspecialchars($user['subject']); ?></p>
            <?php endif; ?>

            <!-- Conditionally display job details if they exist -->
            <?php if (!empty($user['company_name']) && !empty($user['post'])): ?>
                <h3>Job Information</h3>
                <p><strong>Company Name:</strong> <?php echo htmlspecialchars($user['company_name']); ?></p>
                <p><strong>Post:</strong> <?php echo htmlspecialchars($user['post']); ?></p>
            <?php endif; ?>
        </div>
        
        <!-- Button to close the CV view -->
        <button onclick="closeDetails()" style="margin-top:20px;">Close</button>
    </div>
</div>

        <!-- Edit Form - Hidden by Default -->
        <div id="edit-form" class="edit-form" style="display:none;">
            <h1>Edit Profile</h1>
            <form action="save_profile.php" method="post" enctype="multipart/form-data">

            <div class="profile-avatar">
            <img src="<?php echo !empty($user['avatar']) ? '../uploads/' . htmlspecialchars($user['avatar']) : 'path/to/default-avatar.png'; ?>" alt="User Avatar">
            <label for="avatar-upload">Upload New Avatar:</label>
            <input type="file" name="avatar" id="avatar-upload">
            <input type="hidden" name="existing_avatar" value="<?php echo htmlspecialchars($user['avatar']); ?>">
            </div> 
                <label for="full_name">Full Name:</label>
                <input type="text" name="full_name" id="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>

                <label for="district">District:</label>
                <input type="text" name="district" id="district" value="<?php echo htmlspecialchars($user['district']); ?>" required>

                <label for="municipality">Municipality:</label>
                <input type="text" name="municipality" id="municipality" value="<?php echo htmlspecialchars($user['municipality']); ?>" required>

                <label for="ward_no">Ward No:</label>
                <input type="number" name="ward_no" id="ward_no" value="<?php echo htmlspecialchars($user['ward_no']); ?>" required>

                <label for="email">Email Address:</label>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

                <label for="phone_number">Phone Number:</label>
                <input type="text" name="phone_number" id="phone_number" value="<?php echo htmlspecialchars($user['phone_number']); ?>" required>

                <label for="job_type">Job Type:</label>
                <select name="job_type" id="job_type" onchange="toggleJobFields()" required>
                    <option value="">Select Job Type</option>
                    <option value="Student" <?php echo $user['job_type'] == 'Student' ? 'selected' : ''; ?>>Student</option>
                    <option value="Employed" <?php echo $user['job_type'] == 'Employed' ? 'selected' : ''; ?>>Employed</option>
                </select>

                <div id="student-fields" style="display:none;">
                    <label for="college_name">College Name:</label>
                    <input type="text" name="college_name" id="college_name" value="<?php echo htmlspecialchars($user['college_name']); ?>">

                    <label for="level">Level:</label>
                    <input type="text" name="level" id="level" value="<?php echo htmlspecialchars($user['level']); ?>">

                    <label for="subject">Subject:</label>
                    <input type="text" name="subject" id="subject" value="<?php echo htmlspecialchars($user['subject']); ?>">
                </div>

                <div id="employed-fields" style="display:none;">
                    <label for="company_name">Company Name:</label>
                    <input type="text" name="company_name" id="company_name" value="<?php echo htmlspecialchars($user['company_name']); ?>">

                    <label for="post">Post:</label>
                    <input type="text" name="post" id="post" value="<?php echo htmlspecialchars($user['post']); ?>">
                </div>

                <button type="submit">Save Changes</button>
                <button type="button" onclick="cancelEdit()">Cancel</button>
            </form>
        </div>
    </div>
</div>

<script>
    function showEditForm() {
        document.getElementById('profile-view').style.display = 'none';
        document.getElementById('edit-form').style.display = 'block';
    }

    function cancelEdit() {
        document.getElementById('edit-form').style.display = 'none';
        document.getElementById('profile-view').style.display = 'block';
    }

    function toggleJobFields() {
        var jobType = document.getElementById('job_type').value;
        document.getElementById('student-fields').style.display = (jobType === 'Student') ? 'block' : 'none';
        document.getElementById('employed-fields').style.display = (jobType === 'Employed') ? 'block' : 'none';
    }

    function showDetails() {
        document.getElementById('profile-view').style.display = 'none';
        document.getElementById('details-view').style.display = 'block';
    }

    function closeDetails() {
        document.getElementById('details-view').style.display = 'none';
        document.getElementById('profile-view').style.display = 'block';
    }
</script>
</body>
</html>