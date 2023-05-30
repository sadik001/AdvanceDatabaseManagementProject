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
      <a class="animate1st-charcter"> Procedures </a><br><br><br>
    </div>
<p>Add Staffs<p>
     <?php
        $conn = oci_connect('pritom', 'tree', '//localhost/XE');   
        if (!$conn) {
          echo 'Failed to connect to oracle' . "<br>";
        }

        $stid = oci_parse($conn, 'SELECT * FROM Staff');
        oci_execute($stid);
        echo "<table border='1'>
        <tr>
            <th>Staff ID</th>
            <th>Staff Name</th>
            <th>Staff Email</th>
            <th>Staff Password</th>
            
                    
        </tr>";
        while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
        echo "<tr>";
        echo "<td>" . $row['STAFF_ID'] . "</td>";
        echo "<td>" . $row['NAME'] . "</td>";
        echo "<td>" . $row['EMAIL'] . "</td>";
        echo "<td>" . $row['PASSWORD'] . "</td>";
        
        echo "</tr>";
        }
        echo "</table>\n";
        oci_free_statement($stid);
    oci_close($conn);
     ?>
      <form method="POST" action="procadmin.php">            
                <input type="text" name="name" required>
                <label>Staff Name </label><br>
                <input type="text" name="email" required>
                <label>Staff Email </label><br>
                <input type="text" name="password" required>
                <label>Staff Password </label><br>
            <input type="submit" value="Add Staff" name="submit">
      </form>
      <br>
      <br>
      <form method="POST" action="procadmin.php">            
                <input type="number" name="id" required>
                <label>Staff Id </label><br>
                <input type="text" name="email" required>
                <label>Staff Email </label><br>
                
            <input type="submit" value="Update Email" name="submit2">
      </form>
     <br>
      <br> 
      <br>

     
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
<?php
  $sesid=3;
  if (isset($_POST['submit'])) {
      $name = $_POST["name"];
      $email = $_POST["email"];
      $pass = $_POST["password"];
      echo $email;
      echo $pass;

      $query = 'BEGIN
                  add_stuff(:a_id, :nme, :mail, :pass);
                END;';

      $stid1 = oci_parse($conn, $query);
      oci_bind_by_name($stid1, ':a_id', $sesid);
      oci_bind_by_name($stid1, ':nme', $name);
      oci_bind_by_name($stid1, ':mail', $email);
      oci_bind_by_name($stid1, ':pass', $pass);

      oci_execute($stid1);

      oci_free_statement($stid1);
  }
  else if(isset($_POST['submit2'])){
    $id=$_POST['id'];
    $email = $_POST["email"];


    $query1 = 'begin
              update_mail_stuff(:s_id,  :mail);
              end;';

      $stid2 = oci_parse($conn, $query1);
      oci_bind_by_name($stid2, ':s_id', $id);
      oci_bind_by_name($stid2, ':mail', $email);
      

      oci_execute($stid2);

      oci_free_statement($stid2);
  }

  oci_close($conn);


?>

