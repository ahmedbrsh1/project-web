<?php
include 'connect.php';
header('Content-Type: application/json');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST["username"]);
    $password = $_POST["password"];

    $sql = "SELECT id, password FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $row['id'];

            echo json_encode(['success' => true, 'message' => 'Login successful']);
            exit;
        } else {
            echo json_encode(['success' => false, 'error' => 'Invalid password.']);
            exit;
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'No user found with that username.']);
        exit;
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
    exit;
}
