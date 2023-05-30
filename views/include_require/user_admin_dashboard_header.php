<?php
session_start();

$con = oci_connect('pritom', 'tree', '//localhost/XE');
//require '../model/DB.php';
require '../views/nav_user_admin.php';

if (!isset($_SESSION['adminname'])) {
        $_SESSION['adminname'] = "";
    }

    // if (!isset($_SESSION['checkout'])) {
    //     $_SESSION['checkout'] = "";
    // }
  //   if($_SESSION['adminname'] === ""){
  //       echo"<script>
  //       alert('For checkout please Login First');
  //       window.location.href='../views/AdminLogin.php';
  //        </script>"; 
  //        /*unset($_SESSION['checkout']);*/
  //   /*header("Location: ../views/Login.php");*/
  // }

         if(!isset($_SESSION['adminname'])){
        /*header("Location: ../controller/Logout.php");*/
        echo"<script>
        alert('Please Login First');
        window.location.href='../views/AdminLogin.php';
         </script>";
         //unset($_SESSION['adminname']); 
        
    /*header("Location: ../views/Login.php");*/
  }
            
          $adminname=$_SESSION['adminname'];
            $queryID = "SELECT * FROM user_admin_data WHERE Adminname= '$adminname'";
            //$user_data=mysqli_query($con,$queryID);

            $stid = oci_parse($con, $queryID);
            oci_execute($stid);
            while(($user_fetch=oci_fetch_array($stid, OCI_BOTH)) != false)
            {
              $name=$user_fetch['NAME'];
              $email=$user_fetch['EMAIL'];
              $gender=$user_fetch['GENDER'];
              $dob=$user_fetch['DOB'];
              $phone=$user_fetch['PHONE'];              
              $preadd=$user_fetch['PREADD'];
              $religion=$user_fetch['RELIGION'];

              $_SESSION['name'] = $name;
              $_SESSION['email'] = $email;
              $_SESSION['gender'] = $gender;
              $_SESSION['dob'] = $dob;
              $_SESSION['phone'] = $phone;
              $_SESSION['preadd'] = $preadd;
              $_SESSION['religion'] = $religion;
            }
            

// $_SESSION['name'] = $name;
// $_SESSION['email'] = $email;
// $_SESSION['gender'] = $gender;
// $_SESSION['dob'] = $dob;
// $_SESSION['phone'] = $phone;
// $_SESSION['preadd'] = $preadd;
// $_SESSION['religion'] = $religion;
?>
