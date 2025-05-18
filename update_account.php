<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.html");
  exit();
}
require 'connect.php';

$user_id = $_SESSION['user_id'];
$new_username = $_POST['username'];
$new_email = $_POST['email'];
$new_phone = $_POST['phonenumber'];

// Check if email or username is already used by another user
$check_sql = "SELECT id FROM users WHERE (email = ? OR username = ?) AND id != ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("ssi", $new_email, $new_username, $user_id);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows > 0) {
  // Redirect back with error
  header("Location: account.php?update=duplicate");
  exit();
}

// If no duplicates, proceed with update
$sql = "UPDATE users SET username=?, email=?, phonenumber=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $new_username, $new_email, $new_phone, $user_id);
$stmt->execute();

// Redirect with success
header("Location: account.php?update=success");
exit();
?>
