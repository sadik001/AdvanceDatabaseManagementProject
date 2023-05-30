<?php

$sesid = 3;
$conn = oci_connect('pritom', 'tree', '//localhost/XE');
if (!$conn) {
    echo 'Failed to connect to Oracle' . "<br>";
}

if (isset($_POST['submit'])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $pass = $_POST["password"];
    echo $email;
    echo $pass;

    $query = "insert into Staff values (seq_staff_id.NEXTVAL, '$sesid', '$name', '$email' , '$pass')";

    $stid1 = oci_parse($conn, $query);
    

    oci_execute($stid1);

    oci_free_statement($stid1);

}
else if(isset($_POST['submit2'])){
    $id=$_POST['id'];
    $email = $_POST["email"];


    $query1 = "update Staff set EMAIL = '$email'  where STAFF_ID = '$id' ";
      $stid2 = oci_parse($conn, $query1);
      

      oci_execute($stid2);

      oci_free_statement($stid2);
  }

oci_close($conn);
header("Location:View_profile_ad.php");

?>