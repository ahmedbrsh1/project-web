<?php
include 'connect.php';
header('Content-Type: application/json');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST["username2"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $password = password_hash($_POST["password2"], PASSWORD_DEFAULT); 
    $phone = $conn->real_escape_string($_POST["phone"]);

    try {
        $sql = "INSERT INTO users (username, email, password, phonenumber) 
                VALUES ('$username', '$email', '$password', '$phone')";

        $conn->query($sql);

        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $conn->insert_id;

        echo json_encode(['success' => true, 'message' => 'Registration successful']);
        exit;

    } catch (mysqli_sql_exception $e) {
        if (str_contains($e->getMessage(), "Duplicate entry")) {
            echo json_encode(['success' => false, 'error' => "Username or email already exists."]);
        } else {
            echo json_encode(['success' => false, 'error' => "Registration failed: " . $e->getMessage()]);
        }
        exit;
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
    exit;
}
