<?php

#input connection string to your database, 
$conn = oci_connect("USER_NAME", "PASSWORD", "DATABASE_ADDRESS");
if (!$conn) {
   $m = oci_error();
   echo $m['message'], "\n";
   exit;
}
?>