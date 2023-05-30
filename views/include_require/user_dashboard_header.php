<?php
session_start();
require '../model/DB.php';
require '../views/nav_user.php';

if (!isset($_SESSION['username'])) {
        $_SESSION['username'] = "";
    }

    if (!isset($_SESSION['checkout'])) {
        $_SESSION['checkout'] = "";
    }
    if($_SESSION['username'] === "" && $_SESSION['checkout'] === "notloggedin"){
        echo"<script>
        alert('For checkout please Login First');
        window.location.href='../views/Login.php';
         </script>"; 
         /*unset($_SESSION['checkout']);*/
    /*header("Location: ../views/Login.php");*/
  }

         if($_SESSION['username'] === ""){
        /*header("Location: ../controller/Logout.php");*/
        echo"<script>
        alert('Please Login First');
        window.location.href='../views/Login.php';
         </script>";
         unset($_SESSION['username']); 
        
    /*header("Location: ../views/Login.php");*/
  }

  $username = $_SESSION['username'];
           $queryU = "SELECT * FROM USER_DATA WHERE USERNAME = '$username'";
           $stid = oci_parse($con, $queryU);
            if (!$stid) {
                $m = oci_error($con);
                 trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);
                }
            echo '<br>';

            $r = oci_execute($stid);
            if (!$r) {
                $m = oci_error($stid);
                    trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
            }

            echo '<br>';

              
            #$rows = oci_num_rows($stid);      
            $rows = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC);
            
            if ($rows == 0){
                
           /* $error2 = "There is no account associated with this username!<br>";*/
                    echo"<script>
                     alert('There is no account associated with this username!');
                     window.location.href='../views/mycart.php';
                     </script>"; 
            }

            $queryID = "SELECT * FROM USER_DATA WHERE USERNAME = '$username'";
            #$user_data=mysqli_query($con,$queryID);

            $stid1 = oci_parse($con, $queryID);
            if (!$stid1) {
                $m1 = oci_error($con);
                 trigger_error('Could not parse statement: '. $m1['message'], E_USER_ERROR);
                }
            echo '<br>';

            $r1 = oci_execute($stid1);
            if (!$r1) {
                $m1 = oci_error($stid1);
                    trigger_error('Could not execute statement: '. $m1['message'], E_USER_ERROR);
            }
/*
           while(($row = oci_fetch_array($stid1, OCI_BOTH)) != false)
            {
            echo "<tr>";
              echo "<td>" . $row['EMAIL'] . "</td>";
              $email=$user_fetch['EMAIL'];
              $gender=$user_fetch['Gender'];
              $dob=$user_fetch['Dob'];
              $phone=$user_fetch['Phone'];              
              $preadd=$user_fetch['Preadd'];
              $religion=$user_fetch['Religion'];
            echo "</tr>";
            }
            echo "</table>\n";



$_SESSION['name'] = $name;
$_SESSION['email'] = $email;
$_SESSION['gender'] = $gender;
$_SESSION['dob'] = $dob;
$_SESSION['phone'] = $phone;
$_SESSION['preadd'] = $preadd;
$_SESSION['religion'] = $religion;*/
?>
