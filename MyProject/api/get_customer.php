<?php
require '../db_config.php'; // make the database connection
header('Content-Type: application/json');

// test if the email parameter is missing
if (!isset($_GET['email'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Email parameter is missing']);
    exit;
}

$email = $_GET['email'];

try {
    // log the email
    error_log("Fetching customer data for email: $email");

    // query the database for the customer
    $stmt = $pdo->prepare("SELECT CustomerClass FROM Customer WHERE CustomerEmail = ?");
    $stmt->execute([$email]);
    $customer = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($customer) {
        echo json_encode($customer);
    } else {
        http_response_code(404); 
        echo json_encode(['error' => 'Customer not found']);
    }
} catch (Exception $e) {
    error_log("Database error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Database error']);
}
?>
