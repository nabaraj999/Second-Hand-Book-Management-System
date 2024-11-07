<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: signupa.php");
    exit();
}

// Assume you have a database connection
include('connection.php');

// Fetch user details from the database
$username = $_SESSION['username'];
$query = "SELECT full_name, email, username, avatar FROM users WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $upload_dir = 'uploads/';
    $avatar = $_FILES['avatar']['name'];
    $target_file = $upload_dir . basename($avatar);
    $upload_ok = 1;
    $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES['avatar']['tmp_name']);
    if ($check !== false) {
        $upload_ok = 1;
    } else {
        echo "File is not an image.";
        $upload_ok = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $upload_ok = 0;
    }

    // Check file size
    if ($_FILES['avatar']['size'] > 500000) { // 500KB max
        echo "Sorry, your file is too large.";
        $upload_ok = 0;
    }

    // Allow certain file formats
    if ($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg" && $image_file_type != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $upload_ok = 0;
    }

    // Check if $upload_ok is set to 0 by an error
    if ($upload_ok == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $target_file)) {
            // Update user's avatar in the database
            $query = "UPDATE users SET avatar=? WHERE username=?";
            $stmt = $conn->prepare($query);
            $avatar = basename($avatar); // Store only the filename
            $stmt->bind_param("ss", $avatar, $username);
            if ($stmt->execute()) {
                echo "The file " . htmlspecialchars($avatar) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error updating your profile.";
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <div class="profile-container">
        <h1>Edit Profile</h1>
        <form action="edit_profile.php" method="post" enctype="multipart/form-data">
            <div class="profile-avatar">
                <img src="<?php echo htmlspecialchars($user['avatar']); ?>" alt="User Avatar" style="max-width: 150px;">
            </div>
            <div class="form-group">
                <label for="avatar">Upload New Avatar:</label>
                <input type="file" name="avatar" id="avatar">
            </div>
            <div class="profile-actions">
                <button type="submit">Save Changes</button>
            </div>
        </form>
    </div>
</body>
</html>
