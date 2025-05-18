<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<div class="nav-container">
  <link rel="stylesheet" href="navbar.css">
  <nav>
    <img src="/images/logo.png" alt="LogoImg" />
    <ul>
      <li><a href="/">Home</a></li>
      <li><a href="products.php">Products</a></li>
      <?php if (isset($_SESSION['user_id'])): ?>
        <li><a href="account.php">Account</a></li>
      <?php else: ?>
        <li><a href="login.html">Login</a></li>
      <?php endif; ?>
      <li><a href="cart.html" id="cart">Cart</a></li>
    </ul>
  </nav>
</div>