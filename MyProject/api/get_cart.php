
<?php
session_start();
header('Content-Type: application/json');

// initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// get cart data
echo json_encode($_SESSION['cart']);
?>
