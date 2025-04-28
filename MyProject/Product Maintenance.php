<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Christmas Magic Decorations - Product Maintenance</title>
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
	        font-family: "Times New Roman", Times, serif;
        }

        table td {
            text-align: left;
        }

        input[type="radio"], input[type="email"], input[type="text"], input[type="submit"],     input[type="reset"] {
            padding: 5px;
            margin: 5px;
            border-radius: 5px;
            border: 1px solid #8a2c0a;
        }
            input[type="radio"]:checked {
            background-color: #8a2c0a; /* Change the color to red when selected */
        }

        input[type="submit"], input[type="reset"] {
            background-color: #8a2c0a;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover, input[type="reset"]:hover {
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
   $action   = $_POST["myAction"];
   $prodID   = $_POST["myProdID"];
   $prodDesc = $_POST["myProdDesc"];
   $price    = $_POST["myPrice"];
   $quantity    = $_POST["myQuantity"];
   $picture    = $_POST["myPicture"];

   $outProdID    = $prodID;
   $outProdDesc  = $prodDesc;
   $outPrice = $price; 
   $outQuantity = $quantity;
   $outPicture = $picture;   

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

      if  ($action == "A")
   {
  
       $sql =        "SELECT ProductID ";
       $sql = $sql . "  from products ";
       $sql = $sql . " where ProductID = " . "'" . $prodID . "'";

       $result  = $conn->query($sql);
       $noOfRow = $result->num_rows;

       if  ($noOfRow > 0)
       {
           $outMessage = "Product ID. already existed. Please try another";
       }
       else
       {
           // insert record
           $sql =        "INSERT into products ";
           $sql = $sql . "       (ProductID, ProductDesc, ProductPrice, ProductQuantityOnHand, ProductPictureName ) ";
           $sql = $sql . "  values";
           $sql = $sql . "       (";
           $sql = $sql .          "'" . $prodID   . "',";
           $sql = $sql .          "'" . $prodDesc . "',";
           $sql = $sql .                $price . " ,";
           $sql = $sql .                $quantity    . " ,";
           $sql = $sql .          "'" . $picture    . "' ";
           $sql = $sql .        ")"; 

           $result  = $conn->query($sql);

           $outMessage  = "Insert successful";
       }
   }

      if  ($action == "C")
   {
  
       $sql =        "SELECT ProductID ";
       $sql = $sql . "  from products ";
       $sql = $sql . " where ProductID = " . "'" . $prodID . "'";

       $result  = $conn->query($sql);
       $noOfRow = $result->num_rows;

       if  ($noOfRow <= 0)
       {
           $outMessage = "Product ID. does not exist. Please try another";
       }
       else
       {
           // change record
           $sql =        "UPDATE products ";
           $sql = $sql . "   set ProductDesc       = " . "'" . $prodDesc . "' , ";
           $sql = $sql . "       ProductPrice      = " .       $price . "  , ";
           $sql = $sql . "       ProductQuantityOnHand = " .       $quantity    . "  , ";
           $sql = $sql . "       ProductPictureName      = " . "'" . $picture    . "'   ";
           $sql = $sql . " where ProductID         = " . "'" . $prodID   . "'"   ;

           $result  = $conn->query($sql);

           $outMessage  = "Change successful";
       }
   }
?>

<script type="text/javascript">
   function outMessage() {
           alert("<?php echo $outMessage; ?>");
      }
   window.onload = outMessage;
</script>

<?php
    $outAddAction     = "";
    $outChangeAction  = "";
    $outEnquiryAction = "";
    
    if  ($action == "A")
    {
        $outAddAction = "CHECKED";
    }
    if  ($action == "C")
    {
        $outChangeAction = "CHECKED";
    }

?>

<form method="POST" action="http://127.0.0.1/MyProject/Product Maintenance.php" >
<table border="0">
    <tr>
	<td> Action: <input type="radio" name="myAction" value="A" <?php echo $outAddAction;     ?> />Add
        <input type="radio" name="myAction" value="C" <?php echo $outChangeAction;  ?> />Change </td>
        </tr>
    <tr>
	<td> Product ID. <input type="text" name="myProdID"   size="20" value="<?php echo $outProdID; ?>"> </td>
        </tr>
        <tr>
	<td>Product Desc: <input type="text" name="myProdDesc" size="60" value="<?php echo $outProdDesc; ?>"> </td>
        </tr>
    <tr>
	<td> Price:  <input type="number" name="myPrice" min="0" step=".1" value="<?php echo $outPrice; ?>"> </td>
    </tr>
    <tr>
	<td> Quantity On Hand:  <input type="number" name="myQuantity" size="20" value="<?php echo $outQuantity; ?>"> </td>
    </tr>
    <tr>
	<td> Product Picture:  <input type="text" name="myPicture" size="50" value="<?php echo $outPicture; ?>"> </td>
    </tr>
    <tr>
        <td> <input type="submit" value="Send"></input>
        <input type="reset" value="Clear"></input> </td>
    </tr>
</table>
</form>
</body>
</html>
