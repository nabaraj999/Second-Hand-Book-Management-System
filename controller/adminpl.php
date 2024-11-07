<?php
session_start();
// require_once 'loginconection.php';
include '../connection/adminconnection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"]; //id name from the form.
    $password = $_POST["password"];

    //simple SQL query to check if the username and password matches.
    $sql = "SELECT * FROM AdminPanel WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0){
        //user exists and password matches.
        $_SESSION['username'] = $username;
        header('location: ../View/adminpanelindex.php');
        exit(); //exit the script after successful login.
       
    }else{
        //Invalid username or password.
        echo "Invalid username or password.";
    }
    
}
    $conn->close();
?>