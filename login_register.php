<?php
include 'connect.php'; // Connect to the database

session_start(); // ✅ Starts/resumes the session

// Handle Register Form Submission
if (isset($_POST['register'])) {
    $username = $conn->real_escape_string($_POST["username2"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $password = password_hash($_POST["password2"], PASSWORD_DEFAULT); 
    $phone = $conn->real_escape_string($_POST["phone"]);

    $sql = "INSERT INTO users (username, email, password, phonenumber) 
            VALUES ('$username', '$email', '$password', '$phone')";

    if ($conn->query($sql) === TRUE) {
        // After successful registration, create a session and redirect to index.php
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $conn->insert_id; // Store the user ID from the database
        
        // Redirect to index.php after successful registration
        header("Location: index.php");
        exit; // Don't forget to call exit after header redirection
    } else {
        echo "Error: " . $conn->error;
    }
}

// Handle Login Form Submission
if (isset($_POST['login'])) {
    $username = $conn->real_escape_string($_POST["username"]);
    $password = $_POST["password"];

    $sql = "SELECT id, password FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // After successful login, create a session and redirect to index.php
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $row['id'];

            // Redirect to index.php after successful login
            header("Location: index.php");
            exit; // Don't forget to call exit after header redirection
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that username.";
    }
}
?>
