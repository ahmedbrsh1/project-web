<?php
session_start();
require 'connect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit();
}

$user_id = intval($_SESSION['user_id']);

$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if (!$user) {
    header('Location: logout.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Account</title>
  <link rel="stylesheet" href="styles2.css" />
</head>
<body>
  <?php include 'navbar.php'; ?>

  <div class="account-layout">
    <aside class="sidebar">
      <ul>
        <li><a href="account.php">Account</a></li>
        <li><a href="previous_orders.php">Previous Orders</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </aside>

    <main class="account-info">
      <h2>My Account</h2>
      <form action="update_account.php" method="POST">
        <label>Username:
          <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required />
        </label>
        <label>Email:
          <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required />
        </label>
        <label>Phone Number:
          <input type="tel" name="phonenumber" value="<?= htmlspecialchars($user['phonenumber']) ?>" />
        </label>
        <!-- Do NOT show password here. Password update should be separate for security -->

        <button type="submit">Save Changes</button>
      </form>
<?php if (isset($_GET['update'])): ?>
  <?php if ($_GET['update'] == 'success'): ?>
    <p style="color: green;">Account updated successfully!</p>
  <?php elseif ($_GET['update'] == 'duplicate'): ?>
    <p style="color: red;">Username or Email already exists!</p>
  <?php endif; ?>
<?php endif; ?>


    </main>
  </div>
</body>
</html>
