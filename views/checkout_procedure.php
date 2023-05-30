<?php 
require '../views/include_require/user_dashboard_header.php';
/*$Total = $_SESSION['grand_total'];*/
  /*session_start();*/
  if(count($_SESSION) === 0){

    header("Location: ../controller/Logout.php");
    header("Location: ../views/Login.php");

  }
  if($_SESSION['username'] === ""){

    echo"<script>
        alert('For checkout please Login First');
        window.location.href='../views/Login.php';
         </script>"; 
   
  }
  
?>
<?php

$message = '';

$nameErr = $emailErr = $genderErr = $dobErr = $phoneErr = $preaddErr = $relErr = "";
$name = $email = $gender = $dob = $phone = $religion = "";
$preadd = '';
$usernameErr = $passErr = $conpassErr = "";
$usernameError = $emailError = "";
$username = $pass = $conpass = "";


if (isset($_POST["checkout"])) 
{     
    $_SESSION['checkout'] = "notloggedin";
    if (empty($_POST["pay_method"])) 
          {
              $payErr = "Selection of a payment method is required";
              echo"<script>
                     alert('Please select a Payment Method');
                     window.location.href='../views/mycart.php';
                     </script>"; 
              exit();
          } 
            else if (!empty($_POST["pay_method"])) 
          {
              $pay_method = ($_POST["pay_method"]);
          }

    if($_SESSION['username'] === "")
     {
        exit();
     }

    foreach ($_SESSION['cart'] as $key => $value) 
    { 
        
         $value['Product_total'] = (($value['Quantity'])*($value['Price']));
         
    }
    
     
    function test_input($data) 
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
 
           $username = $_SESSION['username'];
           $query1="SELECT * from user_data where USERNAME='$username'";

           $pay_method = test_input($_POST["pay_method"]);
           $stid = oci_parse($con, $query1);
           oci_execute($stid);
           while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
            $id=$row['ID'];
           }

                 foreach ($_SESSION['cart'] as $key => $value) 
                   { 
                     
                        $Item_Name = $value['Item_Name'];
                        $Price = $value['Price'];                                                                                                       
                        $Quantity = $value['Quantity'];
                        $Product_total = $value['Total_price'];
                        echo $Product_total;
                        echo $Item_Name;
                        echo $Price;
                        echo $Quantity;
                        echo $pay_method;
                        echo "string";
                        //order procedure
                        
                        
                         $query="begin
                                  add_order(:id, :Price, :Quantity, :Item_Name);
                                end;";
                          $stid = oci_parse($con, $query);
                          oci_bind_by_name($stid,':id',$id);
                          oci_bind_by_name($stid,':Price',$Price,50);
                          oci_bind_by_name($stid,':Quantity',$Quantity,50);
                          oci_bind_by_name($stid,':Item_Name',$Item_Name,50);
                        if (!$stid) {
                          $m = oci_error($con);
                          trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);
                          header("refresh: 0");
                        }
                        $r = oci_execute($stid);
                        if (!$r) {
                          $m = oci_error($stid);
                          trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
                          header("refresh: 0");
                        }
                        else{
                          // echo '<script>alert("Added")</script>';
                          // header("refresh: 0");
                        } 
                      }    
                      oci_free_statement($stid);
                      oci_close($con);

                   }
                       if($_SESSION['username'] != "")
                       {
                       unset($_SESSION['cart']);
                       echo"<script>
                       alert('Order Placed');
                       window.location.href='order_history.php';
                      </script>";
                       }
                   
             
                                       


    // oci_close($con);
?>