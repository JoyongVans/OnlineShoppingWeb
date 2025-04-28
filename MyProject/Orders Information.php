<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Christmas Magic Decorations - Customer Maintenance</title>
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


    	<style type="text/css">
        body {
            font-family: "Times New Roman", Times, serif;
            background-color: #2e4524;
            margin: 60px;
            padding: 0;
            text-align: center;
        }

        h1 {
            color: #2e4524;
	    font-family: "Times New Roman", Times, serif;
        }

        table {
            margin: 20px auto;
            font-size: 16px;
            background-color: #fcfcf2;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
	        width: 80%;
	        font-family: "Times New Roman", Times, serif;
        }

        table td {
            text-align: center;
        }

        input[type="submit"], input[type="date"] 
	{
            padding: 5px;
            margin: 5px;
            border-radius: 5px;
            border: 1px solid #8a2c0a;
        }
            input[type="radio"]:checked {
            background-color: #8a2c0a; /* Change the color to red when selected */
        }

        input[type="submit"]{
            background-color: #8a2c0a;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover{
            background-color: #8a2c0a;
        }

        hr {
            border-top: 2px solid #2e4524;
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
		        <a  href="./internal.html">Internal Staff</a>
                    <a href="http://localhost/MyProject/login.html">Login</a>
                    <a href="http://localhost/MyProject/cart.html" class="cart-icon">
                        🛒
                        <span class="cart-count">0</span>
                    </a>
                </div>
            </div>
        </nav>
<h1 style="text-align:center;">Product Maintenance</h1>

<hr>

<?php
   $fromDate      = $_POST["myFrom"];
   $toDate        = $_POST["myTo"];

   $servername = "127.0.0.1";
   $username   = "root";
   $password   = "";
   $dbname     = "christmasdb";

   // Create connection
   $conn = new mysqli($servername, $username, $password, $dbname);

   // Check connection
   if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
   }
  
         $sql =        "SELECT OrderNo,  OrderDate   , CustomerID  , ProductID, Price, ";
         $sql = $sql . "       Quantity, OriginalAmount, DiscountPercentage, NetAmount";
         $sql = $sql . " from   `order` ";
         $sql = $sql . " where OrderDate >= " . "'" . $fromDate . "' AND ";
         $sql = $sql . "       OrderDate <= " . "'" . $toDate   . "'";

       $result  = $conn->query($sql);
       $noOfRow = $result->num_rows;

    echo '<table border="0">';
    echo "<tr>";
    echo "<th>Order No</th>";
    echo "<th>Order Date</th>";
    echo "<th>Customer No</th>";
    echo "<th>Product ID</th>";
    echo "<th>Product Price</th>";
    echo "<th>Quantity</th>";
    echo "<th>Original Amount</th>";
    echo "<th>Discount</th>";
    echo "<th>Net Amount</th>";
    echo "</tr>";

   $k = 0;
   while ($k < $noOfRow)
   {
      $row = $result->fetch_assoc();

      echo "<TR>";
      echo    "<TD>";
      echo       $row["OrderNo"];
      echo    "</TD>";
      echo    "<TD>";
      echo       $row["OrderDate"];
      echo    "</TD>";
      echo    "<TD>";
      echo       $row["CustomerID"];
      echo    "</TD>";
      echo    "<TD>";
      echo       $row["ProductID"];
      echo    "</TD>";
      echo    "<TD>";
      echo       $row["Price"];
      echo    "</TD>";
      echo    "<TD>";
      echo       $row["Quantity"];
      echo    "</TD>";
      echo    "<TD>";
      echo       $row["OriginalAmount"];
      echo    "</TD>";
      echo    "<TD>";
      echo       $row["DiscountPercentage"];
      echo    "</TD>";
      echo    "<TD>";
      echo       $row["NetAmount"];
      echo    "</TD>";
      echo "</TR>";
      
      $k = $k + 1;
   }

   echo "</Table>";
?>

<form method="POST" action="http://127.0.0.1/MyProject/Orders Information.php" >
<table border="0">
    <tr>
	<td> From date: <input type="date" name="myFrom" />  </td>
	<td>  To date :  <input type="date" name="myTo"   /> </td>
    </tr>
    <tr>
        <td> <input type="submit" value="Search"></input> </td>
    </tr>
</table>

</form>
</body>
</html>