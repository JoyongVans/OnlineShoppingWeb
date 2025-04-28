<?php
require '../db_config.php';

//show errors   
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Parsing JSON data
$data = json_decode(file_get_contents('php://input'), true);

// test if the data is empty
if (empty($data['email']) || empty($data['cart'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid or missing input data']);
    exit;
}

$email = $data['email'];
$cart = $data['cart'];

if (!is_array($cart) || empty($cart)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid cart data']);
    exit;
}


try {
    // begin a transaction
    $pdo->beginTransaction();

    // enquire the customer information
    $stmt = $pdo->prepare("SELECT CustomerNo, CustomerClass FROM Customer WHERE CustomerEmail = ?");
    $stmt->execute([$email]);
    $customer = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$customer) {
        http_response_code(400);
        echo json_encode(['error' => 'Customer not found']);
        $pdo->rollBack();
        exit;
    }

    $customerNo = $customer['CustomerNo'];
    $customerClass = $customer['CustomerClass'];

    // define discount
    $discountMap = [1 => 0, 2 => 0.04, 3 => 0.065];
    $discount = $discountMap[$customerClass] ?? 0;

    $totalNetAmount = 0;

    // go through each item in the cart
    foreach ($cart as $item) {
        if (!isset($item['product_id'], $item['price'], $item['quantity']) || empty($item['product_id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid cart item']);
            $pdo->rollBack();
            exit;
        }

        $productId = $item['product_id'];
        $price = $item['price'];
        $quantity = $item['quantity'];

        if ($price <= 0 || $quantity <= 0) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid price or quantity in cart']);
            $pdo->rollBack();
            exit;
        }

        // check if the product exists and has enough stock
        $stmt = $pdo->prepare("SELECT ProductQuantityOnHand FROM Products WHERE ProductID = ?");
        $stmt->execute([$productId]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product || $product['ProductQuantityOnHand'] < $quantity) {
            http_response_code(400); 
            echo json_encode(['error' => "Insufficient stock for product ID: $productId"]);
            $pdo->rollBack(); 
            exit; // end the script
        }
        

        // update stock
        $stmt = $pdo->prepare("UPDATE Products SET ProductQuantityOnHand = ProductQuantityOnHand - ? WHERE ProductID = ?");
        $stmt->execute([$quantity, $productId]);

        $originalAmount = $price * $quantity;
        $netAmount = $originalAmount * (1 - $discount);
        $totalNetAmount += $netAmount;

        // insert order
        $stmt = $pdo->prepare("INSERT INTO `Order` 
            (OrderDate, CustomerID, ProductID, Price, Quantity, OriginalAmount, DiscountPercentage, NetAmount)
            VALUES (CURDATE(), ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $customerNo,
            $productId,
            $price,
            $quantity,
            $originalAmount,
            $discount * 100,
            $netAmount
        ]);
    }

    // update customer bonus points
    $stmt = $pdo->prepare("UPDATE Customer SET AccumulatedBonusPoint = AccumulatedBonusPoint + ? WHERE CustomerNo = ?");
    $stmt->execute([$totalNetAmount, $customerNo]);

    // commit the transaction
    $pdo->commit();

    echo json_encode(['message' => 'Order confirmed!']);
} catch (Exception $e) {
    $pdo->rollBack();
    http_response_code(500);
    echo json_encode([
        'error' => 'Failed to process order',
        'message' => $e->getMessage()
    ]);
}

?>
