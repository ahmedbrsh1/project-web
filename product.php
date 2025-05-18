<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    
    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, name, price, image FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "<h2>Product not available.</h2>";
        exit();
    }
} else {
    echo "<h2>Product not specified.</h2>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($product['name']); ?></title>
    <link rel="stylesheet" href="product_details.css">
    <style>
        .product-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            font-family: Arial, sans-serif;
        }
        .product-image {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .product-id {
            color: #666;
            font-size: 0.9em;
        }
        .product-price {
            font-size: 1.5em;
            color: #e63946;
            margin: 15px 0;
        }
        .button-container {
            margin-top: 30px;
        }
        button {
            padding: 10px 20px;
            margin-right: 10px;
            background-color: #e91e63;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="product-container">
        <!-- Product Image -->
        <?php if(!empty($product['image'])): ?>
            <img class="product-image" src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
        <?php else: ?>
            <div class="no-image">No image available</div>
        <?php endif; ?>
        
        
        
        <!-- Product Name -->
        <h1><?php echo htmlspecialchars($product['name']); ?></h1>
        
        <!-- Product Price -->
        <p class="product-price"><strong>Price:</strong> $<?php echo htmlspecialchars($product['price']); ?></p>

        <div class="button-container">
            <button id="addToCartBtn">Add to Cart</button>
            <label for="quantity">Quantity:</label>
          <input type="number" id="quantity" min="1" value="1" />
            
        </div>
    </div>
           

    <script>
    const productId = <?php echo json_encode($product['id']); ?>;

    function addToCart() {
        const quantity = document.getElementById("quantity").value;
        const oldCart = localStorage.getItem("cart")
            ? JSON.parse(localStorage.getItem("cart"))
            : [];
        const existsIndex = oldCart.findIndex(
            (cartItem) => cartItem.id === productId
        );
        if (existsIndex !== -1) {
            oldCart[existsIndex].quantity =
                +oldCart[existsIndex].quantity + +quantity;
            localStorage.setItem("cart", JSON.stringify(oldCart));
        } else {
            localStorage.setItem(
                "cart",
                JSON.stringify([...oldCart, { id: productId, quantity: quantity }])
            );
        }
    }

    const addToCartBtn = document.getElementById("addToCartBtn");
    addToCartBtn.addEventListener("click", () => addToCart());
</script>
</body>
</html>