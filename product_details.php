<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    
    :root {
        --primary: #c41e3a;
        --secondary: #165b33;
        --accent: #f8b229;
        --light: #f4f4f4;
    }
    
    body {
        font-family: 'Arial', sans-serif;
        background-color: var(--light);
    }
    
    nav {
        background-color: var(--primary);
        padding: 1rem;
        position: sticky;
        top: 0;
        z-index: 100;
    }
    
    .nav-container {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .logo {
        color: white;
        font-size: 1.5rem;
        display: flex;
        align-items: center;
    }
    
    .logo svg {
        margin-right: 10px;
    }
    
    .nav-links {
        display: flex;
        gap: 2rem;
    }
    
    .nav-links a {
        color: white;
        text-decoration: none;
        font-weight: bold;
        transition: color 0.3s;
    }
    
    .nav-links a:hover {
        color: var(--accent);
    }

    table {
        margin: 50px auto;
        border-collapse: collapse;
        width: 80%;
        background-color: var(--primary); 
        color: white; 
        text-align: center; /
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
    }

    th, td {
        padding: 10px;
        border: 1px solid white; 
    }

    th {
        background-color: #b0172b;
        font-weight: bold;
        font-size: 16px;
    }

    tr:nth-child(even) {
        background-color: #d32f2f; 
    }
</style>
</head>
<body>
        <nav>
            <div class="nav-container">
                <div class="logo">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="white">
                        <path d="M12 2L9 9H2L7 14L5 22L12 17L19 22L17 14L22 9H15L12 2Z"/>
                    </svg>
                    Christmas Magic
                </div>
                <div class="nav-links">
                    <a href="http://localhost/MyProject/index.html">Home</a>
                    <a href="http://localhost/MyProject/products.html">Products</a>
                    <a href="http://localhost/MyProject/internal.html">Internal Staff</a>
                    <a href="http://localhost/MyProject/cart.html" class="cart-icon">
                        🛒
                        <span class="cart-count">0</span>
                    </a>
                </div>
            </div>
        </nav>

        <?php
if (isset($_POST['product_name'])) {
    $ProductDesc = trim($_POST["product_name"]);

    echo "Product Name = " . htmlspecialchars($ProductDesc) . "<br>";

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

    // Use prepared statement
    $stmt = $conn->prepare("SELECT * FROM Products WHERE ProductDesc LIKE ?");
    $searchTerm = "%" . $ProductDesc . "%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<table border='1'>
        <tr>
            <th>ProductID</th>
            <th>ProductDesc</th>
            <th>ProductPrice</th>
            <th>ProductQuantityOnHand</th>
            <th>ProductPictureName</th>
        </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["ProductID"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["ProductDesc"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["ProductPrice"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["ProductQuantityOnHand"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["ProductPictureName"]) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Product not found.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No product name provided.";
}
?>

</body>
</html>
