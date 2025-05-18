<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.html");
  exit();
}
require 'connect.php';
$user_id = $_SESSION['user_id'];

$sql = "SELECT products.name, products.price, products.image, order_items.quantity
        FROM orders
        JOIN order_items ON orders.id = order_items.order_id
        JOIN products ON order_items.product_id = products.id
        WHERE orders.user_id = ?";
        
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Previous Orders</title>
  <style>
    table { width: 90%; margin: 20px auto; border-collapse: collapse; }
    th, td { border: 1px solid gray; padding: 12px; text-align: center; }
    img { width: 60px; height: auto; }
  </style>
    <link rel="stylesheet" href="styles2.css">
</head>
<body>
      <?php include 'navbar.php'; ?>

  <div class="account-layout">
    <div class="sidebar">
      <ul>
        <li><a href="account.php">Account</a></li>
        <li><a href="previous_orders.php">Previous Orders</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </div>
    <div class="content">
      <h1>Previous Orders</h1>
      <table>
        <thead>
          <tr><th>Image</th><th>Name</th><th>Price</th><th>Quantity</th><th>Total</th></tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><img src="<?= $row['image'] ?>" alt="product image"></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td>$<?= $row['price'] ?></td>
            <td><?= $row['quantity'] ?></td>
            <td>$<?= number_format($row['price'] * $row['quantity'], 2) ?></td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
