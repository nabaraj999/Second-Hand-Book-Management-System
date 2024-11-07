<?php
session_start();
include('../connection/connection.php');

if (!isset($_SESSION['username'])) {
    header("Location: signupa.php");
    exit();
}

$username = $_SESSION['username'];

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $existing_avatar = isset($_POST['existing_avatar']) ? $_POST['existing_avatar'] : '';

    // Initialize variables for new profile data
    $full_name = isset($_POST['full_name']) ? mysqli_real_escape_string($conn, $_POST['full_name']) : '';
    $district = isset($_POST['district']) ? mysqli_real_escape_string($conn, $_POST['district']) : '';
    $municipality = isset($_POST['municipality']) ? mysqli_real_escape_string($conn, $_POST['municipality']) : '';
    $ward_no = isset($_POST['ward_no']) ? (int)$_POST['ward_no'] : 0;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
    $phone_number = isset($_POST['phone_number']) ? mysqli_real_escape_string($conn, $_POST['phone_number']) : '';
    $job_type = isset($_POST['job_type']) ? mysqli_real_escape_string($conn, $_POST['job_type']) : '';

    // Job-specific fields
    $college_name = isset($_POST['college_name']) ? mysqli_real_escape_string($conn, $_POST['college_name']) : '';
    $level = isset($_POST['level']) ? mysqli_real_escape_string($conn, $_POST['level']) : '';
    $subject = isset($_POST['subject']) ? mysqli_real_escape_string($conn, $_POST['subject']) : '';
    $company_name = isset($_POST['company_name']) ? mysqli_real_escape_string($conn, $_POST['company_name']) : '';
    $post = isset($_POST['post']) ? mysqli_real_escape_string($conn, $_POST['post']) : '';

    // Handle file upload
    $avatar = $existing_avatar;
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../uploads/';
        $avatar_file = $_FILES['avatar']['name'];
        $target_file = $upload_dir . basename($avatar_file);
        $upload_ok = 1;
        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES['avatar']['tmp_name']);
        if ($check === false) {
            echo "File is not an image.";
            $upload_ok = 0;
        }

        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $upload_ok = 0;
        }

        if ($_FILES['avatar']['size'] > 500000) {
            echo "Sorry, your file is too large.";
            $upload_ok = 0;
        }

        if (!in_array($image_file_type, ["jpg", "png", "jpeg", "gif"])) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $upload_ok = 0;
        }

        if ($upload_ok && move_uploaded_file($_FILES['avatar']['tmp_name'], $target_file)) {
            $avatar = $target_file;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Update user details in the database
    $query = "UPDATE users SET 
              full_name='$full_name',
              district='$district',
              municipality='$municipality',
              ward_no='$ward_no',
              email='$email',
              phone_number='$phone_number',
              job_type='$job_type',
              college_name='$college_name',
              level='$level',
              subject='$subject',
              company_name='$company_name',
              post='$post',
              avatar='$avatar'
              WHERE username='$username'";

    if (mysqli_query($conn, $query)) {
        $_SESSION['update_success'] = "Profile updated successfully!";
        $_SESSION['avatar'] = $avatar; // Update session with the new avatar path
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
    }

    header("Location: profile.php");
    exit();
}
?>
