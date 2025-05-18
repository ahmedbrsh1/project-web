<?php
include 'connect.php'; 

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Products</title>
    <link rel="stylesheet" href="products.css" />
  </head>
  <body>

    <?php include 'navbar.php'; ?>
    
    <h1>Our <span class="red">Products</span></h1>
    <div class="products">
      <?php
      $sql = "SELECT * FROM products";
      $result = $conn->query($sql);

      if ($result && $result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $id = (int)$row['id'];
              $name = htmlspecialchars($row['name']);
              $price = number_format($row['price'], 2);
              $image = htmlspecialchars($row['image']);
              echo '<div class="product">';
              echo '<a href="product.php?id=' . $id . '">';
              echo '<img src="' . $image . '" alt="' . $name . '" />';
              echo '</a>';
              echo '<h3>' . $name . '</h3>';
              echo '<p class="price">$' . $price . '</p>';
              echo '</div>';
          }
      } else {
          echo '<p>No products found.</p>';
      }
      ?>
    </div>
  </body>
</html>