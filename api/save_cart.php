<?php
session_start();
header('Content-Type: application/json');

// get cart data from the request
$cart = json_decode(file_get_contents('php://input'), true);

// check if the cart data is valid
if ($cart) {
    $_SESSION['cart'] = $cart; // save the cart data to the session
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid cart data']);
}
?>
