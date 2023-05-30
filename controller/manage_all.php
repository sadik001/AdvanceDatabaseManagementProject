<?php require '../views/include_require/user_admin_dashboard_header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
   <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../views/css/homepage1.css">
    <style scoped>
        @import "../views/css/bootstrap-5.0.1-iso.css";
    </style>
    <style type="text/css">
        .error {
            color: red;
        }

    </style>
    <style>

.animate1st-charcter
{
   text-transform: default;
  background-image: linear-gradient(
    -225deg,
    #231557 0%,
    #44107a 29%,
    #ff1361 67%,
    #fff800 100%
  );
  background-size: auto auto;
  background-clip: border-box;
  background-size: 200% auto;
  color: #fff;
  background-clip: text;
  text-fill-color: transparent;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  animation: textclip_backward 2s linear infinite;
  display: inline-block;
      font-size: 100px;
}

@keyframes textclip_backward {
  to {
    background-position: 200% center;
  }
}
.animate2nd-charcter
{
   text-transform: default;
  background-image: linear-gradient(
    -225deg,
    #231557 0%,
    #44107a 29%,
    #ff1361 67%,
    #fff800 100%
  );
  background-size: auto auto;
  background-clip: border-box;
  background-size: 200% auto;
  color: #fff;
  background-clip: text;
  text-fill-color: transparent;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  animation: textclip_forward 2s linear infinite;
  display: inline-block;
      font-size: 75px;
}

@keyframes textclip_forward {
  from {
    background-position: 200% center;
  }
}
body{
background-color: #00FF66; /* For browsers that do not support gradients */
background-image: linear-gradient(to right, #00FF66 , #00FFFF);
}
.img
{
justify-content: flex-end;
align-items: center;
background-color: #00FF66; /* For browsers that do not support gradients */
background-image: linear-gradient(to right, #00FF66 , #00FFFF);
padding: 0 46.8%; 
}
</style>
   
</head>

<body>
    
 <div class="bootstrap-iso">   

    <?php
    /*include 'username_logout_navbar.php';*/
    ?>
    

    <?php  $adminname = $_SESSION['adminname'] ?> 

<br><br>

    <div class ="img">
        <img src="../views/css/razer_gif.gif" alt="Razer Team Logo" align="center" width="125" height="125">
        </div>
   <div class="container">
  <div class="row">
    <div class="col-md-12 text-center">
      <a class="animate1st-charcter"> Views </a><br><br><br>
    </div>
<p>Views For COD payment<p>
     <?php
        $conn = oci_connect('pritom', 'tree', '//localhost/XE');   
        if (!$conn) {
          echo 'Failed to connect to oracle' . "<br>";
        }

        $stid = oci_parse($conn, 'SELECT * FROM COD_payment');
        oci_execute($stid);
        echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Order ID</th>
            <th>Item Name</th>
            <th>Price</th>
            <th>Quantity</th>
                    
        </tr>";
        while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
        echo "<tr>";
        echo "<td>" . $row['ID'] . "</td>";
        echo "<td>" . $row['NAME']->load() . "</td>";
        echo "<td>" . $row['PHONE'] . "</td>";
        echo "<td>" . $row['ORDER_ID'] . "</td>";
        echo "<td>" . $row['ITEM_NAME'] . "</td>";
        echo "<td>" . $row['PRICE'] . "</td>";
        echo "<td>" . $row['QUANTITY'] . "</td>";
        echo "</tr>";
        }
        echo "</table>\n";
        
     ?>
     <br>
      <br> 
      <br>

     <p>List of orders by Users<p>
     <?php
        $conn = oci_connect('pritom', 'tree', '//localhost/XE');   
        if (!$conn) {
          echo 'Failed to connect to oracle' . "<br>";
        }

        $stid = oci_parse($conn, 'SELECT * FROM order_by_user');
        oci_execute($stid);
       echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Order ID</th>
            <th>Item Name</th>
            <th>Price</th>
            <th>Quantity</th>
                    
        </tr>";
        while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
        echo "<tr>";
        echo "<td>" . $row['ID'] . "</td>";
        echo "<td>" . $row['NAME']->load() . "</td>";
        echo "<td>" . $row['PHONE'] . "</td>";
        echo "<td>" . $row['ORDER_ID'] . "</td>";
        echo "<td>" . $row['ITEM_NAME'] . "</td>";
        echo "<td>" . $row['PRICE'] . "</td>";
        echo "<td>" . $row['QUANTITY'] . "</td>";
        echo "</tr>";
        }
        echo "</table>\n";
     ?>

     <br>
      <br> 
      <br>

     

     
    </div>

  </div>

</div>
</div>
  </div>
<div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></div>
<?php require 'include_require/footer.php'; ?>  
</body>
</html>
