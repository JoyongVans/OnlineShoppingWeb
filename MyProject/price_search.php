<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Price Search Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        table {
            margin: 50px auto;
            border-collapse: collapse;
            width: 80%;
            background-color: #c41e3a; 
            color: white; 
            text-align: center; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        th, td {
            padding: 10px;
            border: 1px solid white;
        }
        th {
            background-color: #b0172b;
        }
        tr:nth-child(even) {
            background-color: #d32f2f;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
        }
        .no-results {
            text-align: center;
            font-size: 18px;
            color: #555;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Search Results</h1>
    <?php
    if (isset($_POST['min_price']) && isset($_POST['max_price'])) {
        $minPrice = floatval($_POST['min_price']);
        $maxPrice = floatval($_POST['max_price']);

        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "ChristmasDB";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare SQL query
        $stmt = $conn->prepare("SELECT * FROM Products WHERE ProductPrice BETWEEN ? AND ?");
        $stmt->bind_param("dd", $minPrice, $maxPrice);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Description</th>
                        <th>Price</th>
                        <th>Quantity on Hand</th>
                        <th>Picture</th>
                    </tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['ProductID']) . "</td>";
                echo "<td>" . htmlspecialchars($row['ProductDesc']) . "</td>";
                echo "<td>$" . htmlspecialchars($row['ProductPrice']) . "</td>";
                echo "<td>" . htmlspecialchars($row['ProductQuantityOnHand']) . "</td>";
                echo "<td><img src='./assets/images/" . htmlspecialchars($row['ProductPictureName']) . "' alt='" . htmlspecialchars($row['ProductDesc']) . "' width='50'></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<div class='no-results'>No products found within the specified price range.</div>";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "<div class='no-results'>Please provide a valid price range.</div>";
    }
    ?>
</body>
</html>
