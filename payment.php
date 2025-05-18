<?php
session_start();

// Database connection
$host = 'localhost';
$dbname = 'efashion';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("<p style='color:red;'>Database connection failed: " . $e->getMessage() . "</p>");
}

// Simulated logged-in user
$user_id = 1;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pay_now'])) {
    // Get and sanitize form inputs
    $fullname = trim($_POST['fullName'] ?? '');
    $streetAddress = trim($_POST['streetAddress'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $postalCode = trim($_POST['postalCode'] ?? '');
    $cardNumber = trim($_POST['cardNumber'] ?? '');
    $expiryDate = trim($_POST['expiryDate'] ?? '');
    $cvv = trim($_POST['cvv'] ?? '');
    $cartJson = $_POST['cart'] ?? '[]';

    // Decode cart
    $cart = json_decode($cartJson, true);

    // Validate fields
    $errors = [];
    if (!$fullname) $errors[] = "Full name is required.";
    if (!$streetAddress) $errors[] = "Street address is required.";
    if (!$city) $errors[] = "City is required.";
    if (!$postalCode) $errors[] = "Postal code is required.";
    if (!$cardNumber || !preg_match('/^\d{13,19}$/', $cardNumber)) $errors[] = "Valid card number is required.";
    if (!$expiryDate || !preg_match('/^(0[1-9]|1[0-2])\/\d{2}$/', $expiryDate)) $errors[] = "Valid expiry date is required.";
    if (!$cvv || !preg_match('/^\d{3,4}$/', $cvv)) $errors[] = "Valid CVV is required.";
    if (!is_array($cart) || count($cart) === 0) $errors[] = "Cart is empty or invalid.";

    // Show validation errors
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
        exit;
    }

    try {
        // Start transaction
        $pdo->beginTransaction();

        // Insert into orders table
        $stmt = $pdo->prepare("INSERT INTO orders (user_id, fullname, street_address, city, postal_code, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->execute([$user_id, $fullname, $streetAddress, $city, $postalCode]);
        $order_id = $pdo->lastInsertId();

        // Insert each product into order_items table
        $stmtItem = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, ?)");
        foreach ($cart as $item) {
            $productId = (int)$item['id'];
            $quantity = (int)$item['quantity'];
            $stmtItem->execute([$order_id, $productId, $quantity]);
        }

        // Commit transaction
        $pdo->commit();

        // Fake processing card (in real world don't store card info!)
        echo "<p style='color:green; font-weight:bold;'>✅ Order placed successfully! Your order ID is <strong>$order_id</strong>.</p>";

    } catch (Exception $e) {
        $pdo->rollBack();
        echo "<p style='color:red;'>❌ Error placing order: " . $e->getMessage() . "</p>";
    }
}
?>