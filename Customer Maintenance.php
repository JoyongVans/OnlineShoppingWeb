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
                    <a href="http://localhost/MyProject/products.php">Products</a>
		        <a  href="./internal.html">Internal Staff</a>
                    
                    <a class="cart-icon">
                        🛒
                        
                    </a>
                </div>
            </div>
        </nav>
<h1 style="text-align:center;">Product Maintenance</h1>

<hr>

<?php
   $action   = $_POST["myAction"];
   $custNo   = $_POST["myCustNo"];
   $custName = $_POST["myCustName"];
   $class    = $_POST["myClass"];
   $bonus    = $_POST["myBonus"];
   $email    = $_POST["myEmail"];

   if  ($class == "N")
       $classNum = 1;
   else
       if  ($class == "S")
           $classNum = 2;
       else
           if  ($class == "G")
               $classNum = 3;

   $outCustNo    = $custNo;
   $outCustName  = $custName;
   $outCustClass = $classNum; 
   $outCustBonus = $bonus;
   $outCustEmail = $email;    

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
       // check whether the customer number already existed in the DB or not
  
       $sql =        "SELECT CustomerNo ";
       $sql = $sql . "  from customer ";
       $sql = $sql . " where CustomerNo = " . "'" . $custNo . "'";

       $result  = $conn->query($sql);
       $noOfRow = $result->num_rows;

       if  ($noOfRow > 0)
       {
           $outMessage = "Customer No. already existed. Please try another";
       }
       else
       {
           // insert record
           $sql =        "INSERT into customer ";
           $sql = $sql . "       (CustomerNo, CustomerName, CustomerClass, AccumulatedBonusPoint, CustomerEmail ) ";
           $sql = $sql . "  values";
           $sql = $sql . "       (";
           $sql = $sql .          "'" . $custNo   . "',";
           $sql = $sql .          "'" . $custName . "',";
           $sql = $sql .                $classNum . " ,";
           $sql = $sql .                $bonus    . " ,";
           $sql = $sql .          "'" . $email    . "' ";
           $sql = $sql .        ")"; 

           $result  = $conn->query($sql);

           $outMessage  = "Insert successful";
       }
   }

      if  ($action == "C")
   {
       // check whether the customer number already existed in the DB or not
  
       $sql =        "SELECT CustomerName ";
       $sql = $sql . "  from customer ";
       $sql = $sql . " where CustomerNo = " . "'" . $custNo . "'";

       $result  = $conn->query($sql);
       $noOfRow = $result->num_rows;

       if  ($noOfRow <= 0)
       {
           $outMessage = "Customer No. does not exist. Please try another";
       }
       else
       {
           // change record
           $sql =        "UPDATE  customer ";
           $sql = $sql . "   set CustomerName       = " . "'" . $custName . "' , ";
           $sql = $sql . "       CustomerClass      = " .       $classNum . "  , ";
           $sql = $sql . "       AccumulatedBonusPoint = " .       $bonus    . "  , ";
           $sql = $sql . "       CustomerEmail      = " . "'" . $email    . "'   ";
           $sql = $sql . " where CustomerNo         = " . "'" . $custNo   . "'"   ;

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

    $outClassNormal = "";
    $outClassSilver = "";
    $outClassGold   = "";
    if  ($outCustClass == 1)
        $outClassNormal = "CHECKED";
    if  ($outCustClass == 2)
        $outClassSilver = "CHECKED";
    if  ($outCustClass == 3)
        $outClassGold   = "CHECKED";

?>

<form method="POST" action="http://127.0.0.1/MyProject/Customer Maintenance.php" >
<table border="0">
    <tr>
        <td> Action: <input type="radio" name="myAction" value="A" <?php echo $outAddAction; ?>>Add
        <input type="radio" name="myAction" value="C" <?php echo $outChangeAction; ?>>Change </td>
    </tr>
    <tr>
        <td> Customer No. <input type="text" name="myCustNo" size="20" value="<?php echo $outCustNo; ?>"> </td>
    </tr>
    <tr>
        <td> Customer Name: <input type="text" name="myCustName" size="40" value="<?php echo $outCustName; ?>"> </td>
    </tr>
    <tr>
        <td> Class:  <input type="radio" name="myClass" value="N" <?php echo $outClassNormal; ?>>Normal       
        <input type="radio" name="myClass" value="S" <?php echo $outClassSilver; ?>>Silver       
        <input type="radio" name="myClass" value="G" <?php echo $outClassGold; ?>>Gold </td>
    </tr>
    <tr>
        <td> Accumulated Bonus Point:  <input type="text" name="myBonus" size="20" value="<?php echo $outCustBonus; ?>"> </td>
    </tr>
    <tr>
        <td> Email:  <input type="email" name="myEmail" size="50" value="<?php echo $outCustEmail; ?>"> </td>
    </tr>
    <tr>
        <td> <input type="submit" value="Send">
        <input type="reset" value="Clear"> </td>
    </tr>
</table>
</form>
</body>
</html>
