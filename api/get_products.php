<?php
header('Content-Type: application/json; charset=utf-8');


$conn = new mysqli("127.0.0.1", "root", "", "christmasdb");
if ($conn->connect_error) {
    echo json_encode(["error" => "DB connection failed"]);
    exit;
}


$sql = "SELECT ProductID, ProductDesc, ProductPrice, ProductPictureName
        FROM products";
$result = $conn->query($sql);

$products = [];
while($row = $result->fetch_assoc()) {
    // Hardcoded category for now
    $cat = 'tree';

    // Construct the JSON required by the front end
    // key = ProductID, value = { name, price, image, category }
    $products[$row['ProductID']] = [
        "name"     => $row['ProductDesc'],
        "price"    => floatval($row['ProductPrice']),
        "image"    => "./assets/images/".$row['ProductPictureName'],
        "category" => $cat   
    ];
}
$conn->close();

echo json_encode($products);
